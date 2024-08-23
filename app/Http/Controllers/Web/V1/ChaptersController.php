<?php

namespace App\Http\Controllers\Web\V1;

use App\Http\Controllers\Controller;
use App\Models\Cover;
use Illuminate\Support\Arr;
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

        $selectChaptersInOrder = '
            select c.chapter_id, c.title, c.block_ids from chapters as c
            join json_array_elements(?::json) with ordinality as o (id, ord)
            on c.chapter_id = o.id::text::int
            where c.public = true
            order by o.ord asc;
        ';

        $chapters = DB::select($selectChaptersInOrder, [json_encode($cover['chapter_ids'], JSON_UNESCAPED_SLASHES)]);
        $chapterIds = Arr::map($chapters, function ($chapter) {
            return $chapter->chapter_id;
        });

        $currChapterIndex = array_search($chapterId, $chapterIds);
        if ($currChapterIndex === false) {
            abort(404);
        }

        $currentChapter = $chapters[$currChapterIndex];

        $prevChapter = null;
        $nextChapter = null;
        if ($currChapterIndex - 1 >= 0) {
            $prevChapter = $chapters[$currChapterIndex - 1];
        }
        if ($currChapterIndex + 1 < count($chapterIds)) {
            $nextChapter = $chapters[$currChapterIndex + 1];
        }

        $selectBlocksInOrder = "
            select b.block_nanoid_10, b.block_type_id, b.data, b.data_version from blocks as b
            join json_array_elements(?::json) WITH ORDINALITY as o (id, ordinality)
            on b.block_nanoid_10 = (o.id #>> '{}')
            order by o.ordinality;
        ";

        $blocks = DB::select($selectBlocksInOrder, [$currentChapter->block_ids]);

        foreach ($blocks as &$block) {
            $block->data = json_decode($block->data);
        }

        // dd($chapters, $currentChapter);

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