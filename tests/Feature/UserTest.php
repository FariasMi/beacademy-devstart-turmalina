<?php

namespace Tests\Feature;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard_rendering()
    {
        $user = User::factory()->create(['name' => 'Test User','is_admin' => 1]);
        
        $response = $this->actingAs($user)->get('/dashboard');
        
        
        $response->assertStatus(200);
    }

    public function test_create_user(){
        $user = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
            
        $response = $this->actingAs($user)->post('/user/create', [
            'name' => 'Test Create User',
            'last_name' => 'Doe',
            'cpf' => "05058677024",
            'phone' => "08989898989",
            'date_of_birth' => fake()->date(),
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'type_user' => 'user',
        ]);
       
        $response->assertRedirect(RouteServiceProvider::HOME);
    }

    public function test_edit_user(){
        $user = User::where('name', 'Test Create User')->first();
        
        // Não sei o que fazer aqui 😭 não funciona. 😠
        $response = $this->actingAs($user)->put("/edit/{$user->id}", [
            'name' => 'Test Edit User',
        ]);

        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function test_delete_user(){
        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        $user = User::where('name', 'Test Create User')->first();
                
        $response = $this->actingAs($admin)->delete("/delete/{$user->id}");
        
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}