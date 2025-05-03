@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Client Reviews</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Client Reviews</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.reviews.index') }}" method="GET">
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
                <a href="{{ route('admin.reviews.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Rating</th>
                            <th>Title</th>
                            <th style="width: 30%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($clientReviews as $review)
                                <tr>
                                    <td>
                                        {{ ($clientReviews->currentPage() - 1) * $clientReviews->perPage() + $loop->iteration }}
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img style="width: 50px; height: 50px; object-fit: cover;"
                                                     src="{{ asset($review?->image) }}" alt="Image">
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $review?->name }}</td>
                                    <td>
                                        <!-- Rating Stars -->
                                        <div class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <i class="fas fa-star {{ $i <= $review?->rating ? 'text-warning' : 'text-muted' }}"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>{{ $review->title }}</td>
                                    <td>
                                        <a href="{{ route('admin.reviews.show', $review?->id) }}" class="btn-small btn btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <a href="{{ route('admin.reviews.edit', $review?->id) }}" class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.reviews.destroy', $review?->id) }}" class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Results Found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($clientReviews->hasPages())
                        {{ $clientReviews->withQueryString()->links() }}
                    @endif
                </nav>

            </div>
        </div>
    </div>
@endsection
