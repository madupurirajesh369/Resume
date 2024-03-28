<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Project::class;
    public function definition()
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
