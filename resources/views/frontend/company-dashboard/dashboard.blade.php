@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Company Dashboard</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Dashboard</li>
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
                    <div class="content-single">
                        <h3 class="mt-0 mb-0 color-brand-1">Dashboard</h3>
                        <div class="dashboard_overview">
                            <div class="row">
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-info-subtle">
                                        <h2>{{ $jobPosts }} <span>Pending Jobs</span></h2>
                                        <span class="icon"><i class="fas fa-hourglass-half"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-danger-subtle">
                                        <h2>{{ $totalJobPosts }}<span>Total Jobs</span></h2>
                                        <span class="icon"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6">
                                    <div class="dash_overview_item bg-warning-subtle">
                                        <h2>{{ $totalOrders }} <span>Total Orders</span></h2>
                                        <span class="icon"><i class="fas fa-cart-plus"></i></span>
                                    </div>
                                </div>
                            </div>
                            @if (!isCompanyProfileComplete())
                                <div class="row">
                                    <div class="col-12 mt-30">
                                        <div class="dash_alert_box p-30 bg-danger rounded-4 d-flex flex-wrap">
                                            <span class="img">
                                                <img src="{{ asset(auth()->user()->image) }}" alt="alert">
                                            </span>
                                            <div class="text">
                                                <h4>WARNING : You have to complete you profile first!</h4>
                                                <p>Please complete your Company profile to use all the features.</p>
                                            </div>
                                            <a href="{{ route('company.profile') }}" class="btn btn-default rounded-1">Edit
                                                Profile</a>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="container py-4">
                                <div class="card shadow-sm border-0 rounded-lg">
                                    <div class="card-header bg-primary text-white p-4 rounded-top">
                                        <h3 class="mb-0 fw-bold">Your Subscription Plan</h3>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table table-hover mb-0">
                                                <tbody>
                                                    <tr class="border-bottom">
                                                        <td class="p-4 w-50">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="icon-container me-3 bg-light rounded-circle p-3">
                                                                    <i class="fas fa-box-open text-primary"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1 fw-bold">Current Package</h5>
                                                                    <p class="text-muted mb-0 small">Your active
                                                                        subscription</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 text-end">
                                                            <span class="badge bg-primary rounded-pill px-4 py-2 fs-6">
                                                                {{ $userPlan?->plan?->label }} Package
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr class="border-bottom">
                                                        <td class="p-4">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="icon-container me-3 bg-light rounded-circle p-3">
                                                                    <i class="fas fa-briefcase text-success"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1 fw-bold">Job Posts</h5>
                                                                    <p class="text-muted mb-0 small">Number of jobs you can
                                                                        post</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 text-end">
                                                            <span class="badge bg-success rounded-pill px-4 py-2 fs-6">
                                                                {{ $userPlan?->plan?->job_limit }}
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr class="border-bottom">
                                                        <td class="p-4">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="icon-container me-3 bg-light rounded-circle p-3">
                                                                    <i class="fas fa-star text-warning"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1 fw-bold">Featured Posts</h5>
                                                                    <p class="text-muted mb-0 small">Jobs that appear at the
                                                                        top of listings</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 text-end">
                                                            <span
                                                                class="badge bg-warning text-dark rounded-pill px-4 py-2 fs-6">
                                                                {{ $userPlan?->plan?->featured_job_limit }}
                                                            </span>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td class="p-4">
                                                            <div class="d-flex align-items-center">
                                                                <div
                                                                    class="icon-container me-3 bg-light rounded-circle p-3">
                                                                    <i class="fas fa-bookmark text-info"></i>
                                                                </div>
                                                                <div>
                                                                    <h5 class="mb-1 fw-bold">Highlighted Posts</h5>
                                                                    <p class="text-muted mb-0 small">Jobs with enhanced
                                                                        visibility</p>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="p-4 text-end">
                                                            <span class="badge bg-info rounded-pill px-4 py-2 fs-6">
                                                                {{ $userPlan?->plan?->highlight_job_limit }}
                                                            </span>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div
                                        class="card-footer bg-white p-4 d-flex justify-content-between align-items-center rounded-bottom">
                                        <span class="text-muted small">Last updated: {{ date('F d, Y') }}</span>
                                        <a href="{{ route('pricing.index') }}" class="btn btn-outline-primary btn-sm">Upgrade Plan</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection
