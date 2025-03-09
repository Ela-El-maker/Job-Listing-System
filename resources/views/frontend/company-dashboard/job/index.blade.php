@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Companies and Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Companies and Jobs</li>
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

                    <div class="card">
                        <div class="card-header">
                            <h4>All Posted Jobs </h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-9">
                                    <div class="card-header-form">
                                        <form action="{{ route('company.jobs.index') }}" method="GET"
                                            class="d-flex justify-content-center">
                                            <div class="input-group" style="max-width: 300px;">
                                                <input type="text" name="search" class="form-control"
                                                    placeholder="Search" value="{{ request('search') }}">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('company.jobs.create') }}" class="btn btn-primary"><i
                                            class="fas fa-plus-circle"></i>
                                        Create New</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th style="width: 270px;">Job</th>
                                        <th>Category/Role</th>
                                        <th>Salary</th>
                                        <th>Deadline</th>
                                        <th>Status</th>
                                        <th style="width: 10%">Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($jobs as $job)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Add numbering here -->
                                                <td>
                                                    <div class="d-flex">

                                                        <div>
                                                            <b>{{ $job?->title }}</b>
                                                            <br>
                                                            <span>{{ $job?->company?->name }} -
                                                                {{ $job?->jobType?->name }}</span>
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
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif ($job?->deadline > date('Y-m-d'))
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Expired</span>
                                                    @endif
                                                </td>


                                                <td>
                                                    <a href="{{ route('company.jobs.edit', $job?->id) }}"
                                                        class="mb-2 btn-small btn btn-primary">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <a href="{{ route('company.jobs.destroy', $job?->id) }}"
                                                        class="mb-2 btn-small btn btn-danger delete-item">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" class="text-center"> No Results Found! </td>
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

                </div>
            </div>
        </div>
    </section>
@endsection
