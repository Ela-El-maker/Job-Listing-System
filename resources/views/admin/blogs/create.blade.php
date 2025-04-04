@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Create Blog </h1>
        </div>

        <div class="section-body">
            {{-- @foreach ($errors->all() as $error)
                <div class="text-danger">
                    {{ $error }}
                </div>
            @endforeach --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Create Blog </h4>
                    </div>
                    <div class="card-body ">
                        <form action="{{ route('admin.blogs.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            {{-- Image Upload --}}
                            {{-- <x-image-preview :height="200" :width="200" :source="" /> --}}
                            <div class="form-group mb-3">
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file {{ hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                            {{-- Title --}}
                            <div class="form-group mb-3">
                                <label for="title">Title</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title') }}" name="title"
                                    value="{{ old('title') }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            {{-- Description (CKEditor) --}}
                            <div class="form-group mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control {{ hasError($errors, 'description') }}" id="editor" name="description">{{ old('description') }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>


                            {{-- Row for Status & Featured --}}
                            <div class="row mb-3">
                                {{-- Status --}}
                                <div class="col-md-6">
                                    <label for="status">Status</label>
                                    <select class="form-control select2 {{ hasError($errors, 'status') }}" name="status">
                                        <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('status')" class="mt-2" />
                                </div>

                                {{-- Featured --}}
                                <div class="col-md-6">
                                    <label for="featured">Featured</label>
                                    <select class="form-control select2 {{ hasError($errors, 'featured') }}"
                                        name="featured">
                                        <option value="1" {{ old('featured') == 1 ? 'selected' : '' }}>Yes</option>
                                        <option value="0" {{ old('featured') == 0 ? 'selected' : '' }}>No</option>
                                    </select>
                                    <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                </div>
                            </div>

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
