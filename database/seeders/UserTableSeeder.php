<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!User::where('cpf', '38406720077')->first()){
            DB::table('users')->insert(
                [
                'name' => 'John',
                'last_name' => 'Doe',
                'cpf' => "38406720077",
                'phone' => "00000000000",
                'date_of_birth' => '2000-01-01',
                'email' => 'john.doe@email.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 1,
                ]);      
        }
        
        if (!User::where('cpf', '74311121067')->first()){
            DB::table('users')->insert(
                [
                'name' => 'Jane',
                'last_name' => 'Doe',
                'cpf' => "74311121067",
                'phone' => "00000000001",
                'date_of_birth' => '2000-01-01',
                'email' => 'jane.doe@email.com',
                'password' => bcrypt('12345678'),
                'is_admin' => 0,
                ]);      
        }
    }
}