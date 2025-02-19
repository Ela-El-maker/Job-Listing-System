@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Orders</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Orders</h4>
                <div class="card-header-form">
                    <form action="" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" style="height: 42px" class="btn btn-primary"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Order & Transaction</th>
                            <th>Company</th>
                            <th>Plan</th>
                            <th>Paid Amount</th>
                            <th>Main Price</th>
                            <th>Payment Method</th>
                            <th>Payment Status</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>
                                        # {{ $order?->order_id }}
                                        <br>
                                        Transaction: {{ $order?->transaction_id }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img style="width: 50px; height: 50px; object-fit:cover;"
                                                    src="{{ asset($order?->company->logo) }}" alt="" srcset="">
                                            </div>

                                            <div>
                                                <b>{{ $order?->company->name }}</b>
                                                <br>

                                                <b>{{ $order?->company->email }}</b>

                                            </div>
                                        </div>
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
                                    <td>
                                        <div>
                                            {{ $order?->default_amount }}
                                        </div>
                                    </td>
                                    <td>{{ $order?->payment_provider }}</td>
                                    <td>
                                        <p class="badge badge-info text-light">
                                            {{ $order?->payment_status }}
                                        </p>
                                    </td>

                                    <td>
                                        <a href="{{ route('admin.orders.show', $order?->id) }}"
                                            class="btn-sm btn btn-primary"><i class="fas fa-eye"></i> View Info </a>
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
@endsection
