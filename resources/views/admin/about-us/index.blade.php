@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Edit About Us</h1>
        </div>

        <div class="section-body">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update About Us Section</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.about-us.update',1) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')


                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group mb-3">
                                <x-image-preview :height="200" :width="400" :source="old('image', $about?->image ?? null)" name="image"
                                    label="Current Image" class="mb-3" />
                                {{-- If the hero has an image, show it --}}
                                <label for="image">Image</label>
                                <input type="file" class="form-control-file {{ hasError($errors, 'image') }}"
                                    name="image">
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>
                        </div>

                    </div>
                            <div class="form-group">
                                <label>About Title</label>
                                <input type="text" name="about_title" class="form-control {{ hasError($errors, 'about_title') }}"
                                       value="{{ old('about_title', $about?->about_title) }}">
                                <x-input-error :messages="$errors->get('about_title')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label>About Description</label>
                                <textarea name="about_description" rows="5"
                                          class="form-control {{ hasError($errors, 'about_description') }}">{{ old('about_description', $about?->about_description) }}</textarea>
                                <x-input-error :messages="$errors->get('about_description')" class="mt-2" />
                            </div>



                            <div class="form-group">
                                <label>Title</label>
                                <input type="text" name="title" class="form-control {{ hasError($errors, 'title') }}"
                                       value="{{ old('title', $about?->title) }}">
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="5" id="editor"
                                          class="form-control {{ hasError($errors, 'description') }}">{{ old('description', $about?->description) }}</textarea>
                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <label>URL</label>
                                <input type="text" name="url" class="form-control {{ hasError($errors, 'url') }}"
                                       value="{{ old('url', $about?->url) }}">
                                <x-input-error :messages="$errors->get('url')" class="mt-2" />
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
