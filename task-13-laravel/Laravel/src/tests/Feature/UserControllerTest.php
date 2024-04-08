<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use Dotenv\Parser\Value;
use Laravel\Sanctum\Sanctum;

class UserControllerTest extends TestCase
{
    public function testIndexRoute()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    
    public function testCreateRoute()
    {
        $response = $this->get('/users/create');
        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    
    public function testStoreRoute()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        $response = $this->post('/users', $data);
        $this->assertDatabaseHas('users', $data);
    }

    
    public function testShowRoute()
    {
        $user = User::factory()->create();
        $response = $this->get('/users/' . $user->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function testEditRoute()
    {
        $user = User::factory()->create();
        $response = $this->get('/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    
    public function testUpdateRoute()
    {
        $user = User::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->put('/users/' . $user->id, $data);
        $this->assertDatabaseHas('users', $data);
    }

    
    public function testDestroyRoute()
    {
        $user = User::factory()->create();
        $response = $this->delete('/users/' . $user->id);
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function testIndexPageContainsData()
    {
        $firstUser = User::first();
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertSee($firstUser->name);
        $response->assertSee($firstUser->email);
    }

    public function testIndexPageContainsNoData()
    {
       // Host::truncate();
        $response = $this->get('/users');
        $response->assertStatus(200);
        $response->assertDontSee('John Doe');
        $response->assertDontSee('john@example.com');
    } 

    public function testSixthRecordNotInFirstPage()
    {
        $response = $this->get('/users');
        $response->assertStatus(200);
        for ($i = 1; $i <= 5; $i++) {
            $user = User::find($i);
            $response->assertSee($user->name);
        }
        $sixthUser = User::find(6);
        $response->assertDontSee($sixthUser->name);
    }

    public function testNewUserRecordIsSavedInDatabase()
    {
        $userData = [
            'name' => 'Virat',
            'email' => 'virat@example.com',
        ];
        $response = $this->post('/users', $userData);
        $response->assertStatus(302);
        $User = User::where('email', $userData['email'])->first();
        $this->assertNotNull($User);
        $this->assertEquals($userData['name'], $User->name);
        $this->assertEquals($userData['email'], $User->email);
    } 

    public function testCorrectValuesInInputsWhenEditingUser()
    {
        $users = User::all();
        $user = $users->first();
        $response = $this->get('/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee('value="' . $user->name . '"', escape:false);
       // $response->assertSee('value="' . $user->email . '"', escape:false);
    } 

    public function testUpdateUserValidationErrors()
    {
        $users = User::all();
        $user = $users->first();
        $response = $this->put('/users/' . $user->id, [
            'name' => '',
            'email' => '',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email']);
    } 

    public function testUserIsRemoved()
    {
        $users = User::all();
        $user = $users->first();
        $this->assertDatabaseHas('hosts', ['id' => $user->id]);
        $response = $this->delete('/users/' . $user->id);
        $response->assertRedirect('/users');
        $this->assertDatabaseMissing('hosts', ['id' => $user->id]);
    } 

    public function testFetchUserById()
    {
        $user = User::first();
        $response = $this->get('/users/' . $user->id);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    } 
}
