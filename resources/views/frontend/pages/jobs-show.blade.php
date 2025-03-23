@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">{{ $job?->company?->name }}</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Jobs Information</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box-2">
        <div class="container">
            <div class="banner-hero banner-image-single"><img style="height: 300px; object-fit:cover;"
                    src="{{ asset($job?->company?->banner) }}" alt="joblist">
            </div>
            <div class="row mt-10">
                <div class="col-lg-8 col-md-12">
                    <h3>{{ $job?->title }}</h3>
                    <div class="mt-0 mb-15" style="display: flex; gap: 12px;">
                        {{-- <div class="mt-5" > --}}

                        <!-- Job Type -->
                        <span class=""
                            style="display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666;">
                            <i class="fas fa-briefcase" style="font-size: 16px; color: #129079a2;"></i>
                            <!-- Briefcase icon for job type -->
                            {{ $job?->jobType?->name }}
                        </span>



                        <!-- Time Since Posted -->
                        <span class=""
                            style="display: flex; align-items: center; gap: 5px; font-size: 14px; color: #666;">
                            <i class="fas fa-calendar-alt" style="font-size: 16px; color: #129079a2;"></i>
                            <!-- Calendar icon for time posted -->
                            {{ $job->created_at->diffForHumans() }}
                        </span>
                        {{-- </div> --}}
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 text-lg-end">
                    @if ($alreadyAppliedJob)
                        <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up apply-now"
                            style="background-color: #8d8c8c" data-bs-toggle="modal" data-bs-target="#ModalApplyJobForm">
                            Applied</div>
                    @else
                        <div class="btn btn-apply-icon btn-apply btn-apply-big hover-up apply-now" data-bs-toggle="modal"
                            data-bs-target="#ModalApplyJobForm">Apply now</div>
                    @endif

                </div>
            </div>
            <div class="border-bottom pt-10 pb-10"></div>
        </div>
    </section>

    <section class="section-box mt-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="job-overview">
                        <h5 class="border-bottom pb-15 mb-30">Employment Information</h5>
                        <div class="row">
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/industry.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description industry-icon mb-10">Category</span><strong
                                        class="small-heading">{{ $job?->category?->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/job-level.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span class="text-description joblevel-icon mb-10">Job
                                        Role</span><strong class="small-heading">{{ $job?->jobRole?->name }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/salary.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10">
                                    <span class="text-description salary-icon mb-10">
                                        Salary
                                    </span>
                                    <strong class="small-heading">
                                        @if ($job?->salary_mode === 'range')
                                            {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                            <span class="text-muted">
                                                per {{ $job?->salaryType?->name }}
                                            </span>
                                        @else
                                            {{ $job?->custom_salary }}
                                            <span class="text-muted">
                                                per {{ $job?->salaryType?->name }}
                                            </span>
                                        @endif
                                    </strong>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/experience.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description experience-icon mb-10">Experience</span><strong
                                        class="small-heading">{{ $job?->jobExperience?->name }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/job-type.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span class="text-description jobtype-icon mb-10">Job
                                        Type</span><strong class="small-heading">{{ $job?->jobType?->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/location.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Location</span><strong
                                        class="small-heading">{{ formatLocation($job?->country?->name, $job?->state?->name, $job?->city?->name, $job?->address) }}</strong>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/experience.svg') }}"
                                        alt="joblist"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description jobtype-icon mb-10">Education</span><strong
                                        class="small-heading">{{ $job?->jobEducation?->name }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/job-level.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Category</span><strong
                                        class="small-heading">{{ $job?->category?->name }}</strong></div>
                            </div>
                        </div>
                        <div class="row mt-25">
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/updated.svg') }}"
                                        alt="joblist"></div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description jobtype-icon mb-10">Updated</span><strong
                                        class="small-heading">{{ formatDate($job?->updated_at) }}</strong></div>
                            </div>
                            <div class="col-md-6 d-flex mt-sm-15">
                                <div class="sidebar-icon-item"><img
                                        src="{{ asset('frontend/assets/imgs/page/job-single/deadline.svg') }}"
                                        alt="joblist">
                                </div>
                                <div class="sidebar-text-info ml-10"><span
                                        class="text-description mb-10">Deadline</span><strong
                                        class="small-heading">{{ formatDate($job?->deadline) }}
                                    </strong>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="content-single">
                        {!! $job?->description !!}
                    </div>
                    <div class="author-single"><span>{{ $job?->company?->name }}</span></div>
                    <div class="single-apply-jobs">
                        <div class="row align-items-center">

                            <div class="col-md-7 text-lg-end social-share">
                                <h6 class="color-text-paragraph-2 d-inline-block d-baseline mr-10">Share this</h6>
                                <a data-social="facebook" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-fb.svg') }}"></a>
                                <a data-social="twitter" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-tw.svg') }}"></a>
                                <a data-social="reddit" class="mr-5 d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-red.svg') }}"></a>
                                <a data-social="whatsapp" class="d-inline-block d-middle" href="#"><img
                                        alt="joblist"
                                        src="{{ asset('frontend/assets/imgs/template/icons/share-whatsapp.svg') }}"></a>
                                <a data-social="linkedin" class="d-inline-block d-middle" href="#"><img
                                        alt="joblist" style="height: 45px;width:45px;"
                                        src="{{ asset('frontend/assets/imgs/template/icons/linkedin1.svg') }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-12 pl-40 pl-lg-15 mt-lg-30">
                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <div class="avatar-sidebar">
                                <figure><img alt="joblist" src="{{ $job?->company?->logo }}"></figure>
                                <div class="sidebar-info"><span
                                        class="sidebar-company">{{ $job?->company?->name }}</span><span
                                        class="card-location">{{ formatLocation($job?->company?->companyCountry?->name, $job?->company?->companyState?->name, $job?->company?->companyCity?->name) }}</span>

                                    @if ($openJobs > 0)
                                        <a class="link-underline mt-15"
                                            href="{{ route('companies.show', $job?->company->slug) }}">{{ $openJobs }}
                                            Open
                                            Jobs</a>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <div class="sidebar-list-job">
                            <div class="box-map">
                                {!! $job?->company?->map_link !!}
                            </div>
                            <ul class="ul-disc">
                                <li>{{ formatLocation($job?->country?->name, $job?->state?->name, $job?->city?->name, $job?->address) }}
                                </li>
                                <li>Phone: {{ $job?->company?->phone }}</li>
                                <li>Email: {{ $job?->company?->email }}</li>
                            </ul>
                        </div>
                    </div>

                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Skills</h6>

                        </div>
                        <div class="sidebar-list-job">
                            @foreach ($job?->skills->shuffle() as $jobSkill)
                                <a class="btn btn-grey-small mr-5 job-skill mt-2" href="javascript:void(0)">
                                    {{ $jobSkill?->skill?->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Benefits</h6>

                        </div>
                        <div class="sidebar-list-job">
                            @foreach ($job?->benefits->shuffle() as $jobBenefit)
                                <a class="btn btn-grey-small mr-5 job-skill mt-2" href="javascript:void(0)">
                                    {{ $jobBenefit?->benefit?->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>

                    <div class="sidebar-border">
                        <div class="sidebar-heading">
                            <h6 class="f-18">Tags</h6>

                        </div>
                        <div class="sidebar-list-job">
                            @foreach ($job?->tags->shuffle() as $jobTag)
                                <a class="btn btn-grey-small mr-5 job-skill mt-2" href="javascript:void(0)">
                                    {{ $jobTag?->tag?->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>


                    <div class="sidebar-border">
                        <h6 class="f-18">Similar jobs</h6>
                        <div class="sidebar-list-job">
                            <ul>


                                @forelse ($similarJobs as $similarJob)
                                    <li>
                                        <div class="card-list-4 wow animate__animated animate__fadeIn hover-up">
                                            <div class="image"><a
                                                    href="{{ route('jobs.show', $similarJob?->slug) }}"><img
                                                        style="height: 50px; width:50px;"
                                                        src="{{ asset($similarJob?->company?->logo) }}"
                                                        alt="joblist"></a></div>
                                            <div class="info-text">
                                                <h5 class="font-md font-bold color-brand-1"><a
                                                        href="{{ route('jobs.show', $similarJob?->slug) }}">{{ $similarJob?->title }}</a>
                                                </h5>
                                                <div class="mt-0"><span
                                                        class="card-briefcase">{{ $similarJob?->jobType?->name }}</span><span
                                                        class="card-time"><span>{{ $similarJob?->created_at->diffForHumans() }}</span>
                                                </div>
                                                <div class="mt-5">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <h6 class="card-price">
                                                                @if ($job?->salary_mode === 'range')
                                                                    {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                                                    <span class="text-muted">
                                                                        / {{ $job?->salaryType?->name }}
                                                                    </span>
                                                                @else
                                                                    {{ $job?->custom_salary }}
                                                                    <span class="text-muted">
                                                                        / {{ $job?->salaryType?->name }}
                                                                    </span>
                                                                @endif
                                                            </h6>
                                                        </div>
                                                        <div class="col-6 text-end"><span
                                                                class="card-briefcase">{{ formatLocation($job?->country?->name, $job?->state?->name) }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <li>
                                        <div class="card-list-4 wow animate__animated animate__fadeIn hover-up">
                                            <div class="info-text">
                                                <h5 class="font-md font-bold color-brand-1">No Similar Jobs Found</h5>
                                            </div>
                                        </div>
                                    </li>
                                @endforelse

                            </ul>
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
            $('.apply-now').on('click', function() {
                // alert('Apply now');
                $.ajax({
                    method: 'POST',
                    url: '{{ route('apply-job.store', $job?->id) }}',
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    beforeSend: function() {

                    },
                    success: function(response) {
                        notyf.success(response.message);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr);
                        let errors = xhr.responseJSON.errors;
                        $.each(errors, function(index, value) {
                            // alert(value[0]);
                            // console.log(value);
                            notyf.error(value[index]);
                        });
                    },
                });
            });
        });
    </script>
@endpush
