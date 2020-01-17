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
    public function guest_cannot_like_status()
    {
        $status = factory(Status::class)->create();

        $this->browse(function (Browser $browser) use ($status) {
            $browser->visit('/')
                ->waitForText($status->body)
                ->assertSee($status->body)
                ->click('@like-btn')
                ->assertPathIs('/login')
            ;
        });
    }

    /**
     * @test
     * @throws \Throwable
     */
    public function user_can_like_and_unlike_statuses()
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

                ->click('@unlike-btn')
                ->waitForText('ME GUSTA')
                ->assertSee('ME GUSTA')
            ;
        });
    }
}
