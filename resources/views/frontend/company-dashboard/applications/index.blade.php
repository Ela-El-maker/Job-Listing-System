@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Applied Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Applicant Candidates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">



                    <div style="padding: 20px; border-bottom: 1px solid #eaedf2;">
                        <h4 style="margin-bottom: 15px; color: #333; font-weight: 600;">{{ $jobTitle?->title }}</h4>
                        <hr style="margin: 15px 0; border-color: #eaedf2;">
                        <div
                            style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; justify-content: space-between;">
                            <div style="flex: 1; min-width: 280px;">

                            </div>

                        </div>
                    </div>

                    <div style="background-color: white; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.05);">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead style="background: linear-gradient(to right, #4361ee, #3a0ca3);">
                                <tr>
                                    <th
                                        style="padding: 12px; color: white; font-weight: 600; text-align: left; text-transform: uppercase; letter-spacing: 0.5px; font-size: 13px;">
                                        #</th>
                                    <th
                                        style="padding: 12px; color: white; font-weight: 600; text-align: left; text-transform: uppercase; letter-spacing: 0.5px; font-size: 13px;">
                                        Details</th>
                                    <th
                                        style="padding: 12px; color: white; font-weight: 600; text-align: left; text-transform: uppercase; letter-spacing: 0.5px; font-size: 13px;">
                                        Experience</th>

                                    <th
                                        style="padding: 12px; color: white; font-weight: 600; text-align: left; text-transform: uppercase; letter-spacing: 0.5px; font-size: 13px;">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($applications as $application)
                                    <tr style="border-bottom: 1px solid #e9ecef;">
                                        <td
                                            style="padding: 12px; vertical-align: middle; color: #6c757d; font-weight: 500; font-size: 14px;">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td style="padding: 12px; vertical-align: middle;">
                                            <div style="display: flex; align-items: center;">
                                                <img src="{{ asset($application?->candidate?->image) }}"
                                                    alt="{{ $application?->candidate?->full_name }}'s profile picture"
                                                    style="width: 48px; height: 48px; border-radius: 50%; object-fit: cover; margin-right: 12px;">
                                                <div>
                                                    <div
                                                        style="font-weight: 700; color: #2d3748; font-size: 15px; line-height: 1.3;">
                                                        {{ $application?->candidate?->full_name }}
                                                    </div>
                                                    <div
                                                        style="color: #718096; font-size: 13px; background-color: #f0f4f8; display: inline-block; padding: 2px 6px; border-radius: 4px;">
                                                        {{ $application?->candidate?->profession?->name }}</div>

                                                </div>
                                            </div>
                                        </td>
                                        <td style="padding: 12px; vertical-align: middle;">
                                            <div style="font-weight: 600; color: #2d3748; font-size: 14px;">
                                                {{ $application?->candidate?->experience?->name }}
                                            </div>

                                        </td>
                                        <td style="padding: 12px; vertical-align: middle;">
                                            <a href="{{ route('candidates.show', $application?->candidate?->slug) }}"
                                                style="text-decoration: none;">
                                                <span
                                                    style="
                                                    display: inline-block;
                                                    background: linear-gradient(to right, #3182ce, #63b3ed);
                                                    color: white;
                                                    padding: 6px 12px;
                                                    border-radius: 6px;
                                                    font-size: 13px;
                                                    font-weight: 500;
                                                    cursor: pointer;
                                                    transition: all 0.2s ease;
                                                    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                                                "
                                                    onmouseover="this.style.opacity='0.9'"
                                                    onmouseout="this.style.opacity='1'">
                                                    View Profile
                                                </span>
                                            </a>
                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" style="text-align: center; padding: 20px;">
                                            <div
                                                style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64"
                                                    viewBox="0 0 24 24" fill="none" stroke="#718096" stroke-width="1.5"
                                                    stroke-linecap="round" stroke-linejoin="round">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <line x1="12" y1="8" x2="12" y2="12">
                                                    </line>
                                                    <line x1="12" y1="16" x2="12.01" y2="16">
                                                    </line>
                                                </svg>
                                                <h3 style="color: #4a5568; font-size: 18px; font-weight: 500;">No
                                                    applications found</h3>
                                                <p style="color: #718096; font-size: 14px;">There are currently no job
                                                    applications for this position.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                                <!-- More rows can be added similarly -->
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 15px; border-top: 1px solid #eaedf2; text-align: right;">
                        <nav style="display: inline-block;">
                            @if ($applications->hasPages())
                                {{ $applications->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
