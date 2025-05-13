<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Candidate;
use App\Models\CandidateSkill;
use App\Models\Company;
use App\Models\Job;
use App\Models\Order;
use App\Models\User;
use App\Traits\Searchable;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    use Searchable;
    //


    function index(): View
    {
        $allUsers = User::count();
        $amounts = Order::pluck('default_amount')->toArray();
        $totalEarnings = calculateEarnings($amounts);

        $totalVisibleCandidates = Candidate::where(['profile_complete' => 1, 'visibility' => 1])->count();
        $totalVisibleCompanies = Company::where(['profile_completion' => 1, 'visibility' => 1])->count();
        $totalCandidates = Candidate::count();
        $totalCompanies = Company::count();
        $totalOrders = Order::count();
        $totalJobs = Job::count();
        $totalActiveJobs = Job::where('status', 'active')->where('deadline', '>=', now())->count();
        $totalPendingJobs = Job::where('status', 'pending')->where('deadline', '>=', now())->count();
        $totalExpiredJobs = Job::where('deadline', '<', now())->count();
        $totalBlogs = Blog::count();

        // Get monthly earnings for the current year
        $totalEarningsMonthly = Order::select(
            DB::raw("SUM(default_amount) as total"),
            DB::raw("MONTH(created_at) as month")
        )
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->pluck('total', 'month')
            ->toArray();

        // Ensure all months are present (even with 0 earnings)
        $months = range(1, 12);
        foreach ($months as $month) {
            if (!array_key_exists($month, $totalEarningsMonthly)) {
                $totalEarningsMonthly[$month] = 0;
            }
        }

        $monthlyRegistrations = User::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->groupBy('month')->pluck('count', 'month');

        $monthlyEarnings = Order::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')->pluck('total', 'month');

        // Sort months
        ksort($totalEarningsMonthly);

        $query = Job::query();
        $this->search($query, ['title', 'slug', 'status', 'created_at', 'updated_at']);
        $jobs = $query->where('status', 'pending')->orderBy('created_at', 'DESC')->paginate(5);

        $stats = [
            'total_jobs' => Job::count(),
            'active_jobs' => Job::where('status', 'active')->count(),
            'pending_jobs' => Job::where('status', 'pending')->count(),
            'expired_jobs' => Job::where('deadline', '<', now())->count(),
            'total_blogs' => Blog::count(),
        ];

        // New dynamic data for charts
        $userRegistrations = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $earningsData = Order::selectRaw('DATE(created_at) as date, SUM(default_amount) as total')
            ->where('created_at', '>=', now()->subDays(30))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $jobStatusData = [
            'active' => Job::where('status', 'active')->where('deadline', '>=', now())->count(),
            'pending' => Job::where('status', 'pending')->count(),
            'expired' => Job::where('deadline', '<', now())->count(),
        ];

        $candidateGrowth = Candidate::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();

        $companyGrowth = Company::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count')
            ->where('created_at', '>=', now()->subYear())
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get();


        $topCompanies = Company::withCount([
            'jobs' => function ($query) {
                $query->whereDate('deadline', '>=', Carbon::today());
            },
            'orders',
            'applications as applications_count' => function ($query) {
                $query->whereHas('job', function ($q) {
                    $q->whereDate('deadline', '>=', Carbon::today());
                });
            }
        ])->paginate(5);


        return view('admin.dashboard.index', compact(
            'allUsers',
            'jobs',
            'totalEarnings',
            'totalVisibleCompanies',
            'totalVisibleCandidates',
            'totalCandidates',
            'totalCompanies',
            'totalOrders',
            'totalJobs',
            'totalActiveJobs',
            'totalPendingJobs',
            'totalExpiredJobs',
            'totalBlogs',
            'totalEarningsMonthly',
            'monthlyEarnings',
            'monthlyRegistrations',
            'stats',
            'userRegistrations',
            'earningsData',
            'jobStatusData',
            'candidateGrowth',
            'companyGrowth',
            'topCompanies'
        ));
    }

    // In DashboardController
    public function userRegistrations(Request $request)
    {
        $days = $request->get('days', 30);

        $data = User::selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->where('created_at', '>=', now()->subDays($days))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return response()->json([
            'labels' => $data->pluck('date'),
            'data' => $data->pluck('count')
        ]);
    }

    public function earnings(Request $request)
    {
        $range = $request->get('range', 'weekly');

        $query = Order::query();

        switch ($range) {
            case 'daily':
                $query->selectRaw('DATE(created_at) as date, SUM(default_amount) as total')
                    ->where('created_at', '>=', now()->subDays(30));
                break;
            case 'weekly':
                $query->selectRaw('YEAR(created_at) as year, WEEK(created_at) as week, SUM(default_amount) as total')
                    ->where('created_at', '>=', now()->subWeeks(12));
                break;
            case 'monthly':
                $query->selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, SUM(default_amount) as total')
                    ->where('created_at', '>=', now()->subMonths(12));
                break;
        }

        $data = $query->groupBy(
            $range === 'daily' ? 'date' : ($range === 'weekly' ? ['year', 'week'] : ['year', 'month'])
        )
            ->orderBy($range === 'daily' ? 'date' : 'year')
            ->get();

        $labels = $data->map(function ($item) use ($range) {
            if ($range === 'daily') return $item->date;
            if ($range === 'weekly') return "Week {$item->week}, {$item->year}";
            return date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year));
        });

        return response()->json([
            'labels' => $labels,
            'data' => $data->pluck('total')
        ]);
    }

    public function growthComparison(Request $request)
    {
        $range = $request->get('range', 'yearly');

        $labels = [];
        $candidateData = [];
        $companyData = [];

        switch ($range) {
            case 'monthly':
                $months = 12;
                $format = 'M Y';
                $subFn = 'subMonths';
                $groupBy = ['year', 'month'];
                $selectRaw = 'YEAR(created_at) as year, MONTH(created_at) as month, COUNT(*) as count';
                break;
            case 'quarterly':
                $months = 12; // 4 quarters
                $format = 'Q Y';
                $subFn = 'subMonths';
                $groupBy = ['year', 'quarter'];
                $selectRaw = 'YEAR(created_at) as year, QUARTER(created_at) as quarter, COUNT(*) as count';
                break;
            case 'yearly':
                $months = 36; // 3 years
                $format = 'Y';
                $subFn = 'subYears';
                $groupBy = ['year'];
                $selectRaw = 'YEAR(created_at) as year, COUNT(*) as count';
                break;
        }

        // Generate labels
        for ($i = $months - 1; $i >= 0; $i--) {
            if ($range === 'monthly') {
                $labels[] = now()->subMonths($i)->format($format);
            } elseif ($range === 'quarterly') {
                $quarter = ceil((now()->subMonths($i)->month) / 3);
                $labels[] = 'Q' . $quarter . ' ' . now()->subMonths($i)->format('Y');
            } else {
                $labels[] = now()->subYears($i)->format($format);
            }
        }

        // Candidates data
        $candidates = Candidate::selectRaw($selectRaw)
            ->where('created_at', '>=', now()->$subFn($months))
            ->groupBy($groupBy)
            ->orderBy('year')
            ->get();

        // Companies data
        $companies = Company::selectRaw($selectRaw)
            ->where('created_at', '>=', now()->$subFn($months))
            ->groupBy($groupBy)
            ->orderBy('year')
            ->get();

        return response()->json([
            'labels' => $labels,
            'candidates' => $this->mapDataToLabels($candidates, $labels, $range),
            'companies' => $this->mapDataToLabels($companies, $labels, $range)
        ]);
    }

    private function mapDataToLabels($data, $labels, $range)
    {
        $mappedData = array_fill(0, count($labels), 0);

        foreach ($data as $item) {
            $index = null;

            if ($range === 'monthly') {
                $date = date('M Y', mktime(0, 0, 0, $item->month, 1, $item->year));
                $index = array_search($date, $labels);
            } elseif ($range === 'quarterly') {
                $quarterLabel = 'Q' . $item->quarter . ' ' . $item->year;
                $index = array_search($quarterLabel, $labels);
            } else {
                $index = array_search($item->year, $labels);
            }

            if ($index !== false) {
                $mappedData[$index] = $item->count;
            }
        }

        return $mappedData;
    }
}
