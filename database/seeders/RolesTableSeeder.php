<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $roles = ['super admin', 'admin', 'consultor', 'gerente', 'supervisor', 'operador'];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }
    }
}


