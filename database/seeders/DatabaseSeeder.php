<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
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
}