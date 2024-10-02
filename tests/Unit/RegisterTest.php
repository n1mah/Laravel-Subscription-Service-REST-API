<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_register_validation(): void
    {
        $response = $this->post('/api/v1/register');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'data', 'status'
        ]);
    }

    public function test_user_register_success(): void
    {
        $response = $this->post('/api/v1/register',[
            'name' => 'operator 3',
            'email' => 'operator4@gmail.com',
            'password' => "Abcd1234",
        ]);
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data', 'status'
        ]);
    }
}
