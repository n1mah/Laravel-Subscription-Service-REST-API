<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LogoutTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_logout_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->post('/api/v1/logout');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
    public function test_user_logout_unauthorised(): void
    {
        $user=User::where('email','operator3@gmail.com')->first();

        $response = $this->post('/api/v1/logout');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }

}
