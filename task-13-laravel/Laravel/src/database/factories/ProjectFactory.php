<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

class ProjectFactory extends Factory
{
    protected $model = Project::class;
    public function definition()
    {
        $hosts = User::pluck('id')->toArray();
        return [
            'title' => fake()->sentence,
            'status' => fake()->randomElement(['ongoing', 'completed', 'pending', 'cancelled']),
            'user_id' => fake()->randomElement($hosts),
        ];
    }
}
