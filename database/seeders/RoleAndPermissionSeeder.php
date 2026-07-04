<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;


class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            ['name' => 'access-hospital-sectors',   'display_name' => 'Setores Hospitalares'],
            ['name' => 'access-medical-specialties', 'display_name' => 'Especialidades Médicas'],
            ['name' => 'access-equipment',           'display_name' => 'Equipamentos'],
            ['name' => 'access-care-units',          'display_name' => 'Unidades Assistenciais'],
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission['name']]);
        }

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'collaborator']);
    }
}
