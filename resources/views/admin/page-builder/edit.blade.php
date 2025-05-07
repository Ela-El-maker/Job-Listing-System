@extends('admin.layouts.master')

@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Edit Page Builder</h1>
    </div>

    <div class="section-body">
        <form action="{{ route('admin.page-builder.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="card">
                <div class="card-header">
                    <h4>Edit Page</h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="page_name">Page Name</label>
                        <input type="text" name="page_name" class="form-control" value="{{ old('page_name', $page?->page_name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="content">Page Content</label>
                        <textarea name="content" class="form-control" id="editor" rows="10">{{ old('content', $page?->content) }}</textarea>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary">Update Page</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
