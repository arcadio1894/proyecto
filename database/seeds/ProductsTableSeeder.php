<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'name' => 'Receptor GPS GEO XT series 2008',
            'description' => '',
            'price' => 120.80,
            'money' => 'USD',
            'color' => 'Negro',
            'comment' => '',
            'state' => 1
        ]);

        Product::create([
            'name' => 'Protector de pantalla de celular',
            'description' => '',
            'price' => 200.00,
            'money' => 'PEN',
            'color' => 'Blanco',
            'comment' => '',
            'state' => 1
        ]);

        Product::create([
            'name' => 'Cargador - Transformador',
            'description' => '',
            'price' => 120.80,
            'money' => 'PEN',
            'color' => 'Naranja',
            'comment' => '',
            'state' => 1
        ]);

        Product::create([
            'name' => 'Cable Interface USB',
            'description' => '',
            'price' => 500.80,
            'money' => 'USD',
            'color' => 'Rojo',
            'comment' => '',
            'state' => 1
        ]);
    }
}
