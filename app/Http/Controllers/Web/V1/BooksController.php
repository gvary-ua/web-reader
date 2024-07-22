<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\CoverCreateRequest;
use App\Models\Author;
use App\Models\Chapter;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
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
            $author = $cover->authors()->first(['first_name', 'last_name']);

            $name = $author['first_name'].' '.$author['last_name'];

            $genres = array_map(function ($entry) {
                return $entry['label'];
            }, $cover->genres()->get(['label'])->toArray());

            $type = $cover->coverType()->first(['label'])['label'];

            $chaptersTotal = $cover->chapters()->count();
            $chaptersPublished = $cover->chapters()->where('public', true)->count();

            $dto = [
                'id' => $cover['cover_id'],
                'typeId' => $cover['cover_type_id'],
                'title' => $cover['title'],
                'description' => $cover['description'],
                'author' => $name,
                'type' => $type,
                'genres' => $genres,
                'imgSrc' => $cover['img_key'],
                'chaptersTotal' => $chaptersTotal,
                'chaptersPublished' => $chaptersPublished,
            ];
            array_push($dtos, $dto);
        }

        return view('books.index', [
            'user' => $request->user(),
            'books' => $dtos,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cover $cover)
    {
        return view('books.show', ['cover' => $cover]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cover $cover)
    {
        Gate::authorize('update', $cover);

        return view('books.edit', ['cover' => $cover]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cover $cover)
    {
        Gate::authorize('update', $cover);

        return Redirect::route('books.index')->with('status', 'Book updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cover $cover)
    {
        Gate::authorize('delete', $cover);

        return Redirect::route('books.index')->with('status', 'Book deleted!');
    }

    public function store(CoverCreateRequest $request)
    {
        $cover = DB::transaction(function () use ($request) {
            $cover = Cover::create([
                'cover_type_id' => $request->coverTypeId,
                'cover_status_id' => 1, // In progress
                // TODO: Get language from `Accept-Language` header on login and store it in user settings.
                'lang_id' => 'uk',
                // TODO: Change name based on user locale (need to save upon registration and then can be changed in settings)
                // TODO: Change timezone based on their timezone
                'title' => 'Draft '.date('Y-m-d H:i:s'),
            ]);

            Author::create([
                'user_id' => $request->user()->user_id,
                'cover_id' => $cover->cover_id,
            ]);

            $chapter = Chapter::create([
                // TODO: Change name based on user locale (need to save upon registration and then can be changed in settings)
                'title' => 'Нова глава',
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
