<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\Chapter;
use App\Models\Cover;
use Illuminate\Support\Facades\DB;

class ChaptersController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(int $bookId, int $chapterId)
    {
        $cover = Cover::select('cover_id', 'title', 'chapter_ids')
            ->where('cover_id', '=', $bookId)
            ->where('public', '=', true)
            ->first();

        if (empty($cover['cover_id'])) {
            abort(404);
        }

        $chapterIds = $cover['chapter_ids'];
        $currChapterIndex = array_search($chapterId, $chapterIds);
        if ($currChapterIndex === false) {
            abort(404);
        }

        $chapters = Chapter::select('chapter_id', 'title')
            ->whereIn('chapter_id', $chapterIds)
            ->where('public', '=', true)
            ->get();

        $currentChapter = Chapter::select('chapter_id', 'title', 'block_ids')
            ->where('chapter_id', '=', $chapterId)
            ->where('public', '=', true)
            ->first();

        $prevChapter = null;
        $nextChapter = null;
        if ($currChapterIndex - 1 >= 0) {
            $prevChapterId = $chapterIds[$currChapterIndex - 1];
            $prevChapter = Chapter::select('chapter_id', 'title')
                ->where('chapter_id', '=', $prevChapterId)
                ->where('public', '=', true)
                ->first();
        }
        if ($currChapterIndex + 1 < count($chapterIds)) {
            $nextChapterId = $chapterIds[$currChapterIndex + 1];
            $nextChapter = Chapter::select('chapter_id', 'title')
                ->where('chapter_id', '=', $nextChapterId)
                ->where('public', '=', true)
                ->first();
        }

        $selectBlocksInOrder = "
            select b.block_nanoid_10, b.block_type_id, b.data, b.data_version from blocks as b
            join json_array_elements(?::json) WITH ORDINALITY as o (id, ordinality)
            on b.block_nanoid_10 = (o.id #>> '{}')
            order by o.ordinality;
        ";

        $block_ids = $currentChapter['block_ids'];
        $blocks = DB::select($selectBlocksInOrder, [json_encode($block_ids, JSON_UNESCAPED_SLASHES)]);

        foreach ($blocks as &$block) {
            $block->data = json_decode($block->data);
        }

        return view('chapters.show', [
            'bookId' => $bookId,
            'title' => $cover['title'],
            'blocks' => $blocks,
            'chapters' => $chapters,
            'curr_chapter' => $currentChapter,
            'prev_chapter' => $prevChapter,
            'next_chapter' => $nextChapter,
        ]);
    }
}
