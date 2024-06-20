<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\V1\CoverCreateRequest;
use App\Models\Author;
use App\Models\Cover;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ProfileBooksController extends Controller
{
    public function index(Request $request): View
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

        return view('profile.books.index', [
            'user' => $request->user(),
            'books' => $dtos,
        ]);
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

            return $cover;
        });

        // TODO: Error handling ?
        // TODO: Redirect to error page ?

        return redirect(config('app.spa_url')."?coverId={$cover->cover_id}&coverTypeId={$cover->cover_type_id}");
    }
}
