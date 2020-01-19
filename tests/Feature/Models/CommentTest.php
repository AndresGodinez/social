<?php

namespace Tests\Feature\Models;

use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use function factory;
use function route;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function an_authenticated_user_can_comment_a_status()
    {
        $this->withoutExceptionHandling();
        $user = $this->getDefaultUser();
        $status = factory(Status::class)->create();

        $text = 'my first Comment';

        $response = $this->actingAs($user)->postJson(route('statuses.comments.store', $status), [
            'body' => $text
        ]);

        $this->assertDatabaseHas('comments', [
            'status_id' => $status->id,
            'user_id' => $user->id,
            'body' => $text
        ]);

        $response->assertJson([
            'data' => ['body' => $text]
        ]);
    }
}
