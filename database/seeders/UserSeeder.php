<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'operator 1',
            'email' => 'operator1@gmail.com',
            'password' => Hash::make('Abcd1234'),
        ]);
        User::create([
            'name' => 'operator 2',
            'email' => 'operator2@gmail.com',
            'password' => Hash::make('Abcd1234'),
        ]);
        User::create([
            'name' => 'operator 3',
            'email' => 'operator3@gmail.com',
            'password' => Hash::make('Abcd1234'),
        ]);
    }
}
