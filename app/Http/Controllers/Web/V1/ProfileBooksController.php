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
        return view('profile.books.index', [
            'user' => $request->user(),
            'books' => [
                [
                    'title' => 'Title',
                    'author' => 'Author',
                    'type' => 'Book',
                    'genres' => ['Adventure', '18+', 'Horror'],
                    'imgSrc' => 'https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg',
                    'description' => 'У маленькому містечку сталося жахливе вбивство, молодому детективу Генрі та його напарниці Джейн доведеться не
                    солодко, адже на місці злочину немає жодних слідів. Тим часом вбивства посторюються, і ніщо не вказує на
                    підозрюваних. Чи вийде у молодого детектива розплутати цю складну загадку?',
                    'chaptersTotal' => 5,
                    'chaptersPublished' => 3,
                ],
                [
                    'title' => 'Another Title',
                    'author' => 'Yes Yes Author',
                    'type' => 'Book',
                    'genres' => ['18+', 'Horror'],
                    'imgSrc' => 'https://img.freepik.com/free-photo/painting-mountain-lake-with-mountain-background_188544-9126.jpg',
                    'description' => 'dlfjglids jflisjdflj sildjflsijglisjep ijspdjf jselifjosijfoisjeofpj spoejf powe Yes. Yes.',
                    'chaptersTotal' => 3,
                    'chaptersPublished' => 3,
                ],
            ],
        ]);
    }

    public function store(CoverCreateRequest $request)
    {
        DB::transaction(function () use ($request) {
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
        });

        // TODO: Redirect to SPA
        return redirect('/');
    }
}
