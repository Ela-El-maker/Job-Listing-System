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


                    <div
                        style="padding: 20px; border-bottom: 1px solid #eaedf2; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 15px;">
                        <h4 style="margin: 0; color: #333; font-weight: 600;">All Orders for {{ auth()->user()->name }}</h4>

                        <div>
                            <form action="" method="GET" style="display: flex;">
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
                    </div>

                    <div style="padding: 0;">
                        <div style="overflow-x: auto;">
                            <table style="width: 100%; border-collapse: separate; border-spacing: 0;">
                                <thead>
                                    <tr style="background-color: #f8f9fa;">
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left;">
                                            Order No.</th>
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left;">
                                            Plan</th>
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left;">
                                            Paid Amount</th>
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left;">
                                            Payment Method</th>
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left;">
                                            Payment Status</th>
                                        <th
                                            style="padding: 15px; border-bottom: 2px solid #e9ecef; font-weight: 600; color: #495057; text-align: left; width: 20%;">
                                            Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders as $order)
                                        <tr
                                            style="transition: background-color 0.2s; border-bottom: 1px solid #e9ecef; background-color: white;">
                                            <td
                                                style="padding: 15px; vertical-align: middle; font-weight: 600; color: #333; font-size: 14px;">
                                                #{{ $order?->order_id }}
                                            </td>
                                            <td
                                                style="padding: 15px; vertical-align: middle; color: #444; font-size: 14px;">
                                                {{ $order?->package_name }}
                                            </td>
                                            <td
                                                style="padding: 15px; vertical-align: middle; font-weight: 600; color: #333; font-size: 14px;">
                                                {{ $order?->amount }} <span
                                                    style="color: #6c757d; font-size: 13px; font-weight: normal;">{{ $order?->paid_in_currency }}</span>
                                            </td>
                                            <td
                                                style="padding: 15px; vertical-align: middle; color: #444; font-size: 14px;">
                                                {{ $order?->payment_provider }}
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle;">
                                                <span
                                                    style="display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 500; text-transform: uppercase; letter-spacing: 0.5px; background-color: rgba(76, 175, 80, 0.15); color: #4CAF50;">
                                                    {{ $order?->payment_status }}
                                                </span>
                                            </td>
                                            <td style="padding: 15px; vertical-align: middle;">
                                                <a href="{{ route('company.orders.show', $order?->id) }}"
                                                    style="display: inline-flex; align-items: center; justify-content: center; padding: 6px 14px; background-color: #4361ee; color: white; border-radius: 4px; text-decoration: none; transition: background-color 0.2s; font-size: 13px; font-weight: 500;">
                                                    <i class="fas fa-eye" style="margin-right: 6px;"></i> View Details
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" style="padding: 30px; text-align: center; color: #6c757d;">
                                                <div style="font-size: 16px; margin-bottom: 5px;">No Orders Found</div>
                                                <div style="font-size: 14px;">Your purchase history will appear here</div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div style="padding: 15px; border-top: 1px solid #eaedf2; text-align: right;">
                        <nav style="display: inline-block;">
                            @if ($orders->hasPages())
                                {{ $orders->withQueryString()->links() }}
                            @endif
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
