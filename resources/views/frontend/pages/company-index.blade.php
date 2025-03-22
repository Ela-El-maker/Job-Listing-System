@extends('frontend.layouts.master')

@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Recruiters</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Companies</li>
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
                    <div class="content-page company_page">
                        <div class="box-filters-job">
                            <div class="row">

                            </div>
                        </div>
                        <div class="row text-center">
                            @forelse ($companies as $company)
                                <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12">
                                    <div class="card-grid-1 hover-up wow animate__animated animate__fadeIn">
                                        <div class="image-box"><a href="{{ route('companies.show', $company?->slug) }}"><img
                                                    src="{{ asset($company->logo) }}" alt="joblist"></a></div>
                                        <div class="info-text mt-10">
                                            <h5 class="font-bold"><a
                                                    href="{{ route('companies.show', $company?->slug) }}">{{ $company?->name }}</a>
                                            </h5>

                                            <span class="card-location">
                                                {{ formatLocation($company?->companyCountry?->name, $company?->companyState?->name) }}
                                            </span>
                                            <div class="mt-30">
                                                <a class="btn btn-grey-big"
                                                    href="{{ route('companies.show', $company?->slug) }}">
                                                    <span>{{ $company?->jobs_count }}</span><span> Jobs
                                                        Open</span></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state-container text-center py-5">
                                    <div class="empty-state-icon mb-4">
                                        <img src="{{ asset('frontend/default-uploads/company1.svg') }}"
                                            alt="No companies found" class="img-fluid" style="max-width: 200px;">
                                    </div>
                                    <h3 class="font-bold mb-3">No Companies Found</h3>
                                    <p class="text-muted mb-4">We couldn't find any companies matching your criteria.</p>
                                    <div class="empty-state-actions">
                                        <a href="{{ route('companies.index') }}" style="padding: 17px"
                                            class="btn btn-outline-primary">
                                            <i class="icon-refresh mr-1"></i> Reset Filters
                                        </a>
                                        <a href="{{ route('company.jobs.create') }}" class="btn btn-default mr-2">
                                            <i class="icon-plus mr-1"></i> Add Your Company
                                        </a>
                                    </div>
                                    <div class="mt-4">
                                        <p class="small text-muted">Looking for something specific? Try adjusting your
                                            search criteria or explore our featured companies.</p>
                                    </div>
                                </div>
                            @endforelse


                        </div>
                    </div>
                    <div class="paginations">
                        <nav class="d-inline-block">
                            @if ($companies?->hasPages())
                                {{ $companies->withQueryString()->links() }}
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
                            <form action="{{ route('companies.index') }}" method="GET">
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
                            <form action="" method="get">
                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Industry</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <li class="">
                                                {{-- <label class="">
                                                    <a class="text-small {{ request()?->industry == $type?->slug ? 'x-active' : '' }}"
                                                        href="{{ route('companies.index', ['industry' => $type?->slug]) }}">{{ $type?->name }}</a>
                                                </label>
                                                <span class="number-item">{{ $type?->companies_count }}</span> --}}


                                                <label class="d-flex">
                                                    <input type="radio" name="industry" value="" class="x-radio">
                                                    <span class="text-small">ALL</span>
                                                </label>
                                            </li>
                                            @foreach ($industryTypes as $type)
                                                <li class="active">
                                                    {{-- <label class="">
                                                        <a class="text-small {{ request()?->industry == $type?->slug ? 'x-active' : '' }}"
                                                            href="{{ route('companies.index', ['industry' => $type?->slug]) }}">{{ $type?->name }}</a>
                                                    </label>
                                                    <span class="number-item">{{ $type?->companies_count }}</span> --}}


                                                    <label class="d-flex">
                                                        <input type="radio" @checked($type?->slug == request()?->industry) name="industry"
                                                            value="{{ $type?->slug }}" class="x-radio">
                                                        <span class="text-small">{{ $type?->name }}</span>
                                                    </label>
                                                    <span class="number-item">{{ $type?->companies_count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>


                                <div class="filter-block mb-20">
                                    <h5 class="medium-heading mb-15">Organisation</h5>
                                    <div class="form-group">
                                        <ul class="list-checkbox">
                                            <label class="d-flex">
                                                <input type="radio" name="organization" value=""
                                                    class="x-radio">
                                                <span class="text-small">ALL</span>
                                            </label>
                                            @foreach ($organisations as $type)
                                                <li class="">
                                                    <label class="d-flex">
                                                        <input @checked($type?->slug == request()->organization) type="radio"
                                                            name="organization" value="{{ $type?->slug }}"
                                                            class="x-radio">
                                                        <span class="text-small">{{ $type?->name }}</span>
                                                    </label>
                                                    <span class="number-item">{{ $type?->companies_count }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!--search button-->
                                <div class="filter-block mb-20">
                                    <button class="submit btn btn-default mt-10 rounded-1 w-100"
                                        type="submit">Search</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
