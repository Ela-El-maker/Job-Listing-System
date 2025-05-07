@extends('admin.layouts.master')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Create Page Builder</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('admin.page-builder.store') }}" method="POST">
            @csrf

            <div class="card">
                <div class="card-header">
                    <h4>Create Page </h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" name="page_name" class="form-control" value="{{ old('page_name') }}">
                    </div>

                    <div class="form-group">
                        <label for="content">Page Content</label>
                        <textarea name="content" class="form-control" id="editor" rows="10">{{ old('content') }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Save Page</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection

