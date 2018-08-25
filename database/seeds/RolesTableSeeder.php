<?php

use App\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Rol id = 1
        Role::create([
            'name' => 'Administrador',
            'description' => 'Rol administrador'
        ]);

        // Rol id = 2
        Role::create([
            'name' => 'Responsable',
            'description' => 'Rol responsable'
        ]);

        // Rol id = 3
        Role::create([
            'name' => 'Usuario',
            'description' => 'Rol usuario'
        ]);
    }
}
