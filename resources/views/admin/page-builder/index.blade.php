@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Page Builder</h1>
        </div>

        <div class="section-body">
        </div>
    </section>

    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Custom Pages</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.page-builder.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search pages"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" style="height: 42px" class="btn btn-primary"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.page-builder.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Create New Page</a>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Page Name</th>
                                <th>URL</th>
                                <th>Last Updated</th>
                                <th style="width: 25%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($pages as $page)
                                <tr>
                                    <td>{{ ($pages->currentPage() - 1) * $pages->perPage() + $loop->iteration }}</td>
                                    <td>{{ $page->page_name }}</td>
                                    <td><code>/page/{{ $page->slug }}</code></td>

                                    <td>{{ $page->updated_at->format('d M Y, H:i') }}</td>
                                    <td>

                                        <a href="{{ route('admin.page-builder.edit', $page->id) }}" class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('admin.page-builder.destroy', $page?->id) }}" class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No pages found!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($pages->hasPages())
                        {{ $pages->withQueryString()->links() }}
                    @endif
                </nav>
            </div>
        </div>
    </div>
@endsection
