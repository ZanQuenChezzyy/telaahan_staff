<?php

namespace Database\Seeders;

use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Step 1: Buat Permissions
        $permissions = [
            'view telaahan',
            'create telaahan',
            'edit telaahan',
            'delete telaahan',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Step 2: Buat Roles
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $userRole = Role::firstOrCreate(['name' => 'User']);

        // Step 3: Assign Permissions ke Roles
        $adminRole->syncPermissions($permissions);
        $userRole->givePermissionTo(['view telaahan', 'create telaahan']);

        // Step 4: Buat Units
        $units = [
            ['nama' => 'Admin', 'deskripsi' => 'Administrator Aplikasi'],
            ['nama' => 'Umum', 'deskripsi' => 'Unit Umum'],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate($unit);
        }

        // Ambil unit ID
        $adminUnit = Unit::where('nama', 'Admin')->first()->id;
        $umumUnit = Unit::where('nama', 'Umum')->first()->id;

        // Step 5: Buat User Admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@rsud.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('12345678'),
                'unit_id' => $adminUnit,
            ]
        );
        $admin->assignRole('Admin');

        // Step 6: Buat User Biasa
        $user = User::firstOrCreate(
            ['email' => 'umum@rsud.com'],
            [
                'name' => 'Unit Umum',
                'password' => Hash::make('12345678'),
                'unit_id' => $umumUnit,
            ]
        );
        $user->assignRole('User');

        // Output ke console untuk memastikan seeder berhasil dijalankan
        $this->command->info('Seeder telah berhasil dijalankan: Role, Permission, Unit, dan User telah dibuat.');
    }
}
