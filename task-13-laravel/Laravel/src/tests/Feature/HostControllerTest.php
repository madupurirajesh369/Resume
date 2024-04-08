<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Host;
use Dotenv\Parser\Value;
use Laravel\Sanctum\Sanctum;

class HostControllerTest extends TestCase
{
   // use RefreshDatabase;

    public function testIndexRoute()
    {
        $response = $this->get('api/host/users');
        $response->assertStatus(200);
        $response->assertViewIs('users.index');
    }

    
    public function testCreateRoute()
    {
        $response = $this->get('api/host/users/create');
        $response->assertStatus(200);
        $response->assertViewIs('users.create');
    }

    
    public function testStoreRoute()
    {
        $data = [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ];

        $response = $this->post('api/host/users', $data);
        $response->assertRedirect('api/host/users');
        $this->assertDatabaseHas('hosts', $data);
    }

    
    public function testShowRoute()
    {
        $user = Host::factory()->create();
        $response = $this->get('api/host/users/' . $user->id);
        $response->assertStatus(200);
        $response->assertJsonFragment([
            'name' => $user->name,
            'email' => $user->email,
        ]);
    }

    public function testEditRoute()
    {
        $user = Host::factory()->create();
        $response = $this->get('api/host/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertViewIs('users.edit');
    }

    
    public function testUpdateRoute()
    {
        $user = Host::factory()->create();
        $data = [
            'name' => 'Updated Name',
            'email' => 'updated@example.com',
        ];

        $response = $this->put('api/host/users/' . $user->id, $data);
        $response->assertRedirect('api/host/users');
        $this->assertDatabaseHas('hosts', $data);
    }

    
    public function testDestroyRoute()
    {
        $user = Host::factory()->create();
        $response = $this->delete('api/host/users/' . $user->id);
        $response->assertRedirect('api/host/users');
        $this->assertDatabaseMissing('hosts', ['id' => $user->id]);
    }

    public function testIndexPageContainsData()
    {
        $firstUser = Host::first();
        $response = $this->get('api/host/users');
        $response->assertStatus(200);
        $response->assertSee($firstUser->name);
        $response->assertSee($firstUser->email);
    }

    public function testIndexPageContainsNoData()
    {
       // Host::truncate();
        $response = $this->get('api/host/users');
        $response->assertStatus(200);
        $response->assertDontSee('John Doe');
        $response->assertDontSee('john@example.com');
    } 

    public function testSixthRecordNotInFirstPage()
    {
        $response = $this->get('api/host/users');
        $response->assertStatus(200);
        for ($i = 1; $i <= 5; $i++) {
            $user = Host::find($i);
            $response->assertSee($user->name);
        }
        $sixthUser = Host::find(6);
        $response->assertDontSee($sixthUser->name);
    }

    public function testNewUserRecordIsSavedInDatabase()
    {
        $userData = [
            'name' => 'Virat',
            'email' => 'virat@example.com',
        ];
        $response = $this->post('api/host/users', $userData);
        $response->assertStatus(302);
        $User = Host::where('email', $userData['email'])->first();
        $this->assertNotNull($User);
        $this->assertEquals($userData['name'], $User->name);
        $this->assertEquals($userData['email'], $User->email);
    } 

    public function testCorrectValuesInInputsWhenEditingUser()
    {
        $users = Host::all();
        $user = $users->first();
        $response = $this->get('api/host/users/' . $user->id . '/edit');
        $response->assertStatus(200);
        $response->assertSee('value="' . $user->name . '"', escape:false);
       // $response->assertSee('value="' . $user->email . '"', escape:false);
    } 

    public function testUpdateUserValidationErrors()
    {
        $users = Host::all();
        $user = $users->first();
        $response = $this->put('/api/host/users/' . $user->id, [
            'name' => '',
            'email' => '',
        ]);
        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'email']);
    } 

    public function testUserIsRemoved()
    {
        $users = Host::all();
        $user = $users->first();
        $this->assertDatabaseHas('hosts', ['id' => $user->id]);
        $response = $this->delete('/api/host/users/' . $user->id);
        $response->assertRedirect('/api/host/users');
        $this->assertDatabaseMissing('hosts', ['id' => $user->id]);
    } 

    public function testFetchUserById()
    {
        $user = Host::first();
        $response = $this->get('api/host/users/' . $user->id);
        $response->assertJson([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ]);
    } 



   /* public function testFetchAllUsers()
    {
        
    } 
    public function test_api_user_store_successful()
    {
        
    } */



    
}
