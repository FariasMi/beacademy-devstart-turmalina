<?php

namespace Tests\Feature;

use App\Models\Address;
use App\Models\Product;
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

    public function test_show_user(){
        $user = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        
        $response = $this->actingAs($user)->get("/user/{$user->id}");
        
        $response->assertStatus(200);
    }

    public function test_rendering_create_address(){
       $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        
       $response = $this->actingAs($admin)->get("/address/create/{$admin->id}");
        
       $response->assertStatus(200);
    }

    public function test_create_address(){
        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();

        $response = $this->actingAs($admin)->post("/address/create/{$admin->id}", [
            'street' => 'Rua Teste',
            'number' => '123',
            'complement' => 'Apto. 123',
            'neighborhood' => 'Bairro Teste',
            'city' => 'Cidade Teste',
            'state' => 'SP',
            'zip_code' => '12345-678',
            'country' => 'Brasil',
        ]);

        $response->assertRedirect("/user/{$admin->id}");
    }

    public function test_delete_address(){
        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        $address_id = Address::where('user_id', $admin->id)->first()->id;
        
        $response = $this->actingAs($admin)->delete("/address/delete/{$address_id}");
        
        $response->assertRedirect("/user/{$admin->id}");
    }

    public function test_rendering_create_user(){
        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        
        $response = $this->actingAs($admin)->get("/user/create");
        
        $response->assertStatus(200);
    }

    public function test_search_user(){

        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        
        $response = $this->actingAs($admin)->get("dashboard?search={$admin->id}");
        
        $response->assertStatus(200);
    }

    public function test_search_user_not_found(){

        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        
        $response = $this->actingAs($admin)->get("dashboard?search=123");
        
        $response->assertStatus(200);
    }

    public function test_make_order(){
        $admin = User::where('name', 'Test User')->orWhere('is_admin', 1)->first();
        $product = Product::factory()->create([
            'name' => 'Chamex Carta',
            'quantity' => '40',
            'description' => 'Papel Carta Chamex 150 unidades',
            'category' => 'papelaria',
            'price' => '12',
            'sale_price' => '16',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        $response = $this->actingAs($admin)->post("cart/store", [
            'product_id' => $product->id,
            'user_id' => $admin->id,
            'price' => $product->price,
        ]);
        
        $response->assertRedirect("/cart");
        Product::destroy($product->id);
    }
}