<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            [
                'name' => 'access-hospital-sectors',
                'description' => 'Acessar setores hospitalares',
            ],
            [
                'name' => 'access-medical-specialties',
                'description' => 'Acessar especialidades médicas',
            ],
            [
                'name' => 'access-equipment',
                'description' => 'Acessar equipamentos',
            ],
            [
                'name' => 'access-care-units',
                'description' => 'Acessar unidades de atendimento',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                ['name' => $permission['name']],
                [
                    'guard_name' => 'web',
                    'description' => $permission['description'] ?? null,
                ]
            );
        }

        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'collaborator']);
    }
}
