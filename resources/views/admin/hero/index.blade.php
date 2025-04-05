@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Hero Section</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Create Hero</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.hero.update', 1) }}" method="POST" enctype="multipart/form-data">
                    {{-- If you want to create a new hero, use POST method --}}
                    {{-- If you want to update an existing hero, use PUT method --}}
                    @csrf
                    @method('PUT') {{-- This is important for updating the hero --}}

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <x-image-preview :height="200" :width="400" :source="old('image', $hero->image ?? null)" name="image"
                                    label="Current Image" class="mb-3" />
                                {{-- If the hero has an image, show it --}}
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file {{ hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <x-image-preview :height="200" :width="400" :source="old('background_image', $hero->background_image ?? null)" name="image"
                                    label="Current Image" class="mb-3" />
                                <label for="image">Background Image</label>
                                <input type="file" class="form-control-file {{ hasError($errors, 'background_image') }}"
                                    name="background_image">
                                <x-input-error :messages="$errors->get('background_image')" class="mt-2" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" class="form-control {{ hasError($errors, 'title') }}"
                            value="{{ old('title', $hero?->title) }}" name="title">
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    {{-- Sub TiTle (CKEditor) --}}
                    <div class="form-group mb-3">
                        <label for="description">Sub Title</label>
                        <textarea class="form-control {{ hasError($errors, 'sub_title') }}" id="editor" name="sub_title">{{ old('sub_title', $hero?->sub_title) }}</textarea>
                        <x-input-error :messages="$errors->get('sub_title')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
