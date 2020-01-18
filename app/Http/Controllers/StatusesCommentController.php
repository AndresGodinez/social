<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Status;
use Illuminate\Http\Request;
use function auth;

class StatusesCommentController extends Controller
{
    public function store(Status $status, Request $request)
    {

        $comment = Comment::create([
            'status_id' => $status->id,
            'user_id' => auth()->id(),
            'comment' => $request->get('comment')
        ]);

        return CommentResource::make($comment);
    }
}
