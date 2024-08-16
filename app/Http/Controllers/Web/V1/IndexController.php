<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(Request $request): View
    {
        // TODO: Order by most likes
        $topCovers = Cover::select(['cover_id', 'cover_type_id', 'title', 'img_key'])
            ->where('public', '=', true)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $latestCovers = Cover::select(['cover_id', 'cover_type_id', 'title', 'img_key'])
            ->where('public', '=', true)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        return view('index', [
            'top_covers' => $this->toDto($topCovers),
            'latest_covers' => $this->toDto($latestCovers),
        ]);
    }

    private function toDto(Collection $covers)
    {
        $dtos = [];
        foreach ($covers as &$cover) {

            $author = $cover->authors()->first(['users.user_id', 'first_name', 'last_name', 'login']);

            // TODO: move this into `Author` table
            $name = $author['first_name'].' '.$author['last_name'];
            if (empty($author['first_name']) || empty($author['last_name'])) {
                $name = '@'.$author['login'];
            }

            $type = $cover->coverType()->first(['label'])['label'];

            $dto = [
                'id' => $cover['cover_id'],
                'user_id' => $author['user_id'],
                'title' => $cover['title'],
                'author' => $name,
                'type' => $type,
                'imgSrc' => $cover['img_key'],
            ];

            array_push($dtos, $dto);
        }

        return $dtos;
    }
}
