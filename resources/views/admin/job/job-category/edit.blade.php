@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Update Category</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Job Categories</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.job-categories.update', $jobCategory->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Icon</label>
                        <div role="iconpicker" data-align="left" name="icon" class="{{ hasError($errors, 'icon') }}"
                            data-icon="{{ $jobCategory?->icon }}">
                        </div>
                        <x-input-error :messages="$errors->get('icon')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control {{ hasError($errors, 'name') }}"
                            value="{{ old('name', $jobCategory?->name) }}" name="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="show_at_popular">Show At Popular</label>
                        <select name="show_at_popular"
                            class="form-control select2 {{ hasError($errors, 'show_at_popular') }}" id="show_at_popular">
                            <!-- Add your options here -->
                            <option @selected($jobCategory?->show_at_popular === 1) value="1"
                                {{ old('show_at_popular') == '1' ? 'selected' : '' }}>Yes</option>
                            <option @selected($jobCategory?->show_at_popular === 0) value="0"
                                {{ old('show_at_popular') == '0' ? 'selected' : '' }}>No</option>
                        </select>
                        <x-input-error :messages="$errors->get('show_at_popular')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
