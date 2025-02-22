<?php

namespace Database\Seeders;

use App\Models\JobExperience;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobExperienceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $job_experiences = [
            'Fresher',
            '1 Year',
            '2 Years',
            '3 Years',
            '4 Years',
            '5 Years',
            '6-10 Years',
            '11-15 Years',
            '16-20 Years',
            '20+ Years',
            'Amateur',
            'Beginner',
            'Junior',
            'Associate',
            'Intermediate',
            'Internship',
            'Entry Level',
            'Junior Level',
            'Mid Level',
            'Senior Level',
            'Lead Level',
            'Managerial Level',
            'Executive Level',
            'Director Level',
            'Chief Level',
            'Specialist',
            'Consultant',
            'Apprentice',
            'Trainee',
            'Skilled Professional',
            'Master Level',
            'Subject Matter Expert (SME)',
            'Thought Leader',
            'Professor',
            'Researcher',
            'Industry Veteran',
            'Entrepreneur',
            'Advisor',
            'Mentor',
            'Freelancer',
            'Independent Consultant',
            'C-Suite Executive',
            'Board Member',
        ];

        foreach ($job_experiences as $item) {
            $create = new JobExperience();
            $create->name = $item;
            $create->save();
        }
    }
}
