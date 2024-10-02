<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_login_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $response = $this->post('/api/v1/login',[
            'email' => 'operator3@gmail.com',
            'password' => 'Abcd1234'
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data'=>[
                'token',
            ]
        ]);

    }

    public function test_user_login_unauthorised(): void
    {
        $response = $this->post('/api/v1/login');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'data' => [],
            'status',
        ]);
    }
}
