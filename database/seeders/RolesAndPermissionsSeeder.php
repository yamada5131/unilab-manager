<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tạo permissions
        Permission::firstOrCreate(['name' => 'manage users']);
        Permission::firstOrCreate(['name' => 'manage rooms']);
        Permission::firstOrCreate(['name' => 'manage computers']);
        Permission::firstOrCreate(['name' => 'install software']);
        Permission::firstOrCreate(['name' => 'view reports']);
        Permission::firstOrCreate(['name' => 'use room']);
        Permission::firstOrCreate(['name' => 'request support']);
        Permission::firstOrCreate(['name' => 'report issues']);

        // Cập nhật cache để nhận biết về permissions mới
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Tạo roles và gán permissions

        // Tạo role và gán permission riêng lẻ
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->givePermissionTo(['manage users', 'manage rooms', 'manage computers', 'install software', 'view reports']);

        // Gán permission cho vai trò manager
        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo(['manage rooms', 'manage computers', 'install software', 'view reports']);

        // Giảng viên với quyền sử dụng phòng và yêu cầu hỗ trợ
        $instructorRole = Role::firstOrCreate(['name' => 'instructor']);
        $instructorRole->givePermissionTo(['use room', 'request support']);

        // Sinh viên chỉ có quyền sử dụng phòng và báo cáo sự cố
        $studentRole = Role::firstOrCreate(['name' => 'student']);
        $studentRole->givePermissionTo(['use room', 'report issues']);
    }
}
