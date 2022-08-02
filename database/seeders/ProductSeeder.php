<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            [
            'name' => 'Chamex Multi',
            'quantity' => '50',
            'description' => 'Pacote Chamex Multi 200 unidades',
            'category' => 'papeis',
            'price' => '10',
            'sale_price' => '14',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Chamex Carta',
            'quantity' => '40',
            'description' => 'Papel Carta Chamex 150 unidades',
            'category' => 'papeis',
            'price' => '12',
            'sale_price' => '16',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex-carta.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Chamex Colors',
            'quantity' => '60',
            'description' => 'Pacote Chamex Colors 100 unidades',
            'category' => 'papeis',
            'price' => '14',
            'sale_price' => '18',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex-colors.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Chamex Office',
            'quantity' => '70',
            'description' => 'Pacote Chamex Office 200 unidades',
            'category' => 'papeis',
            'price' => '18',
            'sale_price' => '24',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex-office.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Chamex Vai Brasil',
            'quantity' => '20',
            'description' => 'Pacote Chamex Edição Limitada Vai Brasil 200 unidades',
            'category' => 'papeis',
            'price' => '25',
            'sale_price' => '36',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex-vai-brasil.jpeg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Papel Vegetal Unidade',
            'quantity' => '800',
            'description' => 'Papel Vegetal',
            'category' => 'papeis',
            'price' => '0.5',
            'sale_price' => '1.2',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/papel-vegetal.jpeg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            
        ]);
    }
}