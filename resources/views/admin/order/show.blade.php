@extends('admin.layouts.master')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Order Details</h1>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <h5 class="pl-4 pt-4">Order Info</h5>
                    <hr>
                    <div class="card-body p-0"> <!-- Removed p-0 for better spacing -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Order Id</th>
                                    <td>{{ $order?->order_id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Transaction No.</th>
                                    <td>{{ $order?->transaction_id }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Date</th>
                                    <td>{{ formatDate($order?->created_at) }}, {{ $order?->created_at->format('h:i A') }}</td>

                                </tr>

                                <tr>
                                    <th scope="row">Action</th>
                                    <td><b><a href="{{ route('admin.orders.invoice', $order?->id) }}"><i class="fas fa-download"></i> Download Invoice</a></b></td>

                                </tr>
                            </tbody>
                        </table>
                    </div> <!-- End of card-body -->
                </div> <!-- End of card -->
            </div> <!-- End of col-4 -->
            <div class="col-md-4">
                <div class="card">
                    <h5 class="pl-4 pt-4">Billing and Payment Info</h5>
                    <hr>
                    <div class="card-body p-0"> <!-- Removed p-0 for better spacing -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Company</th>
                                    <td>{{ $order->company?->name }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Email</th>
                                    <td>{{ $order->company?->email}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Payment Method</th>
                                    <td>{{ $order?->payment_provider }}</td>

                                </tr>

                            </tbody>
                        </table>
                    </div> <!-- End of card-body -->
                </div> <!-- End of card -->
            </div> <!-- End of col-4 -->
            <div class="col-md-4">
                <div class="card">
                    <h5 class="pl-4 pt-4">Plan</h5>
                    <hr>
                    <div class="card-body p-0"> <!-- Removed p-0 for better spacing -->
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th scope="row">Name</th>
                                    <td>{{ $order->plan?->label }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Price</th>
                                    <td>{{ $order?->default_amount}}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Plan Benefits</th>
                                    <td>{{ $order?->payment_provider }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Job Post Limit</th>
                                    <td>{{ $order->plan?->job_limit }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Featured Job Post Limit</th>
                                    <td>{{ $order->plan?->featured_job_limit }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Highlighted Job Post Limit</th>
                                    <td>{{ $order->plan?->highlight_job_limit }}</td>
                                </tr>
                                <tr>
                                    <th scope="row">Profile Verified</th>
                                    <td>{{ $order->plan?->profile_verified ? 'Yes ' : 'No' }}</td>
                                </tr>

                            </tbody>
                        </table>
                    </div> <!-- End of card-body -->
                </div> <!-- End of card -->
            </div> <!-- End of col-4 -->
        </div>


    </div> <!-- End of section-body -->
</section>
@endsection
