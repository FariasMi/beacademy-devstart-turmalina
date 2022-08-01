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
        
        User::destroy($user->id);
       
        $response->assertRedirect(RouteServiceProvider::HOME);
    }
}