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
            ]);
        Plan::create([
                'name'=>'Silver',
                'price'=>499,
                'description'=>'Silver Plan',
            ]);
        Plan::create([
            'name'=>'Platinum',
            'price'=>299,
            'description'=>'Platinum Plan',
        ]);

    }
}
