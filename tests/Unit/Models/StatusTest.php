<?php

namespace Tests\Unit\Models;


use App\Models\Like;
use App\User;
use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function factory;

class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_status_belong_to_user()
    {
        $status = factory(Status::class)->create();

        $this->assertInstanceOf(User::class, $status->user);
    }

    /** @test */
    function a_status_has_many_likes()
    {
        $status = factory(Status::class)->create();
        factory(Like::class)->create([
            'status_id' => $status->id
        ]);

        $this->assertInstanceOf(Like::class, $status->likes()->first());
    }

    /** @test */
    function a_status_can_be_liked_and_unlike()
    {
        $status = factory(Status::class)->create();

        $this->actingAs(factory(User::class)->create());

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes->count());

        $status->unlike();

        $this->assertEquals(0, $status->fresh()->likes->count());
    }

    /** @test */
    function a_status_can_be_liked_once()
    {
        $status = factory(Status::class)->create();

        $this->actingAs(factory(User::class)->create());

        $status->like();

        $this->assertEquals(1, $status->likes->count());

        $status->like();

        $this->assertEquals(1, $status->fresh()->likes->count());
    }

    /** @test */
    function a_status_knows_if_it_is_liked()
    {
        $status = factory(Status::class)->create();

        $this->assertFalse(
            $status->isLiked()
        );

        $this->actingAs(factory(User::class)->create());

        $status->like();

        $this->assertTrue(
            $status->isLiked()
        );

    }

    /** @test */
    function a_status_knows_how_many_like_has()
    {
        $status = factory(Status::class)->create();

        $this->assertEquals(
            0,
            $status->likesCount()
        );

        factory(Like::class)->times(2)->create(['status_id' => $status->id]);

        $this->assertEquals(
            2,
            $status->likesCount()
        );
    }
}
