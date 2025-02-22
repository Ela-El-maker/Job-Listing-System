<?php

namespace Database\Seeders;

use App\Models\SalaryType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobSalaryTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $salary_types = array(
            "Monthly",
            "Hourly",
            "Yearly",
            "Project Basis",
            "Weekly",
            "Bi-Weekly",
            "Daily",
            "Commission-Based",
            "Performance-Based",
            "Retainer",
            "Equity-Based",
            "Profit-Sharing",
            "Contract-Based",
            "Stipend",
            "Task-Based",
            "Piece Rate",
            "Bonuses & Incentives",
            "Royalties",
            "Revenue Share"
        );

        foreach ($salary_types as $item) {
            $create = new SalaryType();
            $create->name = $item;
            $create->save();
        }
    }
}
