<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UsersCanCreateStatusesTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     * @throws \Throwable
     */
    public function user_can_create_statuses()
    {
        $user = $this->getDefaultUser();

        $this->browse(function (Browser $browser) use ($user) {
            $statusContent = 'My first status';
            $browser->loginAs($user)
                ->visit('/')
                ->type('body', $statusContent)
                ->press('#create-status')
                ->waitForText($statusContent)
                ->assertSee($statusContent)
            ;
        });
    }
}
