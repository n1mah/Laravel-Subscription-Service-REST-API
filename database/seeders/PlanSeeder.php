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
            'name'=>'Bronze',
            'level'=>1,
            'price'=>299,
            'description'=>'Platinum Plan',
        ]);
        Plan::create([
            'name'=>'Silver',
            'level'=>2,
            'price'=>499,
            'description'=>'Silver Plan',
        ]);
        Plan::create([
            'name'=>'Gold',
            'level'=>3,
            'price'=>999,
            'description'=>'Gold Plan',
        ]);
    }
}
