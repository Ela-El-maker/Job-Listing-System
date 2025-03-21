@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">{{ $company?->name }}</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img style="height: 374px; object-fit:cover;"
                    src="{{ asset($company?->banner) }}" alt="joblist"></div>
            <div class="box-company-profile">
                <div class="row mt-10">
                    <div class="col-lg-8 col-md-12">
                        <div>
                            <img style="height: 100px; width: 100px; object-fit:cover;" src="{{ asset($company?->logo) }}"
                                alt="" srcset="">
                        </div>
                        <h5 class="f-18">
                            {{ $company?->name }}
                            <span class="card-location font-regular ml-20">
                                {{-- {{ $company?->companyCountry->name }} --}}
                                @if ($company?->companyCountry)
                                    {{ $company?->companyCountry?->name }}

                                    @if ($company?->companyState)
                                        , {{ $company?->companyState?->name }}

                                        @if ($company?->companyCity)
                                            , {{ $company?->companyCity?->name }}
                                        @endif
                                    @endif
                                @else
                                    Location not available
                                @endif
                            </span>
                        </h5>
                    </div>
                    <div class="col-lg-4 col-md-12 text-lg-end"><a class="btn  btn-apply btn-apply-big" href="javascript:;"
                            onclick="document.getElementById('open-positions').scrollIntoView()">Open Position</a></div>
                </div>
            </div>

            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="content-single">
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="tab-about" role="tabpanel"
                                aria-labelledby="tab-about">
                                <h4>About US</h4>
                                <p>{!! $company?->bio !!}</p>
                                <h4>Company Vision</h4>
                                <p>{!! $company?->vision !!}</p>
                            </div>

                        </div>
                    </div>
                    <div class="box-related-job content-page" id="open-positions">
                        <h5 class="mb-30">Latest Open Jobs</h5>
                        <div class="box-list-jobs display-list">
                            @forelse ($openJobs as $job)
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
                            @endforelse

                        </div>
                        <div class="paginations mt-60">
                            @if ($openJobs->hasPages())
                                {{ $openJobs->withQueryString()->links() }}
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <div class="sidebar-info pl-0"><span
                                        class="sidebar-company">{{ $company?->name }}</span><span class="card-location">
                                        @if ($company?->companyCountry)
                                            {{ $company?->companyCountry?->name }}

                                            @if ($company?->companyState)
                                                , {{ $company?->companyState?->name }}

                                                @if ($company?->companyCity)
                                                    , {{ $company?->companyCity?->name }}
                                                @endif
                                            @endif
                                        @else
                                            Location not available
                                        @endif
                                    </span></div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map">
                                {!! $company?->map_link !!}
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <ul>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-briefcase"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Industry
                                            Type</span><strong
                                            class="small-heading">{{ $company->industryType?->name }}</strong></div>
                                </li>
                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-building"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Organization
                                            Type</span><strong
                                            class="small-heading">{{ $company->organizationType?->name }}</strong></div>
                                </li>

                                <li>
                                    <div class="sidebar-icon-item"><i class="fi fi-rr-user"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Team Size</span><strong
                                            class="small-heading">{{ $company->teamSize?->name }}</strong></div>
                                </li>

                                <li>
                                    <div class="sidebar-icon-item"><i class="fi-rr-clock"></i></div>
                                    <div class="sidebar-text-info"><span class="text-description">Establish
                                            Date</span><strong
                                            class="small-heading">{{ formatDate($company?->establishment_date) }}</strong>
                                    </div>
                                </li>

                            </ul>
                        </div>
                        <div class="sidebar-list-job">
                            <ul class="ul-disc">
                                <li>{{ $company?->address }}
                                    {{ $company->companyCity?->name ? ', ' . $company->companyCity?->name : ' ' }}
                                    {{ $company->companyState?->name ? ', ' . $company->companyState?->name : '' }}
                                    {{ $company->companyCountry?->name ? ', ' . $company->companyCountry?->name : '' }}
                                </li>
                                <li>Phone: {{ $company?->phone }}</li>
                                <li>Email: {{ $company?->email }}</li>

                                <li>Website: <a href="{{ $company?->website }}">{{ $company?->website }}</a></li>

                            </ul>
                            <div class="mt-30"><a class="btn btn-send-message"
                                    href="mailto:{{ $company?->email }}">Send Message</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
