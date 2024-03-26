<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ProjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('projects')->insert([
                'title' => $faker->sentence,
                'status' => $faker->randomElement(['ongoing', 'completed', 'pending']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
