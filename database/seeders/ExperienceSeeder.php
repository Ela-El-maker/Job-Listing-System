<?php

namespace Database\Seeders;

use App\Models\Experience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        Experience::insert([
            ['name' => 'Fresher'],
            ['name' => '1 Year'],
            ['name' => '2 Years'],
            ['name' => '3 Years'],
            ['name' => '4 Years'],
            ['name' => '5 Years'],
            ['name' => '6-10 Years'],
            ['name' => '11-15 Years'],
            ['name' => '16-20 Years'],
            ['name' => '20+ Years'],
            ['name' => 'Amateur'],
            ['name' => 'Beginner'],
            ['name' => 'Junior'],
            ['name' => 'Associate'],
            ['name' => 'Intermediate'],
            ['name' => 'Internship'],
            ['name' => 'Entry Level'],
            ['name' => 'Junior Level'],
            ['name' => 'Mid Level'],
            ['name' => 'Senior Level'],
            ['name' => 'Lead Level'],
            ['name' => 'Managerial Level'],
            ['name' => 'Executive Level'],
            ['name' => 'Director Level'],
            ['name' => 'Chief Level'],
            ['name' => 'Specialist'],
            ['name' => 'Consultant'],
        ]);
    }
}
