<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class CollaboratorUserSeeder extends Seeder
{
    public function run(): void
    {
        $collaborator = User::firstOrCreate(
            ['email' => 'collaborator@medaccess.com'],
            [
                'name' => 'Colaborador',
                'password' => '12345@medaccess',
            ]
        );

        $collaborator->syncRoles('collaborator');
    }
}