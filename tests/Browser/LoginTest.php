<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     *
     * @test
     * @throws \Throwable
     */
    public function user_can_log_in()
    {
        $user = $this->getDefaultUser();

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->type('email', 'ing.a.godinez@gmail.com')
                ->type('password', 'password')
                ->press('#login-button')
                ->assertPathIs('/')
                ->assertAuthenticatedAs($user)
            ;
        });
    }
}
