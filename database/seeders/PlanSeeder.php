<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Plan::create([
                'name'=>'Gold',
                'price'=>999,
                'description'=>'Gold Plan',
            ],
            [
                'name'=>'Silver',
                'price'=>999,
                'description'=>'Silver Plan',
            ],[
                'name'=>'Platinum',
                'price'=>999,
                'description'=>'Platinum Plan',
            ]);
    }
}
