<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;

class SectionTest extends TestCase
{
    public function test_show_Section_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/v1/section');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data',
        ]);
    }
    public function test_show_Section_unauthorised(): void
    {
        $response = $this->get('/api/v1/section');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
