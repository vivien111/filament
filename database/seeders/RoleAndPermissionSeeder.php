<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Créer des permissions si elles n'existent pas déjà
        Permission::firstOrCreate(['name' => 'view integrations']);
        Permission::firstOrCreate(['name' => 'edit integrations']);
        Permission::firstOrCreate(['name' => 'delete integrations']);

        // Créer des rôles s'ils n'existent pas déjà
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $managerRole = Role::firstOrCreate(['name' => 'manager']);

        // Attribuer des permissions aux rôles
        $adminRole->givePermissionTo(['view integrations', 'edit integrations', 'delete integrations']);
        $managerRole->givePermissionTo(['view integrations', 'edit integrations']);
    }
}
