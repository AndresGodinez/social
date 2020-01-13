<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateStatusTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    function guest_can_not_create_status()
    {
        $response = $this->post(route('statuses.store'), [
            'body' => 'this is my first status'
        ]);

        $response->assertRedirect('login');
    }

    /** @test */
    function an_authenticated_user_can_create_status()
    {
        $this->withoutExceptionHandling();

        $user = $this->getDefaultUser();

        $response = $this->actingAs($user)->post(route('statuses.store'), [
            'body' => 'this is my first status'
        ]);

        $response->assertSuccessful();

        $response->assertJson([
            'body' => 'this is my first status'
        ]);

        $this->assertDatabaseHas('statuses', [
            'body' => 'this is my first status',
            'user_id' => $user->id
        ]);
    }

}
