@extends('frontend.layouts.master')
@section('contents')
    <!-- Hero Section Start-->
    @include('frontend.home.sections.hero-section')
    <!-- Hero Section End-->

    <div class="mt-100"></div>
    <!-- Job Category Section Start-->
    @include('frontend.home.sections.category-section')
    <!-- Job Category Section End-->


    <!-- Featured Job Section Start-->
    @include('frontend.home.sections.featured-job-section')
    <!-- Featured Job Section End-->


    <!-- Why Choose Us Section Start-->
    @include('frontend.home.sections.why-choose-us-section')
    <!-- Why Choose Us Section End-->


    <!-- Learn More Section Start-->
    @include('frontend.home.sections.learn-more-section')
    <!-- Learn More Section End-->



    <!-- Counter Section Start-->
    @include('frontend.home.sections.counter-section')
    <!-- Counter Section End-->


    <!-- Top Recruiters Section Start-->
    @include('frontend.home.sections.top-recruiters-section')
    <!-- Top Recruiters Section End-->


    <!-- Price Plan Section Start-->
    @include('frontend.home.sections.price-plan-section')
    <!-- Price Plan Section End-->


    <!-- Job By Location Section Start-->
    @include('frontend.home.sections.job-by-location-section')
    <!-- Job By Location Section End-->

    <!-- Review Section Start-->
    @include('frontend.home.sections.review-section')
    <!-- Review Section End-->


    <!-- Blog Section Start-->
    @include('frontend.home.sections.blog-section')
    <!-- Blog Section End-->
@endsection
