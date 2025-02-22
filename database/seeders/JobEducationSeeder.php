<?php

namespace Database\Seeders;

use App\Models\Education;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $educations = [
            'No Formal Education',
            'Primary School',
            'Middle School',
            'High School',
            'Intermediate',
            'Associate Degree',
            'Bachelor\'s Degree',
            'Master\'s Degree',
            'PhD',
            'Postgraduate',
            'Postdoctoral',
            'Certification',
            'Diploma',
            'Vocational Training',
            'Technical Certification',
            'Polytechnic',
            'Trade School',
            'Professional Degree (MD, JD, DDS, DVM, etc.)',
            'Executive Education',
            'Online Course Certification',
            'Bootcamp Graduate',
            'Specialist Certification',
            'Chartered Qualification (CA, CFA, CPA, etc.)',
            'Fellowship Program',
            'Military Training',
            'Apprenticeship',
            'Continuing Education',
            'Honorary Degree',
            'Industry-Specific Training',
            'Medical Residency',
            'Clinical Fellowship',
            'Postgraduate Diploma',
            'Advanced Diploma',
            'Graduate Certificate',
            'Graduate Diploma',
            'Higher National Diploma (HND)',
            'Professional Licensure (RN, PE, PMP, etc.)',
            'Art & Design School',
            'Music Conservatory',
            'Film School',
            'Sports Coaching Certification',
            'Pilot License',
            'Maritime Studies & Certification',
            'Agricultural Science Training',
            'Environmental Studies',
            'Culinary Arts Certification',
            'Theology & Religious Studies',
            'Linguistics & Translation Training',
            'Library Science Degree',
            'Museum Studies',
            'Cybersecurity Certification (CEH, CISSP, etc.)',
            'Data Science & AI Certification',
            'Blockchain & Cryptocurrency Certification',
            'Space & Aeronautical Studies',
            'Ethical Hacking Certification',
            'Web Development & Programming Bootcamp',
            'Industrial Safety & Compliance Certification',
            'First Aid & Emergency Response Training',
            'Firefighting & Rescue Training',
            'Paramedic Training',
            'Social Work & Community Development Studies'
        ];


        foreach ($educations as $item) {
            # code...
            $create = new Education();
            $create->name = $item;
            $create->save();
        }
    }
}
