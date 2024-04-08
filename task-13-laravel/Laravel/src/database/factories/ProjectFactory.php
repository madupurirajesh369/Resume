<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Host;

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
        $hosts = Host::pluck('id')->toArray();
        return [
            'title' => fake()->sentence,
            'status' => fake()->randomElement(['ongoing', 'completed', 'pending', 'cancelled']),
            'user_id' => fake()->randomElement($hosts),
        ];
       
    }
}
