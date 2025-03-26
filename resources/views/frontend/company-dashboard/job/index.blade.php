@extends('frontend.layouts.master')
@section('contents')
    <style>
        .dropdown-menu {
            display: none;
        }

        .dropdown-menu a {
            display: block;
            padding: 6px 12px;
            text-decoration: none;
            color: #333;
        }

        .dropdown-menu a:hover {
            background-color: #f0f0f0;
        }
    </style>
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

                    {{-- <div class="card">
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
                    </div> --}}

                    <div style="padding: 20px; border-bottom: 1px solid #eaedf2;">
                        <h4 style="margin-bottom: 15px; color: #333; font-weight: 600;">All Posted Jobs</h4>
                        <hr style="margin: 15px 0; border-color: #eaedf2;">
                        <div
                            style="display: flex; flex-wrap: wrap; gap: 15px; align-items: center; justify-content: space-between;">
                            <div style="flex: 1; min-width: 280px;">
                                <form action="{{ route('company.jobs.index') }}" method="GET" style="display: flex;">
                                    <div style="display: flex; max-width: 300px; width: 100%;">
                                        <input type="text" name="search"
                                            style="flex: 1; padding: 8px 12px; border: 1px solid #dee2e6; border-radius: 4px 0 0 4px; font-size: 14px; outline: none;"
                                            placeholder="Search" value="{{ request('search') }}">
                                        <button type="submit"
                                            style="background-color: #4361ee; color: white; border: none; border-radius: 0 4px 4px 0; padding: 0 15px; cursor: pointer;">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="{{ route('company.jobs.create') }}"
                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 8px 16px; background-color: #4361ee; color: white; border-radius: 4px; text-decoration: none; font-size: 14px; font-weight: 500; transition: background-color 0.2s;">
                                    <i class="fas fa-plus-circle" style="margin-right: 8px;"></i> Create New
                                </a>
                            </div>
                        </div>
                    </div>

                    <div style="width: 100%; overflow-x: auto;">
                        <table
                            style="
                            width: 100%;
                            min-width: 1200px;
                            border-collapse: separate;
                            border-spacing: 0;
                        ">
                            <thead style="background: linear-gradient(to right, #4361ee, #3a0ca3);">
                                <tr>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        #</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Job</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Category/Role</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Applications</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Deadline</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Status</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Applications</th>
                                    <th
                                        style="
                                        padding: 5px;
                                        color: white;
                                        font-weight: 600;
                                        text-align: left;
                                        text-transform: uppercase;
                                        letter-spacing: 0.5px;
                                        font-size: 13px;
                                        white-space: nowrap;
                                    ">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($jobs as $job)
                                    <tr
                                        style="
                                        transition: all 0.3s ease;
                                        border-bottom: 1px solid #e9ecef;
                                        background-color: white;
                                    ">
                                        <td
                                            style="
                                            padding: 10px;
                                            vertical-align: middle;
                                            color: #6c757d;
                                            font-weight: 500;
                                            font-size: 14px;
                                            white-space: nowrap;
                                        ">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td
                                            style="
                                            padding: 10px;
                                            vertical-align: middle;
                                            white-space: nowrap;
                                        ">
                                            <div style="display: flex; flex-direction: column;">
                                                <div
                                                    style="
                                                    font-weight: 700;
                                                    color: #2d3748;
                                                    font-size: 15px;
                                                    margin-bottom: 4px;
                                                    letter-spacing: -0.5px;
                                                    max-width: 250px;
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                ">
                                                    {{ $job?->title }}
                                                </div>
                                                <div
                                                    style="
                                                    color: #718096;
                                                    font-size: 13px;
                                                    display: flex;
                                                    align-items: center;
                                                ">
                                                    <span
                                                        style="
                                                        background-color: #e6f2ff;
                                                        color: #3182ce;
                                                        padding: 2px 6px;
                                                        border-radius: 4px;
                                                        margin-right: 8px;
                                                        font-size: 11px;
                                                        font-weight: 600;
                                                        max-width: 150px;
                                                        overflow: hidden;
                                                        text-overflow: ellipsis;
                                                    ">
                                                        {{ $job?->company?->name }}
                                                    </span>
                                                    {{ $job?->jobType?->name }}
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            white-space: nowrap;
                                        ">
                                            <div
                                                style="
                                                font-weight: 600;
                                                color: #2d3748;
                                                font-size: 14px;
                                                margin-bottom: 4px;
                                                max-width: 150px;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                            ">
                                                {{ $job?->category?->name }}
                                            </div>
                                            <div
                                                style="
                                                color: #718096;
                                                font-size: 13px;
                                                background-color: #f0f4f8;
                                                display: inline-block;
                                                padding: 2px 6px;
                                                border-radius: 4px;
                                                max-width: 150px;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                            ">
                                                {{ $job?->jobRole?->name }}
                                            </div>
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            font-weight: 600;
                                            color: #4a5568;
                                            white-space: nowrap;
                                        ">
                                            <span
                                                style="
                                                background-color: #e6f2ff;
                                                color: #3182ce;
                                                padding: 4px 8px;
                                                border-radius: 4px;
                                                font-size: 13px;
                                            ">
                                                {{ $job?->applications_count }} Total
                                            </span>
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            font-size: 14px;
                                            color: #4a5568;
                                            font-weight: 500;
                                            white-space: nowrap;
                                        ">
                                            {{ formatDate($job?->deadline) }}
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            white-space: nowrap;
                                        ">
                                            @if ($job?->status === 'pending')
                                                <span
                                                    style="
                                                    display: inline-block;
                                                    padding: 4px 8px;
                                                    border-radius: 4px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    text-transform: uppercase;
                                                    letter-spacing: 0.5px;
                                                    background-color: rgba(255, 152, 0, 0.15);
                                                    color: #ed8936;
                                                ">Pending</span>
                                            @elseif ($job?->deadline > date('Y-m-d'))
                                                <span
                                                    style="
                                                    display: inline-block;
                                                    padding: 4px 8px;
                                                    border-radius: 4px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    text-transform: uppercase;
                                                    letter-spacing: 0.5px;
                                                    background-color: rgba(76, 175, 80, 0.15);
                                                    color: #48bb78;
                                                ">Active</span>
                                            @else
                                                <span
                                                    style="
                                                    display: inline-block;
                                                    padding: 4px 8px;
                                                    border-radius: 4px;
                                                    font-size: 12px;
                                                    font-weight: 600;
                                                    text-transform: uppercase;
                                                    letter-spacing: 0.5px;
                                                    background-color: rgba(244, 67, 54, 0.15);
                                                    color: #f56565;
                                                ">Expired</span>
                                            @endif
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            text-align: center;
                                            white-space: nowrap;
                                        ">
                                            <a href=""
                                                style="
                                                   display: inline-flex;
                                                   align-items: center;
                                                   justify-content: center;
                                                   height: 36px;
                                                   padding: 0 12px;
                                                   background-color: #3182ce;
                                                   color: white;
                                                   text-decoration: none;
                                                   border-radius: 6px;
                                                   transition: all 0.3s ease;
                                                   font-weight: 600;
                                                   box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                               "
                                                class="hover:bg-blue-700 hover:shadow-lg">
                                                <i class="fas fa-list mr-2"></i> View
                                            </a>
                                        </td>
                                        <td
                                            style="
                                            padding: 5px;
                                            vertical-align: middle;
                                            white-space: nowrap;
                                        ">
                                            <div style="display: flex; gap: 8px;">
                                                <a href="{{ route('company.jobs.edit', $job?->id) }}"
                                                    style="
                                                       display: inline-flex;
                                                       align-items: center;
                                                       justify-content: center;
                                                       height: 36px;
                                                       width: 36px;
                                                       background-color: #48bb78;
                                                       color: white;
                                                       border-radius: 6px;
                                                       text-decoration: none;
                                                       transition: all 0.3s ease;
                                                       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                   "
                                                    class="hover:bg-green-600 hover:shadow-lg">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{ route('company.jobs.destroy', $job?->id) }}"
                                                    style="
                                                       display: inline-flex;
                                                       align-items: center;
                                                       justify-content: center;
                                                       height: 36px;
                                                       width: 36px;
                                                       background-color: #e53e3e;
                                                       color: white;
                                                       border-radius: 6px;
                                                       text-decoration: none;
                                                       transition: all 0.3s ease;
                                                       box-shadow: 0 2px 4px rgba(0,0,0,0.1);
                                                   "
                                                    class="delete-item hover:bg-red-600 hover:shadow-lg">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8"
                                            style="
                                            padding: 40px;
                                            text-align: center;
                                            background-color: #f7fafc;
                                        ">
                                            <div
                                                style="
                                                font-size: 24px;
                                                color: #2d3748;
                                                margin-bottom: 10px;
                                                font-weight: 600;
                                            ">
                                                No Jobs Found
                                            </div>
                                            <div
                                                style="
                                                font-size: 16px;
                                                color: #718096;
                                                margin-bottom: 20px;
                                            ">
                                                Create a new job posting to get started
                                            </div>
                                            <a href="{{ route('company.jobs.create') }}"
                                                style="
                                                display: inline-block;
                                                padding: 10px 20px;
                                                background-color: #3182ce;
                                                color: white;
                                                text-decoration: none;
                                                border-radius: 8px;
                                                font-weight: 600;
                                                transition: all 0.3s ease;
                                                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
                                            ">
                                                Create New Job
                                            </a>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div style="padding: 15px; border-top: 1px solid #eaedf2; text-align: right;">
                        <nav style="display: inline-block;">
                            @if ($jobs->hasPages())
                                {{ $jobs->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Select all dropdown toggles and menus
            const dropdownToggles = document.querySelectorAll('.dropdown-toggle');
            const dropdownMenus = document.querySelectorAll('.dropdown-menu');

            // Add click event to each dropdown toggle
            dropdownToggles.forEach((toggle, index) => {
                toggle.addEventListener('click', function(e) {
                    e.stopPropagation();

                    // Close all other dropdowns
                    dropdownMenus.forEach((menu, menuIndex) => {
                        if (menuIndex !== index) {
                            menu.style.display = 'none';
                        }
                    });

                    // Toggle current dropdown
                    const menu = this.nextElementSibling;
                    menu.style.display = menu.style.display === 'block' ? 'none' : 'block';
                });
            });

            // Close dropdowns when clicking outside
            document.addEventListener('click', function() {
                dropdownMenus.forEach(menu => {
                    menu.style.display = 'none';
                });
            });

            // Prevent dropdown from closing when clicking inside
            dropdownMenus.forEach(menu => {
                menu.addEventListener('click', function(e) {
                    e.stopPropagation();
                });
            });
        });
    </script>
@endpush
