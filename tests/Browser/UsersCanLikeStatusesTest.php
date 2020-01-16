<?php

namespace Tests\Browser;

use App\Models\Status;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UsersCanLikeStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_like_statuses()
    {
        $user = $this->getDefaultUser();
        $status = factory(Status::class)->create();

        $this->browse(function (Browser $browser) use ($user, $status) {
            $browser->loginAs($user)
                ->visit('/')
                ->waitForText($status->body)
                ->assertSee($status->body)
                ->click('@like-btn')
                ->waitForText('TE GUSTA')
                ->assertSee('TE GUSTA')
            ;
        });
    }
}
