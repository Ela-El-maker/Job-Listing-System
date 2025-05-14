<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $admin_menus = array(
            array(
                "id" => 1,
                "name" => "Navigation Menu",
                "created_at" => NULL,
                "updated_at" => NULL,
            ),
            array(
                "id" => 4,
                "name" => "Footer Menu One",
                "created_at" => "2025-05-08 11:47:09",
                "updated_at" => "2025-05-08 11:47:09",
            ),
            array(
                "id" => 5,
                "name" => "Footer Menu Two",
                "created_at" => "2025-05-08 11:47:26",
                "updated_at" => "2025-05-08 11:47:26",
            ),
            array(
                "id" => 6,
                "name" => "Footer Menu Three",
                "created_at" => "2025-05-08 11:53:57",
                "updated_at" => "2025-05-08 11:53:57",
            ),
            array(
                "id" => 7,
                "name" => "Footer Menu Four",
                "created_at" => "2025-05-08 11:54:09",
                "updated_at" => "2025-05-08 11:54:09",
            ),
        );

        \DB::table('admin_menus')->insert($admin_menus);
    }
}
