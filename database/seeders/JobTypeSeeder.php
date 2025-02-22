<?php

namespace Database\Seeders;

use App\Models\JobType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //
        $job_types = array(
            "Full-time",
            "Part-time",
            "Contract",
            "Temporary",
            "Remote",
            "Freelance",
            "Internship",
            "Entry-level",
            "Mid-level",
            "Senior-level",
            "Volunteer",
            "Apprenticeship",
            "Commission-based",
            "Seasonal",
            "Consulting",
            "Gig Work",
            "Shift-based",
            "Per Diem",
            "Self-employed",
            "Casual",
            "On-call",
            "Hybrid",
            "Rotational",
            "Fixed-term",
            "Probationary",
            "Flexible Hours",
            "Overtime",
            "Job Sharing",
            "Night Shift",
            "Weekend Shift"
        );


        foreach ($job_types as $item) {
            # code...
            $create = new JobType();
            $create->name = $item;
            $create->save();
        }
    }
}
