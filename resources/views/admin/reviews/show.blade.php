@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Review Details</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0">Review Details</h4>
                    </div>

                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5>Name:</h5>
                                <p class="text-muted">{{ $review->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h5>Title:</h5>
                                <p class="text-muted">{{ $review->title }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Rating:</h5>
                                <p class="text-muted">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <span class="fas fa-star {{ $i <= $review->rating ? 'text-warning' : 'text-muted' }}"></span>
                                    @endfor
                                    ({{ $review->rating }} stars)
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <h5>Review:</h5>
                                <p class="text-muted">{!! $review->review !!}</p>
                            </div>
                        </div>

                        @if($review->image)
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5>Image:</h5>
                                    <div class="d-flex justify-content-center">
                                        <img src="{{ asset($review->image) }}" style="max-width: 300px; height: auto; border-radius: 8px;" alt="Review Image">
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="form-group mt-4">
                            <a href="{{ route('admin.reviews.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Back to Reviews</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
