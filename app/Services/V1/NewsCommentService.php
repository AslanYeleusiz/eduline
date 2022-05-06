<?php
namespace App\Services\V1;

class NewsCommentService
{
    public static function commentsTree($allComments)
    {
        $rootComments = $allComments->whereNull('parent_id');
        self::formatTree($rootComments, $allComments);
        return $rootComments;
    }

    private static function formatTree($rootComments, $allComments)
    {
        foreach ($rootComments as $comment) {
            $comment->children = $allComments->where('parent_id', $comment->id)->values();
            if ($comment->children->isNotEmpty()) {
                self::formatTree($comment->children, $allComments);
            }
        }
    }
}