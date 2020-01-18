<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\CommentResource;
use App\Http\Resources\StatusResource;
use App\Models\Comment;
use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_comment_resource_must_be_have_necessary_fields()
    {

        $comment = factory(Comment::class)->create();

        $commentResource = CommentResource::make($comment)->resolve();

        $this->assertEquals(
            $comment->body,
            $commentResource['body']
        );


    }
}
