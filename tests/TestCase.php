<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $defaultUser;

    public function getDefaultUser():User
    {
        if (!is_null($this->defaultUser)){
            return $this->defaultUser;
        }
        else
        {
            $user = factory(User::class)->create([
                'email' => 'ing.a.godinez@gmail.com'
            ]);

            $this->setUser($user);
            return $this->defaultUser;
        }
    }

    protected function setUser(User $user)
    {
        $this->defaultUser = $user;
    }
}
