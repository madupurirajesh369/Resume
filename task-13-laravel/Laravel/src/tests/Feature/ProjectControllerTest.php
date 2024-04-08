<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    public function testIndexRoute()
    {
        $response = $this->get('api/host/projects');
        $response->assertStatus(200);
        $response->assertViewIs('projects.index');
    }

    public function testCreateRoute()
    {
        $response = $this->get('api/host/projects/create');
        $response->assertStatus(200);
        $response->assertViewIs('projects.create');
    }
    public function testStoreMethodCreatesProject()
    {
        $user = User::factory()->create();
        $data = [
            'user_id' => $user->id,
            'title' => 'New Project',
            'status' => 'ongoing'
        ];

        $response = $this->postJson(route('projects.store'), $data);

        $response->assertStatus(302) // Or whatever status code your redirect returns
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', $data);
    }

    public function testShowRoute()
    {
        $user = User::factory()->create();
        $project = Project::factory()->create(['user_id' => $user->id]);

        $response = $this->get(route('projects.show', $user->id));

        $response->assertStatus(200)
            ->assertViewIs('projects.show')
            ->assertViewHas('projects', [$project])
            ->assertViewHas('user', $user);
    }

    public function testEditRoute()
    {
        $project = Project::factory()->create();

        $response = $this->get(route('projects.edit', $project->id));

        $response->assertStatus(200)
            ->assertViewIs('projects.edit')
            ->assertViewHas('project', $project);
    }

    public function testUpdateMethodUpdatesProject()
    {
        $project = Project::factory()->create();
        $data = [
            'title' => 'Updated Title',
            'status' => 'completed'
        ];

        $response = $this->putJson(route('projects.update', $project->id), $data);

        $response->assertStatus(302) // Or whatever status code your redirect returns
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', $data);
    }

    
}
