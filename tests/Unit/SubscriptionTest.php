<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    public function test_show_subscription_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/v1/subscription');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
    public function test_show_subscription_unauthorised(): void
    {
        $response = $this->get('/api/v1/subscription');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_success_subscription_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/v1/subscription/success');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_success_subscription_unauthorised(): void
    {
        $response = $this->get('/api/v1/subscription/success');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_store_subscription_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/v1/subscription');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'message',
        ]);
    }
    public function test_store_subscription_unauthorised(): void
    {
        $response = $this->get('/api/v1/subscription');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
