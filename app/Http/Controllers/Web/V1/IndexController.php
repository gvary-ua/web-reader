<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(Request $request): View
    {
        // Refreshes once an hour
        $topCovers = Cache::remember('top_10_covers_by_most_likes', 60, function () {
            return Cover::select(['covers.cover_id', 'cover_type_id', 'title', 'img_key'])
                ->where('public', '=', true)
                ->leftJoin('user_liked_cover', 'covers.cover_id', '=', 'user_liked_cover.cover_id')
                ->selectRaw('COUNT(DISTINCT user_liked_cover.user_id) as likes')
                ->groupBy('covers.cover_id')
                ->orderByDesc('likes')
                ->take(10)
                ->get();
        });

        $latestCovers = Cover::select(['cover_id', 'cover_type_id', 'title', 'img_key'])
            ->where('public', '=', true)
            ->orderByDesc('published_at')
            ->limit(10)
            ->get();

        $coverCount = Cover::where('public', '=', true)->count();

        return view('index', [
            'top_covers' => $this->toDto($topCovers),
            'latest_covers' => $this->toDto($latestCovers),
            'cover_count' => $coverCount,
        ]);
    }

    private function toDto(Collection $covers)
    {
        $dtos = [];
        foreach ($covers as &$cover) {

            $author = $cover->authors()->first(['users.user_id', 'pen_name', 'first_name', 'last_name', 'login']);

            $type = $cover->coverType()->first(['label'])['label'];

            $dto = [
                'id' => $cover['cover_id'],
                'user' => $author,
                'title' => $cover['title'],
                'type' => $type,
                'imgSrc' => $cover['img_key'],
            ];

            array_push($dtos, $dto);
        }

        return $dtos;
    }
}
