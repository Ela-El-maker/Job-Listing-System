@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Users</h4>
                        </div>
                        <div class="card-body">
                            {{ $allUsers }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Earnings -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Earnings</h4>
                        </div>
                        <div class="card-body">
                            {{ config('settings.site_currency_icon') }} {{ $totalEarnings }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Candidates -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Candidates</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCandidates }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Visible Candidates -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Visible Candidates</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalVisibleCandidates }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Companies -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Companies</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalCompanies }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-building"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Visible Companies</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalVisibleCompanies }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Orders -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-shopping-cart"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Orders</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalOrders }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Jobs -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-dark">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Jobs</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalJobs }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Active Jobs -->
            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Active Jobs</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalActiveJobs }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-hourglass-half"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pending Jobs</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalPendingJobs }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-secondary">
                        <i class="fas fa-calendar-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Expired Jobs</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalExpiredJobs }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12 mb-4">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-primary">
                        <i class="fas fa-book-open"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Blog Posts</h4>
                        </div>
                        <div class="card-body">
                            {{ $totalBlogs }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>User Registrations & Earnings (Monthly)</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="monthlyChart" height="100"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>System Overview</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="systemOverviewChart" height="150"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- In view -->
        <div class="card">
            <div class="card-header">
                <h4>Top Performing Companies</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Company</th>
                            <th>Jobs Posted</th>
                            <th>Orders</th>
                            <th>Applicants</th>
                        </tr>
                        @foreach ($topCompanies as $company)
                            <tr>
                                <td>{{ ($topCompanies->currentPage() - 1) * $topCompanies->perPage() + $loop->iteration }}
                                </td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->jobs_count }}</td>
                                <td>{{ $company->orders_count }}</td>
                                <td>{{ $company->applications_count }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <!-- User Registration Trends -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>User Registration Trends</h4>

                        <select class="form-control form-control-sm w-auto" id="userTrendsTimeRange">
                            <option value="7">Last 7 Days</option>
                            <option value="30" selected>Last 30 Days</option>
                            <option value="90">Last 90 Days</option>
                            <option value="365">Last Year</option>
                        </select>
                        <button class="btn btn-sm btn-outline-secondary export-chart" data-chart="userRegistrationChart">
                            <i class="fas fa-download"></i> Export
                        </button>
                    </div>
                    <div class="card-body">
                        <canvas id="userRegistrationChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Earnings Overview -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Earnings Overview</h4>
                        <select class="form-control form-control-sm w-auto" id="earningsTimeRange">
                            <option value="monthly">Monthly</option>
                            <option value="weekly" selected>Weekly</option>
                            <option value="daily">Daily</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="earningsChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Job Status Distribution -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h4>Job Status Distribution</h4>
                    </div>
                    <div class="card-body">
                        <canvas id="jobStatusChart" height="250"></canvas>
                    </div>
                </div>
            </div>

            <!-- Candidate vs Company Growth -->
            <div class="col-lg-6 col-md-12 mb-4">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Candidate vs Company Growth</h4>
                        <select class="form-control form-control-sm w-auto" id="growthTimeRange">
                            <option value="monthly">Monthly</option>
                            <option value="quarterly">Quarterly</option>
                            <option value="yearly" selected>Yearly</option>
                        </select>
                    </div>
                    <div class="card-body">
                        <canvas id="growthComparisonChart" height="250"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h4>All Pending Job Posts</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.jobs.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" style="height: 42px" class="btn btn-primary"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Job</th>
                            <th>Category/Role</th>
                            <th>Salary</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($jobs as $job)
                                <tr>
                                    <td>{{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img style="width: 50px;height:50px;object-fit:cover;"
                                                    src="{{ asset($job?->company?->logo) }}" alt="">
                                            </div>
                                            <div>
                                                <b>{{ $job?->title }}</b>
                                                <br>
                                                <span>{{ $job?->company?->name }} - {{ $job?->jobType?->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <b>{{ $job?->category?->name }}</b>
                                            <br>
                                            <span>{{ $job?->jobRole?->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($job?->salary_mode === 'range')
                                            {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                            <br>
                                            <span>{{ $job?->salaryType?->name }}</span>
                                        @else
                                            {{ $job?->custom_salary }}
                                            <br>
                                            <span>{{ $job?->salaryType?->name }}</span>
                                        @endif
                                    </td>
                                    <td>{{ formatDate($job?->deadline) }}</td>
                                    <td>
                                        @if ($job?->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($job?->deadline > date('Y-m-d'))
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="form-group">
                                            <label class="custom-switch mt-2">
                                                <input @checked($job->status === 'active') type="checkbox"
                                                    data-id="{{ $job->id }}" name="custom-switch-checkbox"
                                                    class="custom-switch-input post_status">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.jobs.edit', $job?->id) }}"
                                            class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.destroy', $job?->id) }}"
                                            class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No Results Found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($jobs->hasPages())
                        {{ $jobs->withQueryString()->links() }}
                    @endif
                </nav>
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment"></script>
    <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-moment"></script>
    <script>
        $(document).ready(function() {


            // Initialize all charts
            initUserRegistrationChart();
            initEarningsChart();
            initJobStatusChart();
            initGrowthComparisonChart();
            $('.post_status').on('change', function() {
                let id = $(this).data('id');
                let isChecked = $(this).is(':checked');
                let newStatus = isChecked ? 'active' : 'pending';

                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.job-status.update', ':id') }}'.replace(":id", id),
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error updating status:', error);
                    }
                });
            });



            // Time range change handlers
            $('#userTrendsTimeRange').change(function() {
                fetchUserRegistrationData($(this).val());
            });

            $('#earningsTimeRange').change(function() {
                fetchEarningsData($(this).val());
            });

            $('#growthTimeRange').change(function() {
                fetchGrowthComparisonData($(this).val());
            });

            // Chart initialization functions
            function initUserRegistrationChart() {
                window.userRegistrationChart = new Chart(
                    document.getElementById('userRegistrationChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: {!! json_encode($userRegistrations->pluck('date')) !!},
                            datasets: [{
                                label: 'User Registrations',
                                data: {!! json_encode($userRegistrations->pluck('count')) !!},
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 1,
                                tension: 0.3,
                                fill: true
                            }]
                        },
                        options: getLineChartOptions('User Registrations')
                    }
                );
            }

            function initEarningsChart() {
                window.earningsChart = new Chart(
                    document.getElementById('earningsChart').getContext('2d'), {
                        type: 'bar',
                        data: {
                            labels: {!! json_encode($earningsData->pluck('date')) !!},
                            datasets: [{
                                label: 'Earnings ({{ config('settings.site_currency_icon') }})',
                                data: {!! json_encode($earningsData->pluck('total')) !!},
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: getBarChartOptions('Earnings Over Time')
                    }
                );
            }

            function initJobStatusChart() {
                window.jobStatusChart = new Chart(
                    document.getElementById('jobStatusChart').getContext('2d'), {
                        type: 'doughnut',
                        data: {
                            labels: ['Active', 'Pending', 'Expired'],
                            datasets: [{
                                data: {!! json_encode(array_values($jobStatusData)) !!},
                                backgroundColor: [
                                    'rgba(40, 167, 69, 0.7)',
                                    'rgba(255, 193, 7, 0.7)',
                                    'rgba(220, 53, 69, 0.7)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                title: {
                                    display: true,
                                    text: 'Job Status Distribution'
                                }
                            }
                        }
                    }
                );
            }

            function initGrowthComparisonChart() {
                const months = Array.from({
                    length: 12
                }, (_, i) => moment().subtract(11 - i, 'months').format('MMM YYYY'));

                window.growthComparisonChart = new Chart(
                    document.getElementById('growthComparisonChart').getContext('2d'), {
                        type: 'line',
                        data: {
                            labels: months,
                            datasets: [{
                                    label: 'Candidates',
                                    data: {!! json_encode($candidateGrowth->pluck('count')) !!},
                                    borderColor: 'rgba(255, 99, 132, 1)',
                                    backgroundColor: 'rgba(255, 99, 132, 0.1)',
                                    tension: 0.3,
                                    fill: true
                                },
                                {
                                    label: 'Companies',
                                    data: {!! json_encode($companyGrowth->pluck('count')) !!},
                                    borderColor: 'rgba(54, 162, 235, 1)',
                                    backgroundColor: 'rgba(54, 162, 235, 0.1)',
                                    tension: 0.3,
                                    fill: true
                                }
                            ]
                        },
                        options: getLineChartOptions('Growth Comparison')
                    }
                );
            }

            // AJAX functions for dynamic data loading
            function fetchUserRegistrationData(days) {
                $.ajax({
                    url: '{{ route('admin.analytics.user-registrations') }}',
                    data: {
                        days: days
                    },
                    success: function(response) {
                        window.userRegistrationChart.data.labels = response.labels;
                        window.userRegistrationChart.data.datasets[0].data = response.data;
                        window.userRegistrationChart.update();
                    }
                });
            }

            function fetchEarningsData(range) {
                $.ajax({
                    url: '{{ route('admin.analytics.earnings') }}',
                    data: {
                        range: range
                    },
                    success: function(response) {
                        window.earningsChart.data.labels = response.labels;
                        window.earningsChart.data.datasets[0].data = response.data;
                        window.earningsChart.update();
                    }
                });
            }

            function fetchGrowthComparisonData(range) {
                $.ajax({
                    url: '{{ route('admin.analytics.growth-comparison') }}',
                    data: {
                        range: range
                    },
                    success: function(response) {
                        window.growthComparisonChart.data.labels = response.labels;
                        window.growthComparisonChart.data.datasets[0].data = response.candidates;
                        window.growthComparisonChart.data.datasets[1].data = response.companies;
                        window.growthComparisonChart.update();
                    }
                });
            }

            // Helper functions for chart options
            function getLineChartOptions(title) {
                return {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: title
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'MMM D, YYYY'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                };
            }

            function getBarChartOptions(title) {
                return {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom',
                        },
                        title: {
                            display: true,
                            text: title
                        }
                    },
                    scales: {
                        x: {
                            type: 'time',
                            time: {
                                unit: 'day',
                                tooltipFormat: 'MMM D, YYYY'
                            }
                        },
                        y: {
                            beginAtZero: true
                        }
                    }
                };
            }


            // Monthly Chart (User Registrations & Earnings)
            const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
            const monthlyChart = new Chart(monthlyCtx, {
                type: 'line',
                data: {
                    labels: {!! json_encode(
                        array_values($monthlyRegistrations->keys()->map(fn($m) => date('F', mktime(0, 0, 0, $m, 10)))->toArray()),
                    ) !!},
                    datasets: [{
                            label: 'User Registrations',
                            data: {!! json_encode($monthlyRegistrations->values()) !!},
                            borderColor: 'rgba(54, 162, 235, 1)',
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            tension: 0.4,
                            fill: true
                        },
                        {
                            label: 'Earnings',
                            data: {!! json_encode($monthlyEarnings->values()) !!},
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                            tension: 0.4,
                            fill: true
                        }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // System Overview Chart
            const systemOverviewCtx = document.getElementById('systemOverviewChart').getContext('2d');
            const systemOverviewChart = new Chart(systemOverviewCtx, {
                type: 'bar',
                data: {
                    labels: ['Total Jobs', 'Active Jobs', 'Pending Jobs', 'Expired Jobs', 'Blog Posts'],
                    datasets: [{
                        label: 'Counts',
                        data: [
                            {{ $totalJobs }},
                            {{ $totalActiveJobs }},
                            {{ $totalPendingJobs }},
                            {{ $totalExpiredJobs }},
                            {{ $totalBlogs }}
                        ],
                        backgroundColor: [
                            'rgba(0, 123, 255, 0.7)',
                            'rgba(40, 167, 69, 0.7)',
                            'rgba(255, 193, 7, 0.7)',
                            'rgba(220, 53, 69, 0.7)',
                            'rgba(23, 162, 184, 0.7)'
                        ],
                        borderColor: [
                            'rgba(0, 123, 255, 1)',
                            'rgba(40, 167, 69, 1)',
                            'rgba(255, 193, 7, 1)',
                            'rgba(220, 53, 69, 1)',
                            'rgba(23, 162, 184, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                stepSize: 1
                            }
                        }
                    }
                }
            });

            // Earnings Chart
            const earningsCtx = document.getElementById('earningsChart').getContext('2d');
            const earningsChart = new Chart(earningsCtx, {
                type: 'line',
                data: {
                    labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August',
                        'September',
                        'October', 'November', 'December'
                    ],
                    datasets: [{
                        label: 'Total Earnings',
                        data: [
                            {{ $totalEarningsMonthly[1] ?? 0 }},
                            {{ $totalEarningsMonthly[2] ?? 0 }},
                            {{ $totalEarningsMonthly[3] ?? 0 }},
                            {{ $totalEarningsMonthly[4] ?? 0 }},
                            {{ $totalEarningsMonthly[5] ?? 0 }},
                            {{ $totalEarningsMonthly[6] ?? 0 }},
                            {{ $totalEarningsMonthly[7] ?? 0 }},
                            {{ $totalEarningsMonthly[8] ?? 0 }},
                            {{ $totalEarningsMonthly[9] ?? 0 }},
                            {{ $totalEarningsMonthly[10] ?? 0 }},
                            {{ $totalEarningsMonthly[11] ?? 0 }},
                            {{ $totalEarningsMonthly[12] ?? 0 }}
                        ],
                        fill: true,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.1)',
                        tension: 0.3
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        title: {
                            display: true,
                            text: 'Total Earnings Over Time'
                        }
                    }
                }
            });

            // Add similar initialization for candidateChart, jobStatusChart, and blogChart if needed



            setInterval(function() {
                fetchUserRegistrationData($('#userTrendsTimeRange').val());
                fetchEarningsData($('#earningsTimeRange').val());
                fetchGrowthComparisonData($('#growthTimeRange').val());
            }, 300000);
        });
        $('.export-chart').click(function() {
            const chartId = $(this).data('chart');
            const chart = window[chartId];
            const a = document.createElement('a');
            a.href = chart.toBase64Image();
            a.download = `${chartId}.png`;
            a.click();
        });
    </script>
@endpush
