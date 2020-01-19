<?php

namespace App\Http\Controllers;

use App\Models\Status;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Resources\CommentResource;
use function auth;

class StatusesCommentController extends Controller
{
    public function store(Status $status, Request $request)
    {
        $comment = Comment::create([
            'status_id' => $status->id,
            'user_id' => auth()->id(),
            'body' => $request->get('body')
        ]);

        return CommentResource::make($comment);
    }
}
