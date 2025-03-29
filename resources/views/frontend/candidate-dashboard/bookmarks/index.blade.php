@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">My Bookmark Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Bookmarks</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.candidate-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">
                    <div class="mb-3">
                        <h3 class="mb-0">Bookmarked Jobs(200)</h3>
                    </div>
                    {{-- <div style="overflow-x: auto;">
                        <table class="table"
                            style="border-collapse: separate; border-spacing: 0; width: 100%; margin-bottom: 0;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th
                                        style="padding: 15px; border-top: none; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057;">
                                        Job</th>
                                    <th
                                        style="padding: 15px; border-top: none; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057;">
                                        Salary</th>
                                    <th
                                        style="padding: 15px; border-top: none; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057;">
                                        Applied Date</th>
                                    <th
                                        style="padding: 15px; border-top: none; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057;">
                                        Status</th>
                                    <th
                                        style="padding: 15px; border-top: none; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; width: 15%;">
                                        Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookmarks as $bookmark)
                                    <tr style="transition: background-color 0.2s; border-bottom: 1px solid #e9ecef;">
                                        <td style="padding: 15px; vertical-align: middle;">
                                            <div style="display: flex; align-items: center;">
                                                <div
                                                    style="width: 50px; height: 50px; border-radius: 6px; overflow: hidden; background-color: #f8f9fa; border: 1px solid #dee2e6; display: flex; align-items: center; justify-content: center;">
                                                    <img style="max-width: 100%; max-height: 100%; object-fit: contain;"
                                                        src="{{ asset($bookmark?->job?->company?->logo) }}" alt="">
                                                </div>
                                                <div style="padding-left: 15px;">
                                                    <h6 style="margin: 0; font-weight: 600; color: #333; font-size: 14px;">
                                                        {{ $bookmark?->job?->title }}
                                                    </h6>
                                                    <span
                                                        style="color: #6c757d; font-size: 13px;">{{ $bookmark?->job?->company?->name }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; font-size: 14px; color: #444;">
                                            @if ($bookmark?->job?->salary_mode === 'range')
                                                <div style="font-weight: 600;">{{ $bookmark?->job?->min_salary }} -
                                                    {{ $bookmark?->job?->max_salary }}
                                                    {{ config('settings.site_default_currency') }}</div>
                                                <span style="color: #6c757d; font-size: 13px;">
                                                    per {{ $bookmark?->job?->salaryType?->name }}
                                                </span>
                                            @else
                                                <div style="font-weight: 600;">{{ $bookmark?->job?->custom_salary }}</div>
                                                <span style="color: #6c757d; font-size: 13px;">
                                                    per {{ $bookmark?->job?->salaryType?->name }}
                                                </span>
                                            @endif
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle; font-size: 14px; color: #555;">
                                            {{ formatDate($bookmark?->created_at) }}</td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            @if ($bookmark?->job)
                                                @if ($bookmark?->job?->deadline < now())
                                                    <span
                                                        style="display: inline-block; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(244, 67, 54, 0.15); color: #f44336;">Expired</span>
                                                @else
                                                    @php
                                                        $status = strtolower($bookmark?->job?->status);
                                                        $badgeStyle = '';
                                                        switch ($status) {
                                                            case 'pending':
                                                                $badgeStyle =
                                                                    'background-color: rgba(255, 152, 0, 0.15); color: #ff9800;';
                                                                break;
                                                            case 'active':
                                                                $badgeStyle =
                                                                    'background-color: rgba(76, 175, 80, 0.15); color: #4CAF50;';
                                                                break;
                                                            case 'expired':
                                                                $badgeStyle =
                                                                    'background-color: rgba(244, 67, 54, 0.15); color: #f44336;';
                                                                break;
                                                            default:
                                                                $badgeStyle =
                                                                    'background-color: rgba(108, 117, 125, 0.15); color: #6c757d;';
                                                        }
                                                    @endphp
                                                    <span
                                                        style="display: inline-block; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; {{ $badgeStyle }}">
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                @endif
                                            @else
                                                <span
                                                    style="display: inline-block; padding: 5px 10px; border-radius: 4px; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(108, 117, 125, 0.15); color: #6c757d;">N/A</span>
                                            @endif
                                        </td>
                                        <td style="padding: 15px; vertical-align: middle;">
                                            @if ($bookmark?->job?->deadline < now())
                                                <span
                                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 6px 12px; background-color: #6c757d; color: white; border-radius: 4px; font-size: 14px; cursor: not-allowed; opacity: 0.7;">
                                                    <i class="fas fa-eye-slash" style="margin-right: 5px;"></i> Expired
                                                </span>
                                            @else
                                                <a href="{{ route('jobs.show', $bookmark?->job?->slug) }}"
                                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 6px 12px; background-color: #4361ee; color: white; border-radius: 4px; text-decoration: none; transition: background-color 0.2s; font-size: 14px;">
                                                    <i class="fas fa-eye" style="margin-right: 5px;"></i> View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="padding: 30px; text-align: center; color: #6c757d;">
                                            <div style="font-size: 16px; margin-bottom: 5px;">No applications found</div>
                                            <div style="font-size: 14px;">When you apply for jobs, they will appear here
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div> --}}

                    <div style="overflow-x: auto; border-radius: 12px; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);">
                        <table class="table"
                            style="border-collapse: separate; border-spacing: 0; width: 100%; margin-bottom: 0; background: white; border-radius: 12px; overflow: hidden;">
                            <thead>
                                <tr style="background-color: #f9fafb;">
                                    <th
                                        style="padding: 16px; border: none; font-weight: 600; color: #4b5563; text-align: left; font-size: 14px; letter-spacing: 0.5px;">
                                        Job
                                    </th>
                                    <th
                                        style="padding: 16px; border: none; font-weight: 600; color: #4b5563; text-align: left; font-size: 14px; letter-spacing: 0.5px;">
                                        Salary
                                    </th>
                                    <th
                                        style="padding: 16px; border: none; font-weight: 600; color: #4b5563; text-align: left; font-size: 14px; letter-spacing: 0.5px;">
                                        Deadline
                                    </th>

                                    <th
                                        style="padding: 16px; border: none; font-weight: 600; color: #4b5563; text-align: left; font-size: 14px; letter-spacing: 0.5px;">
                                        Status
                                    </th>
                                    <th
                                        style="padding: 16px; border: none; font-weight: 600; color: #4b5563; text-align: center; font-size: 14px; letter-spacing: 0.5px;">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($bookmarks as $bookmark)
                                    <tr style="transition: all 0.2s ease; border-bottom: 1px solid #f3f4f6; background: white;"
                                        onmouseover="this.style.backgroundColor='#f9fafb'"
                                        onmouseout="this.style.backgroundColor='white'">
                                        <td style="padding: 16px; vertical-align: middle;">
                                            <div style="display: flex; align-items: center; gap: 12px;">
                                                <div
                                                    style="width: 48px; height: 48px; border-radius: 8px; overflow: hidden; background-color: #f8f9fa; border: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                                    <img style="width: 100%; height: 100%; object-fit: contain; padding: 4px;"
                                                        src="{{ asset($bookmark?->job?->company?->logo) }}"
                                                        alt="{{ $bookmark?->job?->company?->name }} logo">
                                                </div>
                                                <div>
                                                    <div
                                                        style="font-weight: 600; color: #111827; font-size: 14px; margin-bottom: 4px;">
                                                        {{ $bookmark?->job?->title }}
                                                    </div>
                                                    <div
                                                        style="color: #6b7280; font-size: 13px; display: flex; align-items: center; gap: 6px;">
                                                        <span
                                                            style="background-color: #e6f2ff; color: #3182ce; padding: 2px 6px; border-radius: 4px; margin-right: 8px; font-size: 11px; max-width: 150px; overflow: hidden; text-overflow: ellipsis;">
                                                            {{ $bookmark?->job?->company?->name }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td style="padding: 16px; vertical-align: middle;">
                                            <div style="display: flex; flex-direction: column; gap: 2px;">
                                                @if ($bookmark?->job?->salary_mode === 'range')
                                                    <div style="font-weight: 600; color: #111827; font-size: 14px;">
                                                        {{ $bookmark?->job?->min_salary }} -
                                                        {{ $bookmark?->job?->max_salary }}
                                                        {{ config('settings.site_default_currency') }}
                                                    </div>
                                                @else
                                                    <div style="font-weight: 600; color: #111827; font-size: 14px;">
                                                        {{ $bookmark?->job?->custom_salary }}
                                                    </div>
                                                @endif
                                                <div
                                                    style="color: #6b7280; font-size: 13px; display: flex; align-items: center; gap: 4px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <line x1="12" y1="1" x2="12" y2="23">
                                                        </line>
                                                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                                    </svg>
                                                    per {{ $bookmark?->job?->salaryType?->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 8px; vertical-align: middle; color: #4a5568; font-weight: 500;">
                                            {{ formatDate($bookmark?->job?->deadline) }}
                                        </td>
                                        <td style="padding: 16px; vertical-align: middle;">
                                            @if ($bookmark?->job)
                                                @if ($bookmark?->job?->deadline < now())
                                                    <span
                                                        style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 500; background-color: #fee2e2; color: #b91c1c; gap: 4px;">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="12"
                                                            height="12" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round">
                                                            <circle cx="12" cy="12" r="10"></circle>
                                                            <line x1="12" y1="8" x2="12"
                                                                y2="12"></line>
                                                            <line x1="12" y1="16" x2="12.01"
                                                                y2="16"></line>
                                                        </svg>
                                                        Expired
                                                    </span>
                                                @else
                                                    @php
                                                        $status = strtolower($bookmark?->job?->status);
                                                        switch ($status) {
                                                            case 'pending':
                                                                $badgeClasses = 'bg-amber-50 text-amber-600';
                                                                $icon =
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
                                                                break;
                                                            case 'active':
                                                                $badgeClasses = 'bg-green-50 text-green-600';
                                                                $icon =
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>';
                                                                break;
                                                            case 'expired':
                                                                $badgeClasses = 'bg-red-50 text-red-600';
                                                                $icon =
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>';
                                                                break;
                                                            default:
                                                                $badgeClasses = 'bg-gray-50 text-gray-600';
                                                                $icon =
                                                                    '<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>';
                                                        }
                                                    @endphp
                                                    <span
                                                        style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 500; gap: 4px; {{ str_replace('bg-', 'background-color: ', str_replace('text-', 'color: ', $badgeClasses)) }}">
                                                        {!! $icon !!}
                                                        {{ ucfirst($status) }}
                                                    </span>
                                                @endif
                                            @else
                                                <span
                                                    style="display: inline-flex; align-items: center; padding: 4px 10px; border-radius: 9999px; font-size: 12px; font-weight: 500; background-color: #f3f4f6; color: #6b7280; gap: 4px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <circle cx="12" cy="12" r="10"></circle>
                                                        <line x1="12" y1="8" x2="12" y2="12">
                                                        </line>
                                                        <line x1="12" y1="16" x2="12.01" y2="16">
                                                        </line>
                                                    </svg>
                                                    N/A
                                                </span>
                                            @endif
                                        </td>
                                        <td style="padding: 16px; vertical-align: middle; text-align: center;">
                                            @if ($bookmark?->job?->deadline < now())
                                                <span
                                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; background-color: #f3f4f6; color: #9ca3af; border-radius: 6px; font-size: 13px; font-weight: 500; cursor: not-allowed; gap: 6px;">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path
                                                            d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24">
                                                        </path>
                                                        <line x1="1" y1="1" x2="23"
                                                            y2="23"></line>
                                                    </svg>
                                                    Expired
                                                </span>
                                            @else
                                                <a href="{{ route('jobs.show', $bookmark?->job?->slug) }}"
                                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; background-color: #3b82f6; color: white; border-radius: 6px; font-size: 13px; font-weight: 500; text-decoration: none; transition: all 0.2s; gap: 6px;"
                                                    onmouseover="this.style.backgroundColor='#2563eb'; this.style.boxShadow='0 1px 3px rgba(0, 0, 0, 0.1)'"
                                                    onmouseout="this.style.backgroundColor='#3b82f6'; this.style.boxShadow='none'">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                        <circle cx="12" cy="12" r="3"></circle>
                                                    </svg>
                                                    View
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5"
                                            style="padding: 40px; text-align: center; background-color: #f9fafb;">
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; gap: 16px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48"
                                                    viewBox="0 0 24 24" fill="none" stroke="#9ca3af"
                                                    stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                                    <circle cx="12" cy="10" r="3"></circle>
                                                </svg>
                                                <div style="font-size: 16px; font-weight: 500; color: #6b7280;">No
                                                    bookmarks found</div>
                                                <div
                                                    style="font-size: 14px; color: #9ca3af; max-width: 400px; line-height: 1.5;">
                                                    When you bookmark jobs, they will appear here for easy access.
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div style="padding: 15px; border-top: 1px solid #eaedf2; text-align: right;">
                        <nav style="display: inline-block;">
                            @if ($bookmarks->hasPages())
                                {{ $bookmarks->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>

                </div>

            </div>
        </div>
    </section>
@endsection
