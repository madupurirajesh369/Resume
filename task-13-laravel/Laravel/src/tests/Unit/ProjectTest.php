<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Project;

class ProjectTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_example()
    {
        $this->assertTrue(true);
    }

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

        $response->assertStatus(302) 
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', $data);
    }

    public function testShowRoute()
    {
        $response = $this->get('api/host/projects/1');
        $response->assertStatus(200);
        $response->assertViewIs('projects.show');
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

        $response->assertStatus(302) 
            ->assertSessionHas('success');

        $this->assertDatabaseHas('projects', $data);
    }
}
