<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Admin::updateOrCreate(
            ['email' => 'superadmin@elakali.com'], // Find admin by email
            [
                'name' => 'Super Admin',
                'image' => '/default-uploads/avatar/pngwing.com(13).png',
                'password' => Hash::make('password'),
            ]
        );
    }
}
