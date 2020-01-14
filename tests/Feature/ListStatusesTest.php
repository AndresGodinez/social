<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ListStatusesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function can_get_list_statuses()
    {
        $this->withoutExceptionHandling();

        $status1 = factory(Status::class)->create([
            'created_at' => now()->subDays(4)
        ]);
        $status2 = factory(Status::class)->create([
            'created_at' => now()->subDays(3)
        ]);
        $status3 = factory(Status::class)->create([
            'created_at' => now()->subDays(2)
        ]);
        $status4 = factory(Status::class)->create([
            'created_at' => now()->subDays(1)
        ]);

        $response = $this->getJson(route('statuses.index'));

        $response->assertSuccessful();

        $response->assertJson([
            'meta' => ['total' => 4]
        ]);

        $this->assertEquals(
            $response->json('data.0.body'),
            $status4->body
        );

        $response->assertJsonStructure([
            'links' => ['prev', 'next']
        ]);
    }
}
