<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = array(
            array(
                "id" => 1,
                "name" => "dashboard analytics",
                "guard_name" => "admin",
                "group" => "Dashboard",
                "created_at" => "2025-05-15 09:40:43",
                "updated_at" => "2025-05-15 09:40:43",
            ),
            array(
                "id" => 2,
                "name" => "dashboard pending posts",
                "guard_name" => "admin",
                "group" => "Dashboard",
                "created_at" => "2025-05-15 09:41:00",
                "updated_at" => "2025-05-15 09:41:00",
            ),
            array(
                "id" => 3,
                "name" => "orders listings",
                "guard_name" => "admin",
                "group" => "Order",
                "created_at" => "2025-05-15 09:44:17",
                "updated_at" => "2025-05-15 09:44:17",
            ),
            array(
                "id" => 4,
                "name" => "job category create",
                "guard_name" => "admin",
                "group" => "Job Category",
                "created_at" => "2025-05-15 09:45:24",
                "updated_at" => "2025-05-15 09:45:24",
            ),
            array(
                "id" => 5,
                "name" => "job category update",
                "guard_name" => "admin",
                "group" => "Job Category",
                "created_at" => "2025-05-15 09:45:32",
                "updated_at" => "2025-05-15 09:45:32",
            ),
            array(
                "id" => 6,
                "name" => "job category delete",
                "guard_name" => "admin",
                "group" => "Job Category",
                "created_at" => "2025-05-15 09:45:44",
                "updated_at" => "2025-05-15 09:45:44",
            ),
            array(
                "id" => 7,
                "name" => "job create",
                "guard_name" => "admin",
                "group" => "Job",
                "created_at" => "2025-05-15 09:48:37",
                "updated_at" => "2025-05-15 09:48:37",
            ),
            array(
                "id" => 8,
                "name" => "job update",
                "guard_name" => "admin",
                "group" => "Job",
                "created_at" => "2025-05-15 09:48:48",
                "updated_at" => "2025-05-15 09:48:48",
            ),
            array(
                "id" => 9,
                "name" => "job delete",
                "guard_name" => "admin",
                "group" => "Job",
                "created_at" => "2025-05-15 09:48:56",
                "updated_at" => "2025-05-15 09:48:56",
            ),
            array(
                "id" => 10,
                "name" => "job role",
                "guard_name" => "admin",
                "group" => "Job Role",
                "created_at" => "2025-05-15 09:50:13",
                "updated_at" => "2025-05-15 09:50:13",
            ),
            array(
                "id" => 11,
                "name" => "job attributes",
                "guard_name" => "admin",
                "group" => "Job Attributes",
                "created_at" => "2025-05-15 09:52:27",
                "updated_at" => "2025-05-15 09:52:27",
            ),
            array(
                "id" => 12,
                "name" => "job locations",
                "guard_name" => "admin",
                "group" => "Job Locations",
                "created_at" => "2025-05-15 09:53:16",
                "updated_at" => "2025-05-15 09:53:16",
            ),
            array(
                "id" => 13,
                "name" => "sections",
                "guard_name" => "admin",
                "group" => "Site Sections",
                "created_at" => "2025-05-15 09:54:34",
                "updated_at" => "2025-05-15 09:54:34",
            ),
            array(
                "id" => 14,
                "name" => "Site Pages",
                "guard_name" => "admin",
                "group" => "Site Pages",
                "created_at" => "2025-05-15 09:55:23",
                "updated_at" => "2025-05-15 09:55:23",
            ),
            array(
                "id" => 15,
                "name" => "Site footer",
                "guard_name" => "admin",
                "group" => "Site Footer",
                "created_at" => "2025-05-15 09:56:47",
                "updated_at" => "2025-05-15 09:56:47",
            ),
            array(
                "id" => 16,
                "name" => "blogs",
                "guard_name" => "admin",
                "group" => "Blogs",
                "created_at" => "2025-05-15 09:58:45",
                "updated_at" => "2025-05-15 09:58:45",
            ),
            array(
                "id" => 17,
                "name" => "price plan",
                "guard_name" => "admin",
                "group" => "Price Plan",
                "created_at" => "2025-05-15 09:59:49",
                "updated_at" => "2025-05-15 09:59:49",
            ),
            array(
                "id" => 18,
                "name" => "newsletter",
                "guard_name" => "admin",
                "group" => "Newsletter",
                "created_at" => "2025-05-15 10:00:34",
                "updated_at" => "2025-05-15 10:00:34",
            ),
            array(
                "id" => 19,
                "name" => "menu builder",
                "guard_name" => "admin",
                "group" => "Menu Builder",
                "created_at" => "2025-05-15 10:01:20",
                "updated_at" => "2025-05-15 10:01:20",
            ),
            array(
                "id" => 20,
                "name" => "access management",
                "guard_name" => "admin",
                "group" => "Access Management",
                "created_at" => "2025-05-15 10:02:22",
                "updated_at" => "2025-05-15 10:02:22",
            ),
            array(
                "id" => 21,
                "name" => "payment settings",
                "guard_name" => "admin",
                "group" => "Payment Settings",
                "created_at" => "2025-05-15 10:03:27",
                "updated_at" => "2025-05-15 10:03:27",
            ),
            array(
                "id" => 22,
                "name" => "site settings",
                "guard_name" => "admin",
                "group" => "Site Settings",
                "created_at" => "2025-05-15 10:03:29",
                "updated_at" => "2025-05-15 10:03:29",
            ),
            array(
                "id" => 23,
                "name" => "database clear",
                "guard_name" => "admin",
                "group" => "Database Clear",
                "created_at" => "2025-05-15 10:03:33",
                "updated_at" => "2025-05-15 10:03:33",
            ),
        );

        \DB::table('permissions')->insert($permissions);

        $roles = array(
            array(
                "id" => 1,
                "name" => "Super Admin",
                "guard_name" => "admin",
                "created_at" => "2025-05-15 20:51:46",
                "updated_at" => "2025-05-15 20:51:46",
            ),
        );

        \DB::table('roles')->insert($roles);

        $role_has_permissions = array(
            array(
                "permission_id" => 1,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 2,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 3,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 4,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 5,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 6,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 7,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 8,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 9,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 10,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 11,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 12,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 13,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 14,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 15,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 16,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 17,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 18,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 19,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 20,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 21,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 22,
                "role_id" => 1,
            ),
            array(
                "permission_id" => 23,
                "role_id" => 1,
            ),
        );

        \DB::table('role_has_permissions')->insert($role_has_permissions);
    }
}
