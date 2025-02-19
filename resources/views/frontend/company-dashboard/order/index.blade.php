@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Company Orders</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="{{ url('/') }}">Home</a></li>
                            <li>Company Orders</li>
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
                            <h4 class="ps-4 pt4">All Orders for {{ auth()->user()->name }}</h4>
                            <div class="card-header-form">
                                <form action="" method="GET" class="d-flex justify-content-center">
                                    <div class="input-group" style="max-width: 300px;">
                                        <input type="text" name="search" class="form-control" placeholder="Search"
                                            value="{{ request('search') }}">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <tr>
                                        <th>Order No.</th>
                                        <th>Plan</th>
                                        <th>Paid Amount</th>
                                        <th>Payment Method</th>
                                        <th>Payment Status</th>
                                        <th style="width: 20%">Action</th>
                                    </tr>
                                    <tbody>
                                        @forelse ($orders as $order)
                                            <tr>
                                                <td>
                                                    #{{ $order?->order_id }}

                                                </td>

                                                <td>
                                                    <div>
                                                        {{ $order?->package_name }}
                                                    </div>
                                                </td>
                                                <td>
                                                    <div>
                                                        {{ $order?->amount }} {{ $order?->paid_in_currency }}
                                                    </div>
                                                </td>

                                                <td>{{ $order?->payment_provider }}</td>
                                                <td>
                                                    <p class="badge bg-success rounded-pill">
                                                        {{ $order?->payment_status }}
                                                    </p>
                                                </td>

                                                <td>
                                                    <a href="{{ route('company.orders.show', $order?->id) }}"
                                                        class="btn-sm btn btn-primary"><i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center"> No Results Found! </td>
                                            </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                @if ($orders->hasPages())
                                    {{ $orders->withQueryString()->links() }}
                                @endif
                            </nav>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
@endsection
