@extends('frontend.layouts.master')

@section('contents')
    <style>
        .card-grid-2 img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Candidates</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Candidates</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="content-page">

                <div class="row">
                    <div class="col-lg-3">
                        <div class="sidebar-shadow none-shadow mb-30">
                            <div class="sidebar-filters">
                                <form action="{{ route('candidates.index') }}" method="get">
                                    <div class="filter-block mb-30">
                                        <div class="filter-block head-border mb-30">
                                            <h5>Advance Filter <a class="link-reset" href="#">Reset</a></h5>
                                        </div>

                                        <div class="filter-block mb-30">
                                            <h5 class="medium-heading mb-15">Skills</h5>

                                            <div class="form-group select-style">
                                                <select name="skills[]" multiple
                                                    class="form-control form-icons select-active">
                                                    <option value="">All</option>
                                                    @foreach ($skills as $skill)
                                                        <option @selected(request()->has('skills') ? in_array($skill?->slug, request()->skills) : false) value="{{ $skill?->slug }}">
                                                            {{ $skill?->name }}</option>
                                                    @endforeach
                                                </select>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="filter-block mb-20">
                                        <h5 class="medium-heading mb-15">Experiences</h5>
                                        <div class="form-group">
                                            <ul class="list-checkbox">
                                                <li class="">
                                                    <label class="d-flex">
                                                        <input type="radio" name="experience" value=""
                                                            class="x-radio">
                                                        <span class="text-small">ALL</span>
                                                    </label>
                                                </li>
                                                @foreach ($experience as $type)
                                                    <li class="active">
                                                        <label class="d-flex">
                                                            <input type="radio" @checked($type?->id == request()->experience)
                                                                name="experience" class="x-radio"
                                                                value="{{ $type?->id }}">
                                                            <span class="text-small">{{ $type?->name }}</span>
                                                        </label>
                                                        <span class="number-item">{{ $type?->companies_count }}</span>
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
                    <div class="col-xl-9">

                        <div class="row">
                            @forelse ($candidates as $candidate)
                                <div class="col-lg-4 col-md-6">
                                    <div class="card-grid-2 hover-up">
                                        <div class="card-grid-2-image-left d-flex">
                                            <div class="card-grid-2-image-rd online"><a
                                                    href="{{ route('candidates.show', $candidate?->slug) }}">
                                                    <figure>
                                                        <img alt="joblist" src="{{ asset($candidate?->image) }}">
                                                    </figure>
                                                </a></div>
                                            <div class="card-profile pt-10"><a
                                                    href="{{ route('candidates.show', $candidate?->slug) }}">
                                                    <h5>{{ $candidate?->full_name }}</h5>
                                                </a><span class="font-xs color-text-mutted">{{ $candidate?->title }}</span>
                                                <div class="rate-reviews-small pt-5">
                                                    @if ($candidate?->status === 'available')
                                                        <p class="font-sm color-text-paragraph-2"><b>I am available.</b>
                                                        </p>
                                                    @else
                                                        <p class="font-sm color-text-paragraph-2"><b>I am not
                                                                available.</b></p>
                                                    @endif


                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-block-info">
                                            <div class="card-2-bottom card-2-bottom-candidate mt-30">
                                                <div class="text-start">

                                                    @foreach ($candidate->skills as $candidateSkill)
                                                        @if ($loop->index <= 5)
                                                            <a class="btn btn-tags-sm mb-10 mr-5"
                                                                href="jobs-grid.html">{{ $candidateSkill->skill?->name }}</a>
                                                        @endif
                                                    @endforeach

                                                </div>
                                            </div>
                                            <div class="employers-info align-items-center justify-content-center mt-15">
                                                <div class="row">
                                                    <div class="col-6"><span class="d-flex align-items-center"><i
                                                                class="fi-rr-marker mr-5 ml-0"></i><span
                                                                class="font-sm color-text-mutted">{{ $candidate->candidateCountry?->name }}</span></span>
                                                    </div>
                                                    <div class="col-6"><span
                                                            class="d-flex justify-content-end align-items-center"><span
                                                                class="font-sm"><a href=""
                                                                    class="text-primary d-flex align-items-center">Resume
                                                                    <i style="margin-bottom: -5px"
                                                                        class="fi fi-rr-arrow-right"></i></a></span></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="card shadow-sm p-5 text-center">
                                        <div class="mb-4">
                                            <img src="{{ asset('frontend/default-uploads/employee-employer.svg') }}"
                                                alt="No candidates found" class="img-fluid" style="max-height: 200px;">
                                        </div>
                                        <h3 class="color-brand-1 mb-2">No Candidates Found</h3>
                                        <p class="font-md color-text-paragraph mb-4">We couldn't find any candidates
                                            matching your search criteria.</p>
                                        <div class="d-flex justify-content-center gap-3">
                                            <a href="{{ route('candidates.index') }}" class="btn btn-default mr-15">Clear
                                                Filters</a>
                                            <a href="{{ url('/') }}" class="btn btn-outline">Back to Home</a>
                                        </div>
                                    </div>
                                </div>
                            @endforelse



                            <div class="col-12">
                                <div class="paginations mt-35">
                                    <nav class="d-inline-block">
                                        @if ($candidates?->hasPages())
                                            {{ $candidates->withQueryString()->links() }}
                                        @endif
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
