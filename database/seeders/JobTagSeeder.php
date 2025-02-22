<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JobTagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $job_tags = array(
            "remote-friendly",
            "fully-distributed",
            "hybrid-work",
            "onsite-only",
            "software-development",
            "data-science",
            "cybersecurity",
            "cloud-computing",
            "open-source-experience",
            "agile-methodology",
            "scrum-master",
            "devops",
            "machine-learning",
            "artificial-intelligence",
            "blockchain",
            "fintech",
            "healthtech",
            "edtech",
            "gaming-industry",
            "UI/UX-design",
            "graphic-design",
            "digital-marketing",
            "seo-specialist",
            "content-creation",
            "copywriting",
            "strong-communication-skills",
            "time-zone-flexibility",
            "global-collaboration",
            "multilingual",
            "startup-environment",
            "corporate-culture",
            "non-profit-sector",
            "government-jobs",
            "freelance-friendly",
            "contract-based",
            "part-time-available",
            "full-time-opportunity",
            "internship-opportunity",
            "work-life-balance",
            "flexible-hours",
            "four-day-workweek",
            "continuous-learning",
            "training-provided",
            "certification-required",
            "mentorship-available",
            "leadership-role",
            "team-management",
            "high-growth-opportunity",
            "competitive-benefits",
            "401k-matching",
            "health-insurance",
            "wellness-programs",
            "tuition-reimbursement",
            "equity-compensation",
            "stock-options",
            "annual-bonuses",
            "commission-based",
            "profit-sharing",
            "contract-to-hire",
            "diverse-and-inclusive",
            "LGBTQ+-friendly",
            "women-in-tech",
            "accessible-workplace",
            "positive-company-culture",
            "collaborative-team",
            "impactful-work",
            "mission-driven",
            "customer-focused",
            "fast-paced-environment",
            "remote-onboarding",
            "international-team",
            "employee-resource-groups",
            "pet-friendly-office",
            "relocation-assistance",
            "green-company",
            "social-impact",
            "volunteer-opportunities",
            "cutting-edge-technology",
            "travel-required",
            "visa-sponsorship-available"
        );

        foreach ($job_tags as $item) {
            $create = new Tag();
            $create->name = $item;
            $create->save();
        }
    }
}
