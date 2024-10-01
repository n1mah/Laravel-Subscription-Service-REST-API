<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Subscription::create([
            'user_id'=>1,
            'plan_id'=>1,
            'start_date'=>Carbon::now(),
            'end_date'=>Carbon::now()->addDays(30),
            'status'=>'active',
        ]);
        Subscription::create([
            'user_id'=>2,
            'plan_id'=>2,
            'start_date'=>Carbon::now(),
            'end_date'=>Carbon::now()->addDays(30),
            'status'=>'active',
        ]);
        Subscription::create([
            'user_id'=>3,
            'plan_id'=>3,
            'start_date'=>Carbon::now(),
            'end_date'=>Carbon::now()->addDays(30),
            'status'=>'active',
        ]);
        Subscription::create([
            'user_id'=>3,
            'plan_id'=>3,
            'start_date'=>Carbon::now()->addDays(-90),
            'end_date'=>Carbon::now()->addDays(-60),
            'status'=>'expired',
        ]);
        Subscription::create([
            'user_id'=>3,
            'plan_id'=>3,
            'start_date'=>Carbon::now()->addDays(-150),
            'end_date'=>Carbon::now()->addDays(-120),
            'status'=>'expired',
        ]);
    }
}
