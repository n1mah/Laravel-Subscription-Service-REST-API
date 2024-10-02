<?php

namespace Tests\Unit;

use Tests\TestCase;

class PlanTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_plan(): void
    {
        $response = $this->get('/api/v1/plan');
        $response->assertStatus(200);
        $response->assertJsonStructure([
            'data' => [],
        ]);
    }
}
