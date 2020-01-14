<?php

namespace Tests\Unit\Http\Resources;

use App\Http\Resources\StatusResource;
use Tests\TestCase;
use App\Models\Status;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StatusResourceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function a_status_resource_must_be_have_necessary_fields()
    {
        $status = factory(Status::class)->create();

        $statusResource = StatusResource::make($status)->resolve();

        $this->assertEquals($status->body, $statusResource['body']);

        $this->assertEquals($status->user->name, $statusResource['user_name']);

        $this->assertEquals('https://f0.pngfuel.com/png/592/884/black-and-white-cartoon-character-programmer-computer-programming-computer-software-computer-icons-programming-language-avatar-png-clip-art.png', $statusResource['user_avatar']);

        $this->assertEquals($status->created_at->diffForHumans(), $statusResource['ago']);

    }
}
