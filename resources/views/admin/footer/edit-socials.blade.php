@extends('admin.layouts.master')
@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Edit Social Icon</h1>
        <div class="section-header-breadcrumb">
            <a href="{{ route('admin.social-icon.index') }}" class="btn btn-primary">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <form action="{{ route('admin.social-icon.update', $socialIcon->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Social Icon</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="icon">Icon Class <span class="text-danger">*</span></label>

                                <div role="iconpicker" data-align="left" name="icon" data-icon="{{ $socialIcon?->icon }}"
                                        class="{{ hasError($errors, 'icon') }}">
                                @error('icon')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="url">URL <span class="text-danger">*</span></label>
                                <input type="text" name="url" class="form-control"
                                    placeholder="e.g. https://twitter.com/yourpage"
                                    value="{{ old('url', $socialIcon->url) }}" >
                                @error('url')
                                    <div class="text-danger mt-1">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">
                                <i class="fas fa-save"></i> Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
