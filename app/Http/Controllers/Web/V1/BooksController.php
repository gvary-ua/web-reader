<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\CoverCreateRequest;
use App\Models\Author;
use App\Models\Chapter;
use App\Models\Cover;
use App\Models\Genre;
use App\Models\LanguageCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Redirect;

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

    private function createDto(Cover $cover)
    {
        $author = $cover->authors()->first(['users.user_id', 'first_name', 'last_name', 'login']);

        $login = $author['login'];
        $name = $author['first_name'].' '.$author['last_name'];

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
            'userId' => $author['user_id'],
            'typeId' => $cover['cover_type_id'],
            'login' => $login,
            'title' => $cover['title'],
            'description' => $cover['description'],
            'author' => $name,
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
    public function show(int $id)
    {
        $cover = Cover::find($id);
        if ($cover == null || $cover['public'] == false) {
            abort(404);
        }
        $dto = $this->createDto($cover);

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
}
