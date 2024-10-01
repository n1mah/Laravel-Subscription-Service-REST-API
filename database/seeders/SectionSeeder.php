<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $access_level_array = [3,2,1,2,1,3,2,3,1,3];
        for ($i = 0; $i < 10; $i++) {
            Section::create([
                'title'=>"Post ".$i+1,
                'content'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. '.$i+1,
                'access_level'=>$access_level_array[$i]
            ]);
        }
    }
}
