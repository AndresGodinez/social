<?php

namespace Tests\Browser;

use function factory;
use App\Models\Status;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CommentsTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     * @throws \Throwable
     */
    public function an_authenticated_user_can_comment_status()
    {
        $user = $this->getDefaultUser();
        $status = factory(Status::class)->create();

        $this->browse(function (Browser $browser) use ($user, $status) {
            $commentText = 'my first comment';
            $browser->loginAs($user)
                ->visit('/')
                ->waitForText($status->body)
                ->assertSee($status->body)
                ->type('@comment', $commentText)
                ->click('@comment-btn')

                ->waitForText($commentText)
                ->assertSee($commentText);
        });
    }
}
