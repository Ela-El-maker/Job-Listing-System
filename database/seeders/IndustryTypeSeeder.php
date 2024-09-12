<?php

namespace Database\Seeders;

use App\Models\IndustryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IndustryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $industryTypes = [
            'Technology',
            'Financial Services',
            'Manufacturing',
            'Energy',
            'Retail',
            'Telecommunications',
            'Agriculture',
            'Transportation and Logistics',
            'Healthcare',
            'Entertainment and Media',
            'Construction',
            'Automotive',
            'Tourism and Hospitality',
            'Education',
            'Real Estate',
            'Pharmaceutical',
            'Consumer Goods',
            'Environmental',
            'Defense and Aerospace',
            'Legal and Professional Services',
        ];

        foreach($industryTypes as $type)
        {
            $industryType = new IndustryType();
            $industryType-> name = $type;
            $industryType->save();
        }
    }
}
