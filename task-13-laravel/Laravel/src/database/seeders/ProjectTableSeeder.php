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
        
        $userIds = Host::pluck('id')->toArray();

        // Generate random projects
        foreach (range(1, 10) as $index) {
            $project = new Project();
            $project->title = 'Project ' . $index;
            $project->status = rand(0, 1) ? 'ongoing' : 'completed';
            
            // Assign a random user ID from existing users
            $project->user_id = $userIds[array_rand($userIds)]; // Assuming user_id is a foreign key in the projects table

            $project->save();
        }
    }
}
