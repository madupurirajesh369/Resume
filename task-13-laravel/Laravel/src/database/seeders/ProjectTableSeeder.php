<?php

namespace Database\Seeders;

use App\Models\Host;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\Project;

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

        // Retrieve all hosts
        $hosts = DB::table('hosts')->pluck('id')->toArray();

        foreach (range(1, 10) as $index) {
            $title = $faker->sentence;
            $status = $faker->randomElement(['pending', 'in_progress', 'completed']);
            $user_id = $faker->randomElement($hosts);

            DB::table('projects')->insert([
                'title' => $title,
                'status' => $status,
                'user_id' => $user_id,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
