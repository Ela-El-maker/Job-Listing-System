<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $top_job_categories = array(
            "Healthcare",
            "Technology",
            "Business and Finance",
            "Education",
            "Construction",
            "Manufacturing",
            "Sales and Marketing",
            "Transportation and Logistics",
            "Green Jobs",
            "Creative and Media",
            "Customer Service",
            "Hospitality and Tourism",
            "Legal Services",
            "Engineering",
            "Government and Public Administration",
            "Social Services",
            "Science and Research",
            "Real Estate",
            "Telecommunications",
            "Retail",
            "Human Resources",
            "Security and Law Enforcement",
            "Automotive",
            "Food and Beverage",
            "Sports and Recreation",
            "Pharmaceuticals",
            "Agriculture and Farming",
            "Energy and Utilities",
            "Fashion and Beauty",
            "Aerospace and Aviation",
            "Environmental Science",
            "Data Science and Analytics",
            "Artificial Intelligence and Machine Learning",
            "Blockchain and Cryptocurrency",
            "E-commerce",
            "Cybersecurity",
            "Event Management",
            "Writing and Publishing",
            "Non-Profit and Volunteering",
            "Biomedical Engineering",
            "Robotics",
            "Cloud Computing",
            "Game Development",
            "Augmented Reality (AR) & Virtual Reality (VR)",
            "Nanotechnology",
            "Quantum Computing",
            "Ethical Hacking",
            "DevOps and Site Reliability Engineering",
            "UI/UX Design",
            "3D Printing and Additive Manufacturing",
            "Geographic Information Systems (GIS)",
            "Meteorology and Climate Science",
            "Forensic Science",
            "Marine Biology and Oceanography",
            "Archaeology and Anthropology",
            "Linguistics and Translation",
            "Music and Performing Arts",
            "Film and Television Production",
            "Podcasting and Digital Media",
            "Fitness and Personal Training",
            "Mental Health Counseling",
            "Veterinary Medicine",
            "Childcare and Early Childhood Education",
            "Special Education",
            "Elderly Care and Geriatrics",
            "Disaster Management and Emergency Services",
            "Urban Planning and Architecture",
            "Library and Archival Science",
            "Military and Defense",
            "Space Exploration and Astronomy",
            "Ethnobotany and Herbal Medicine",
            "Professional Sports Coaching",
            "Tattoo Artistry and Body Modification",
            "Luxury Goods and Personal Services",
            "Handmade Crafts and Artisanal Goods",
            "Sustainable and Ethical Fashion",
            "Drone Technology and UAV Operations",
            "Automated and Self-Driving Vehicle Development",
            "Cryptographic Security and Digital Forensics",
            "Neuroscience and Brain Research",
            "Bioinformatics and Computational Biology",
            "Public Relations and Corporate Communications",
            "Supply Chain and Inventory Management",
            "Consumer Electronics and Gadgets",
            "Pet Grooming and Animal Training",
            "Theme Park and Amusement Management",
            "Space Tourism",
            "Firefighting and Emergency Response",
            "Renewable Energy and Clean Tech",
            "Waste Management and Recycling",
            "Hydrology and Water Resource Management",
            "Paleontology",
            "Rural Development and Cooperative Societies",
            "Political Strategy and Campaign Management",
            "Luxury Real Estate Development",
            "Antique Restoration and Appraisal",
            "Furniture Design and Interior Styling",
            "Perfume and Fragrance Industry",
            "Tea and Coffee Tasting and Blending",
            "Gastronomy and Molecular Cuisine",
            "Wildlife Conservation and Forestry",
            "Astrobiology and Extraterrestrial Research",
            "Park Ranger and Conservation Officer",
            "Social Media Influencing and Content Creation",
            "Subscription Box Services and Curation",
            "Business Intelligence and Market Research",
            "Public Speaking and Motivational Coaching"
        );

        foreach ($top_job_categories as $item) {
            # code...
            $create = new JobCategory();
            $create->icon = 'fas fa-dot-circle';
            $create->name = $item;
            $create->save();
        }
    }
}
