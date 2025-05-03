@extends('admin.layouts.master')
@section('contents')

<style>
    .rating {
        direction: rtl;
        display: inline-flex;
    }

    .rating input {
        display: none;
    }

    .rating label {
        font-size: 1.8rem;
        color: lightgray;
        cursor: pointer;
    }

    .rating input:checked ~ label,
    .rating label:hover,
    .rating label:hover ~ label {
        color: gold;
    }
</style>

<section class="section">
    <div class="section-header">
        <h1>Create Review</h1>
    </div>

    <div class="section-body">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>New Review Entry</h4>
                </div>

                <div class="card-body">
                    <form action="{{ route('admin.reviews.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        {{-- Image Upload --}}
                        <div class="form-group mb-4">
                            <x-image-preview :height="200" :width="400" :source="old('image')" name="image"
                                label="Current Image" class="mb-3" />

                            <label for="image">Image</label>
                            <input type="file" class="form-control-file {{ hasError($errors, 'image') }}" name="image">
                            <x-input-error :messages="$errors->get('image')" class="mt-2" />
                        </div>

                        {{-- Name --}}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control {{ hasError($errors, 'name') }}" name="name"
                                value="{{ old('name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Title --}}
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control {{ hasError($errors, 'title') }}" name="title"
                                value="{{ old('title') }}">
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>

                        {{-- Rating --}}
                        <div class="form-group">
                            <label for="rating">Rating</label>
                            <div class="rating">
                                @for ($i = 5; $i >= 1; $i--)
                                    <input type="radio" id="star{{ $i }}" name="rating" value="{{ $i }}"
                                        {{ old('rating') == $i ? 'checked' : '' }}>
                                    <label for="star{{ $i }}" title="{{ $i }} star{{ $i > 1 ? 's' : '' }}">&#9733;</label>
                                @endfor
                            </div>
                            <x-input-error :messages="$errors->get('rating')" class="mt-2" />
                        </div>

                        {{-- Review Body --}}
                        <div class="form-group mb-3">
                            <label for="review">Review</label>
                            <textarea class="form-control {{ hasError($errors, 'review') }}" id="editor" name="review">{{ old('review') }}</textarea>
                            <x-input-error :messages="$errors->get('review')" class="mt-2" />
                        </div>

                        {{-- Submit --}}
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
