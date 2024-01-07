<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $default_user_role = [
            "email_verified_at" => now(),
            "password" => Hash::make("password"),
            "remember_token" => Str::random(10),
        ];

        DB::beginTransaction();
        try {
            $superAdmin = User::create(array_merge([
                "username" => "superadmin",
                "email" => "superadmin@gmail.com",
                "name" => "superadmin",
            ], $default_user_role));

            $user = User::create(array_merge([
                "username" => "user",
                "name" => "user",
                "email" => "user@gmail.com",
            ], $default_user_role));

            $roleSuperAdmin = Role::create([ "name" => "superadmin" ]);
            $roleUser = Role::create([ "name" => "user" ]);

            Permission::create([ "name" => "read dashboard/about" ]);
            Permission::create([ "name" => "update dashboard/about" ]);

            $this->createPermission("faq");
            $this->createPermission("categories");
            $this->createPermission("consensus");
            $this->createPermission("documents");

            $roleSuperAdmin->givePermissionTo([
                'read dashboard/about', 'update dashboard/about',
                'create dashboard/documents', 'read dashboard/documents',
                'update dashboard/documents', 'delete dashboard/documents', 
                'create dashboard/faq', 'read dashboard/faq',
                'update dashboard/faq', 'delete dashboard/faq',
                'create dashboard/categories', 'read dashboard/categories',
                'update dashboard/categories', 'delete dashboard/faq',
                'create dashboard/consensus', 'read dashboard/consensus',
                'update dashboard/consensus', 'delete dashboard/consensus',
            ]);

            $superAdmin->assignRole('superadmin');
            $user->assignRole('user');

            DB::commit();
        } catch (\Throwable $th) {
            print('Error UserRolePermissionSeeder: ' . $th);
            DB::rollBack();
        }
    }

    public function createPermission(string $hostname)
    {
        Permission::create([ "name" => "create dashboard/" . $hostname ]);
        Permission::create([ "name" => "read dashboard/" . $hostname ]);
        Permission::create([ "name" => "update dashboard/" . $hostname ]);
        Permission::create([ "name" => "delete dashboard/" . $hostname ]);
    }
}
