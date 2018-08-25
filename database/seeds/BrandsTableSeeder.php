<?php

use App\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create([
            'name' => 'Samsumg'
        ]);

        Brand::create([
            'name' => 'LG'
        ]);

        Brand::create([
            'name' => 'Xiaomi'
        ]);

        Brand::create([
            'name' => 'Asus'
        ]);
    }
}
