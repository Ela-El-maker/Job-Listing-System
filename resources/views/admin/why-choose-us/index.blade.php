@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Create Why Choose Us</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Create Home Why</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.why-choose-us.update',1) }}" method="post">
                    @csrf
                    @method('PUT')
                    <!-- Row 1: Icon 1, Title 1, Sub Description 1 -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Icon 1</label>
                                <div role="iconpicker" data-align="left" name="icon_one" data-icon="{{ $whyChooseUs?->icon_one }}"
                                    class="{{ hasError($errors, 'icon_one') }}"></div>
                                <x-input-error :messages="$errors->get('icon_one')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title 1</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title_one') }}"
                                    name="title_one" value="{{ old('title_one',$whyChooseUs?->title_one) }}">
                                <x-input-error :messages="$errors->get('title_one')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Title 1</label>
                                <textarea name="sub_title_one" rows="5" class="form-control {{ hasError($errors, 'sub_title_one') }}">{{ old('sub_title_one',$whyChooseUs?->sub_title_one) }}</textarea>
                                <x-input-error :messages="$errors->get('sub_title_one')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Row 2: Icon 2, Title 2, Sub Description 2 -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Icon 2</label>
                                <div role="iconpicker" data-icon="{{ $whyChooseUs?->icon_two }}" data-align="left" name="icon_two"
                                    class="{{ hasError($errors, 'icon_two') }}"></div>
                                <x-input-error :messages="$errors->get('icon_two')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title 2</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title_two') }}"
                                    name="title_two" value="{{ old('title_two',$whyChooseUs?->title_two) }}">
                                <x-input-error :messages="$errors->get('title_two')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Title 2</label>
                                <textarea name="sub_title_two" rows="5" class="form-control {{ hasError($errors, 'sub_title_two') }}">{{ old('sub_title_two',$whyChooseUs?->sub_title_two) }}</textarea>
                                <x-input-error :messages="$errors->get('sub_title_two')" class="mt-2" />
                            </div>
                        </div>
                    </div>

                    <hr>
                    <!-- Row 3: Icon 3, Title 3, Sub Description 3 -->
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Icon 3</label>
                                <div role="iconpicker" data-icon="{{ $whyChooseUs?->icon_three }}" data-align="left" name="icon_three"
                                    class="{{ hasError($errors, 'icon_three') }}"></div>
                                <x-input-error :messages="$errors->get('icon_three')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Title 3</label>
                                <input type="text" class="form-control {{ hasError($errors, 'title_three') }}"
                                    name="title_three" value="{{ old('title_three',$whyChooseUs?->title_three) }}">
                                <x-input-error :messages="$errors->get('title_three')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sub Title 3</label>
                                <textarea name="sub_title_three" rows="5"
                                    class="form-control {{ hasError($errors, 'sub_title_three') }}">{{ old('sub_title_three',$whyChooseUs?->sub_title_three) }}</textarea>
                                <x-input-error :messages="$errors->get('sub_title_three')" class="mt-2" />
                            </div>
                        </div>
                    </div>
<hr>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
