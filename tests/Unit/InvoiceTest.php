<?php

namespace Tests\Unit;

use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InvoiceTest extends TestCase
{
    use RefreshDatabase;
    public function test_show_invoice_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $response = $this->actingAs($user)->get('/api/v1/invoice');
        $response->assertStatus(200);

    }
    public function test_show_invoice_unauthorised(): void
    {
        $response = $this->get('/api/v1/invoice');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }
    public function test_search_invoice_success(): void
    {
        $this->artisan('migrate:refresh');
        $this->seed();
        $user=User::where('email','operator3@gmail.com')->first();
        $subscription=$user->subscriptions()->first();
        $response = $this->actingAs($user)->get('/api/v1/invoice/search/'.$subscription->id);
        $response->assertStatus(200);

    }
    public function test_search_invoice_unauthorised(): void
    {
        $response = $this->get('/api/v1/invoice/search/3');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }

    public function test_download_invoice_success(): void
    {
        $user=User::where('email','operator3@gmail.com')->first();
        $subscription=$user->subscriptions()->first();
        $response = $this->actingAs($user)->get('/api/v1/invoice/'.$subscription->id.'/download/');
        $response->assertStatus(200);
    }

    public function test_download_invoice_unauthorised(): void
    {
        $response = $this->get('/api/v1/invoice/3/download/');
        $response->assertStatus(401);
        $response->assertJsonStructure([
            'message',
        ]);
    }
}
