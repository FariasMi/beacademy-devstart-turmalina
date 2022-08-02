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
            // Papéis
            [
            'name' => 'Chamex Multi',
            'quantity' => '50',
            'description' => 'Pacote Chamex Multi 200 unidades',
            'category' => 'papelaria',
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
            'category' => 'papelaria',
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
            'category' => 'papelaria',
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
            'category' => 'papelaria',
            'price' => '18',
            'sale_price' => '24',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/chamex-office.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Chamex Vai Brasil',
            'quantity' => '20',
            'description' => 'Chamex Edição Vai Brasil 200 unidades',
            'category' => 'papelaria',
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
            'category' => 'papelaria',
            'price' => '0.5',
            'sale_price' => '1.2',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/papel-vegetal.jpeg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],

            // Escritório
            [
            'name' => 'Calculadora Casio',
            'quantity' => '20',
            'description' => 'Calculadora',
            'category' => 'escritorio',
            'price' => '8',
            'sale_price' => '16',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/calculadora-casio.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Grampeador',
            'quantity' => '15',
            'description' => 'Grampeador de papel',
            'category' => 'escritorio',
            'price' => '6',
            'sale_price' => '8',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/grampeador.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Grampeador Rosa',
            'quantity' => '12',
            'description' => 'Grampeador de papel, só que rosa ;)',
            'category' => 'escritorio',
            'price' => '7',
            'sale_price' => '9',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/grampeador-2.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Grampeador A17',
            'quantity' => '7',
            'description' => 'Grampeador A17',
            'category' => 'escritorio',
            'price' => '10',
            'sale_price' => '19',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/grampeador A17.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [
            'name' => 'Grampeador Mini',
            'quantity' => '7',
            'description' => 'Grampeador para mãos pequenas',
            'category' => 'escritorio',
            'price' => '4',
            'sale_price' => '7',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/grampeador-mini.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
            [ 
            'name' => 'Maleta Dello',
            'quantity' => '7',
            'description' => 'Meleta de qualidade, olha como é bonita!',
            'category' => 'escritorio',
            'price' => '30',
            'sale_price' => '60',
            'photo' => Storage::disk('public')->putFile('products', new File('storage/app/public/imagens/maleta-dello.jpg')),
            'created_at' => now(),
            'updated_at' => now(),
            ],
        ]);
    }
}