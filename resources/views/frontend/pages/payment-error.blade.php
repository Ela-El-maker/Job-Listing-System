@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Payment Cancelled</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Payment Cancelled</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-90">
        <div class="container">
            <div style="text-align:center; margin-bottom:90px;">
                <h2>
                    <i class="fas fa-times-circle mt-2" style="font-size: 120px; color: #c51307; "></i>
                    <br>
                    Your Payment Was Cancelled.
                </h2>
                @if (session('errors'))
                    <p class="alert alert-danger mt-4" style="width: 400px; margin:auto;">
                        {{ session('errors')->first('error') }}
                    </p>
                @endif

                <a class="btn btn-default btn-shadow  hover-up mt-4" href="{{ route('company.dashboard') }}">Go to
                    Dashboard</a>
            </div>
        </div>
    </section>
@endsection
