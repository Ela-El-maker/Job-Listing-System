@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Find Jobs</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row flex-row-reverse">
                <div class="col-lg-9 col-md-12 col-sm-12 col-12 float-right">
                    <div class="content-page">
                        <div class="box-filters-job">

                        </div>
                        <div class="row display-list">
                            @forelse ($jobs as $job)
                                <div class="col-xl-12 col-12">
                                    <div class="card-grid-2 hover-up"><span class="flash"></span>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <div class="card-grid-2-image-left">
                                                    <div class="image-box"><img src="{{ asset($job?->company?->logo) }}"
                                                            alt="joblist"></div>
                                                    <div class="right-info">
                                                        <a class="name-job"
                                                            href="{{ route('companies.show', $job?->company?->slug) }}">
                                                            {{ $job?->company?->name }}</a>
                                                        <!-- Location (Country, State, City) -->
                                                        <span class="location-small">
                                                            {{ formatLocation($job?->company?->companyCountry?->name, $job?->company?->companyState?->name, $job?->company?->companyCity?->name) }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 text-start text-md-end pr-60 col-md-6 col-sm-12">
                                                <div class="pl-15 mb-15 mt-30">
                                                    @if ($job?->is_featured)
                                                        <a class="btn btn-grey-small mr-5 featured"
                                                            href="javascript:void(0)">
                                                            Featured
                                                        </a>
                                                    @endif

                                                    @if ($job?->is_highlighted)
                                                        <a class="btn btn-grey-small mr-5 highlight"
                                                            href="javascript:void(0)">
                                                            Highlighted
                                                        </a>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <h4><a href="{{ route('jobs.show', $job?->slug) }}">
                                                    {{ $job?->title }}
                                                </a>
                                            </h4>
                                            {{-- <div class="mt-5">
                                                <span class="card-briefcase">
                                                    {{ $job?->jobType?->name }}
                                                </span>
                                                <!-- Job Experience -->
                                                <span class="card-experience">
                                                    <i class="fas fa-clock"></i> <!-- Clock icon for experience -->
                                                    {{ $job?->jobExperience?->name }}
                                                </span>

                                                <!-- Time Since Posted -->
                                                <span class="card-time">
                                                    <i class="fas fa-calendar-alt"></i>
                                                    <!-- Calendar icon for time posted -->
                                                    {{ $job->created_at->diffForHumans() }}
                                                </span>
                                            </div> --}}
                                            <div class="mt-5" style="display: flex; gap: 12px;">
                                                <!-- Job Type -->
                                                <span class=""
                                                    style="display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666;">
                                                    <i class="fas fa-briefcase"
                                                        style="font-size: 16px; color: #129079a2;"></i>
                                                    <!-- Briefcase icon for job type -->
                                                    {{ $job?->jobType?->name }}
                                                </span>

                                                <!-- Job Experience -->
                                                <span class=""
                                                    style="display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666;">
                                                    <i class="fas fa-clock" style="font-size: 16px; color: #129079a2;"></i>
                                                    <!-- Clock icon for experience -->
                                                    {{ $job?->jobExperience?->name }}
                                                </span>

                                                <!-- Time Since Posted -->
                                                <span class=""
                                                    style="display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666;">
                                                    <i class="fas fa-calendar-alt"
                                                        style="font-size: 16px; color: #129079a2;"></i>
                                                    <!-- Calendar icon for time posted -->
                                                    {{ $job->created_at->diffForHumans() }}
                                                </span>
                                            </div>
                                            {{-- <p class="font-sm color-text-paragraph mt-10">Lorem ipsum dolor sit amet,
                                                consectetur adipisicing
                                                elit. Recusandae architecto eveniet, dolor quo repellendus pariatur</p> --}}
                                            <div class="mb-15 mt-30">
                                                @foreach ($job?->skills->shuffle() as $jobSkill)
                                                    @if ($loop->iteration < 6)
                                                        <a class="btn btn-grey-small mr-5 job-skill"
                                                            href="javascript:void(0)">
                                                            {{ $jobSkill?->skill?->name }}

                                                        </a>
                                                    @elseif ($loop->iteration == 6)
                                                        <a class="btn btn-grey-small mr-5 job-skill" data-toggle="modal"
                                                            data-target="#skillsModal" href="javascript:void(0)">
                                                            More ...
                                                        </a>
                                                    @endif
                                                @endforeach
                                            </div>

                                            <!-- Modal -->
                                            <div class="modal fade" id="skillsModal" tabindex="-1"
                                                aria-labelledby="skillsModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="skillsModalLabel">All Skills</h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            @foreach ($job->skills as $jobSkill)
                                                                <a class="btn btn-grey-small mr-5 job-skill"
                                                                    href="javascript:void(0)">
                                                                    {{ $jobSkill?->skill?->name }}
                                                                </a>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card-2-bottom mt-20">
                                                <div class="row">
                                                    @if ($job?->salary_mode === 'range')
                                                        <div class="col-lg-7 col-7">
                                                            <span class="card-text-price">
                                                                {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                                                {{ config('settings.site_default_currency') }}
                                                            </span>
                                                            <span class="text-muted">/ {{ $job?->salaryType?->name }}
                                                            </span>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-7 col-7">
                                                            <span class="card-text-price">
                                                                {{ $job?->custom_salary }}
                                                            </span>
                                                            <span class="text-muted">
                                                                / {{ $job?->salaryType?->name }}
                                                            </span>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-5 col-5 text-end">
                                                        <div class="btn bookmark-btn" data-bs-toggle="modal"
                                                            data-bs-target="#ModalApplyJobForm">
                                                            <i class="far fa-bookmark"></i>
                                                            {{-- <i class="fas fa-bookmark"></i> --}}


                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Empty State - No Jobs Found -->
                            @empty
                                <div class="col-12">
                                    <div class="empty-jobs-container text-center py-5 my-4">
                                        <div class="empty-state-icon mb-4">
                                            <img src="{{ asset('frontend/default-uploads/employees-tired.svg') }}"
                                                alt="No jobs found" class="img-fluid" style="max-width: 450px;">
                                        </div>
                                        <h3 class="font-bold mb-3">No Job Listings Found</h3>
                                        <p class="text-muted mb-4">We couldn't find any job openings matching your current
                                            filters.</p>
                                        <div class="empty-state-actions d-flex justify-content-center gap-3 flex-wrap">
                                            <a href="{{ route('jobs.index') }}" class="btn btn-primary">
                                                <i class="fas fa-filter me-2"></i> Clear All Filters
                                            </a>
                                            <a href="{{ route('company.jobs.create') }}" class="btn btn-default"
                                                style="color: white; border: none;">
                                                <i class="fas fa-plus me-2"></i> Post a Job
                                            </a>
                                        </div>

                                        <div class="job-suggestions mt-5">
                                            <h5 class="font-medium mb-3">Popular Categories</h5>
                                            <div
                                                class="suggested-searches d-flex flex-wrap justify-content-center gap-2 mt-3">
                                                @foreach ($popularCategories as $category)
                                                    <a href="{{ route('jobs.index', ['category' => $category?->slug]) }}"
                                                        class="badge rounded-pill px-3 py-2"
                                                        style="background-color: rgba(18, 144, 121, 0.1); color: #129079; text-decoration: none; font-weight: normal;">
                                                        {{ $category->name }}
                                                    </a>
                                                @endforeach

                                                @foreach ($popularJobTypes as $type)
                                                    <a href="{{ route('jobs.index', ['jobtype' => $type->slug]) }}"
                                                        class="badge rounded-pill px-3 py-2"
                                                        style="background-color: rgba(18, 144, 121, 0.1); color: #129079; text-decoration: none; font-weight: normal;">
                                                        {{ $type->name }}
                                                    </a>
                                                @endforeach
                                            </div>
                                        </div>


                                    </div>
                                </div>
                            @endforelse

                        </div>
                    </div>
                    <div class="paginations">
                        <nav class="d-inline-block">
                            @if ($jobs->hasPages())
                                {{ $jobs->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-12 col-sm-12 col-12">
                    <div class="sidebar-shadow none-shadow mb-30">
                        <div class="sidebar-filters">
                            <div class="filter-block head-border mb-30">
                                <h5>Advance Filter <a class="link-reset" href="#">Reset</a></h5>
                            </div>

                            <form action="{{ route('jobs.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <div class="form-group">
                                        <input type="text" name="search" value="{{ request()?->search }}"
                                            class="form-control form-icons" placeholder="Search">
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="country" class="form-control country form-icons  select-active">
                                            <option value="">Country</option>
                                            <option value="">All</option>

                                            @foreach ($countries as $country)
                                                <option @selected(request()?->country == $country?->id) value="{{ $country?->id }}">
                                                    {{ $country?->name }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="state" class="form-control state form-icons select-active">
                                            <option value="">All</option>

                                            @if ($selectedStates)
                                                @foreach ($selectedStates as $state)
                                                    <option @selected(request()?->state == $state?->id) value="{{ $state?->id }}">
                                                        {{ $state?->name }}</option>
                                                @endforeach
                                            @else
                                                <option>State</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <div class="form-group select-style">
                                        <select name="city" class="form-control city form-icons select-active">
                                            <option value="">All</option>
                                            @if ($selectedCities)
                                                @foreach ($selectedCities as $city)
                                                    <option @selected(request()?->city == $city?->id) value="{{ $city?->id }}">
                                                        {{ $city?->name }}</option>
                                                @endforeach
                                            @else
                                                <option>City</option>
                                            @endif

                                        </select>
                                        <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                            type="submit">Search</button>
                                    </div>
                                </div>
                            </form>

                            <form action="{{ route('jobs.index') }}" method="GET">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Categories</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            @foreach ($jobCategories as $jobCategory)
                                                <li>
                                                    <label class="cb-container">
                                                        <input name="category[]" value="{{ $jobCategory?->slug }}"
                                                            type="checkbox"><span
                                                            class="text-small">{{ $jobCategory?->name }}</span><span
                                                            class="checkmark"></span>
                                                    </label><span
                                                        class="number-item">{{ $jobCategory?->jobs_count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-25">Salary Range</h5>
                                    <div class="list-checkbox pb-20">
                                        <div class="row position-relative mt-10 mb-20">
                                            <div class="col-sm-12 box-slider-range">
                                                <div id="slider-range"></div>
                                            </div>
                                            <div class="box-input-money">
                                                <input class="input-disabled form-control min-value-money" type="text"
                                                    name="min-value-money" disabled="disabled" value="">
                                                <input class="form-control min-value" type="hidden" name="min_salary"
                                                    value="">
                                            </div>
                                        </div>
                                        <div class="box-number-money">
                                            <div class="row mt-30">
                                                <div class="col-sm-6 col-6"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}0</span>
                                                </div>
                                                <div class="col-sm-6 col-6 text-end"><span
                                                        class="font-sm color-brand-1">{{ config('settings.site_currency_icon') }}100,000</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Job type</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            @foreach ($jobTypes as $jobType)
                                                <li>
                                                    <label class="cb-container">
                                                        <input name="jobtype[]" value="{{ $jobType?->slug }}"
                                                            type="checkbox"><span
                                                            class="text-small">{{ $jobType?->name }}</span><span
                                                            class="checkmark"></span>
                                                    </label>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                    type="submit">Search</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.country').on('change', function() {
                let country_id = $(this).val();
                // remove all previous cities
                $('.city').html("")
                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-states', ':id') }}'.replace(":id", country_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value = "${value.id}">${value.name}</option>`
                        });

                        html = ` <option value="">Choose</option>` + html;

                        $('.state').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });

            // get cities
            $('.state').on('change', function() {
                let state_id = $(this).val();


                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-cities', ':id') }}'.replace(":id", state_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value = "${value.id}">${value.name}</option>`
                        });
                        html = ` <option value="">Choose</option>` + html;
                        $('.city').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });
        })
    </script>
@endpush
