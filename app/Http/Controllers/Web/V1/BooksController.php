<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\CoverCreateRequest;
use App\Models\Author;
use App\Models\Chapter;
use App\Models\Cover;
use App\Models\Genre;
use App\Models\LanguageCode;
use App\Models\User;
use App\Models\UserClickOnCover;
use App\Models\UserLikeCover;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\Laravel\Facades\Image;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $covers = $request->user()->covers(['cover_id', 'cover_type_id', 'title', 'description', 'img_key'])->get();
        $dtos = [];
        foreach ($covers as &$cover) {
            $dto = $this->createDto($cover);
            array_push($dtos, $dto);
        }

        return view('books.index', [
            'user' => $request->user(),
            'books' => $dtos,
        ]);
    }

    /**
     * Display a listing of the resource for specific user.
     */
    public function indexForUser(User $user)
    {
        $covers = $user->covers(['cover_id', 'cover_type_id', 'title', 'description', 'img_key'])->get();
        $dtos = [];
        foreach ($covers as &$cover) {
            $dto = $this->createDto($cover);
            array_push($dtos, $dto);
        }

        return view('books.index', [
            'user' => $user,
            'books' => $dtos,
        ]);
    }

    private function createDto(Cover $cover)
    {
        $author = $cover->authors()->first(['users.user_id', 'pen_name', 'first_name', 'last_name', 'login', 'profile_img_key']);

        $genres = array_map(function ($entry) {
            return $entry['label'];
        }, $cover->genres()->get(['label'])->toArray());

        $type = $cover->coverType()->first(['label'])['label'];

        $chapters = $cover->chapters();
        $chaptersTotal = count($chapters);
        $chaptersPublic = array_filter($chapters, function ($c) {
            return $c->public;
        });
        $chaptersPublished = count($chaptersPublic);
        $firstChapterId = empty($chaptersPublic) ? -1 : $chaptersPublic[0]->chapter_id;

        $dto = [
            'id' => $cover['cover_id'],
            'typeId' => $cover['cover_type_id'],
            'title' => $cover['title'],
            'description' => $cover['description'],
            'user' => $author,
            'type' => $type,
            'coverStatus' => $cover->coverStatus['label'],
            'language' => $cover->language['label'],
            'updatedAt' => date('d-m-Y', strtotime($cover['updated_at'])),
            'publishedAt' => date('d-m-Y', strtotime($cover['published_at'])),
            // TODO: create function that calculates reading time
            'readingTime' => '30',
            'genres' => $genres,
            'imgSrc' => $cover['img_key'],
            'chaptersTotal' => $chaptersTotal,
            'chaptersPublished' => $chaptersPublished,
            'firstChapterId' => $firstChapterId,
        ];

        return $dto;
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Cover $book)
    {
        if ($book == null || $book['public'] == false) {
            abort(404);
        }
        $dto = $this->createDto($book);

        if ($request->user()) {
            $userId = $request->user()->user_id;
            $coverId = $book->cover_id;

            $click = UserClickOnCover::where('user_id', $userId)
                ->where('cover_id', $coverId)
                ->first();

            if ($click) {
                $click->increment('times');
            } else {
                $click = UserClickOnCover::create([
                    'user_id' => $userId,
                    'cover_id' => $coverId,
                    'times' => 1,
                ]);
            }

            $like = UserLikeCover::where('user_id', $userId)
                ->where('cover_id', $coverId)
                ->first();

            if ($like) {
                $dto['i_like'] = true;
            } else {
                $dto['i_like'] = false;
            }
        }

        $dto['uniqueViews'] = $book->uniqueViews();
        $dto['views'] = $book->views();
        $dto['likes'] = $book->likes();

        return view('books.show', $dto);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $book)
    {
        Gate::authorize('update', $book);

        $type = $book->coverType()->first(['label'])['label'];

        $genres = Genre::all()->toArray();
        $book_genres = $book->genres()->pluck('cover_genres.genre_id')->toArray();
        $genres_dto = array_map(function ($genre) use ($book_genres) {
            return [
                'value' => $genre['genre_id'],
                'label' => $genre['label'],
                'checked' => in_array($genre['genre_id'], $book_genres),
            ];
        }, $genres);

        $languages = LanguageCode::all()->toArray();
        $languages_dto = array_map(function ($lang) use ($book) {
            return [
                'value' => $lang['lang_id'],
                'label' => $lang['label'],
                'selected' => $lang['lang_id'] == $book->language['lang_id'],
            ];
        }, $languages);

        $chapters = $book->chapters();
        $chapters_dto = array_map(function ($chapter) {
            return [
                'value' => $chapter->chapter_id,
                'label' => $chapter->title,
                'checked' => $chapter->public,
            ];
        }, $chapters);

        if ($book['cover_type_id'] == 2) {
            $chapters_dto[0]['label'] = $book['title'];
        }

        $dto = [
            'cover_id' => $book['cover_id'],
            'cover_type_id' => $book['cover_type_id'],
            'title' => $book['title'],
            'description' => $book['description'],
            'type' => $type,
            'imgSrc' => $book['img_key'],
            'lang_id' => $book->language['lang_id'],
            'languages' => $languages_dto,
            'genres' => $genres_dto,
            'book_genres' => $book_genres,
            'chapters' => $chapters_dto,
        ];

        return view('books.edit', $dto);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $book)
    {
        Gate::authorize('update', $book);

        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            // if user had previous image -> delete it
            if ($book->img_key) {
                $result = Storage::delete('public/'.$book->img_key);
                if (! $result) {
                    error_log('Something went wrong while deleting profile photo! '.$book->cover_id);
                }
            }

            // Resize, convert, and compress the image
            $processedImage = Image::read($image)
                ->resize(288, 432)
                ->encode(new WebpEncoder(quality: 65));

            // Create img key
            $random_hash = strtr(base64_encode(random_bytes(6)), '+/=', '-_.');
            $key = Auth::user()->user_id.'/cover-'.$book->cover_id.'-'.$random_hash.'.webp';

            // Upload and save in db
            $result = Storage::put('public/'.$key, $processedImage);
            if (! $result) {
                error_log('Something went wrong while uploading profile photo! '.$book->cover_id);
            }
            $book->img_key = $key;
        }

        if ($request['title'] != null) {
            $book['title'] = $request['title'];
        }
        if ($request['description'] != null) {
            $book['description'] = $request['description'];
        }

        $book->genres()->sync($request['genres']);
        $book->lang_id = $request['lang'];

        $public_chapters = $request['public_chapters'];
        if ($public_chapters != null && count($public_chapters) != 0) {
            if (! $book['public']) {
                $book['published_at'] = Carbon::now();
            }
            $book['public'] = true;
        } else {
            $book['public'] = false;
        }

        // TODO: Schedule a job to calculate word count & time read

        DB::transaction(function () use (&$book, &$request) {
            if ($book['chapter_ids'] != null) {
                DB::table('chapters')->whereIn('chapter_id', $book['chapter_ids'])->update(['public' => false]);
            }
            if ($request['public_chapters'] != null) {
                DB::table('chapters')->whereIn('chapter_id', $request['public_chapters'])->update(['public' => true]);
            }

            $book->save();
        });

        return Redirect::route('books.index')->with('status', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $book)
    {
        Gate::authorize('delete', $book);

        $book->deleteOrFail();

        return Redirect::route('books.index')->with('status', 'Book deleted!');
    }

    public function store(CoverCreateRequest $request)
    {
        $cover = DB::transaction(function () use ($request) {
            $nCovers = Author::where('user_id', '=', $request->user()->user_id)->count();

            $cover = Cover::create([
                'cover_type_id' => $request->coverTypeId,
                'cover_status_id' => 1, // In progress
                'lang_id' => app()->currentLocale(),
                'title' => Lang::get('Draft').' №'.($nCovers + 1),
            ]);

            Author::create([
                'user_id' => $request->user()->user_id,
                'cover_id' => $cover->cover_id,
            ]);

            $chapter = Chapter::create([
                'title' => Lang::get('New chapter'),
                'cover_id' => $cover->cover_id,
            ]);

            $cover->appendChapter($chapter);
            $cover->save();

            return $cover;
        });

        // TODO: Error handling ?
        // TODO: Redirect to error page ?

        return redirect(config('app.spa_url')."?coverId={$cover->cover_id}&coverTypeId={$cover->cover_type_id}");
    }

    public function like(Request $request, Cover $book)
    {
        if ($book == null || $book['public'] == false) {
            abort(404);
        }

        $userId = $request->user()->user_id;
        $coverId = $book->cover_id;

        $like = UserLikeCover::where('user_id', $userId)
            ->where('cover_id', $coverId)
            ->first();

        if ($like) {
            $like->delete();
        } else {
            $like = UserLikeCover::create([
                'user_id' => $userId,
                'cover_id' => $coverId,
            ]);
        }

        return Redirect::route('books.show', ['book' => $book->cover_id]);
    }
}
