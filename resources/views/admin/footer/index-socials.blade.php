@extends('admin.layouts.master')
@section('contents')
<section class="section">
    <div class="section-header">
        <h1>Social Icons</h1>
    </div>

    <div class="section-body"></div>
</section>

<div class="col-12">
    <div class="card">
        <div class="card-header">
            <h4>All Social Icons</h4>
            <div class="card-header-form">
                <form action="{{ route('admin.social-icon.index') }}" method="GET">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search"
                            value="{{ request('search') }}">
                        <div class="input-group-btn">
                            <button type="submit" style="height: 42px" class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <a href="{{ route('admin.social-icon.create') }}" class="btn btn-primary">
                <i class="fas fa-plus-circle"></i> Create New
            </a>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Icon</th>
                            <th>URL</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($socialIcons as $index => $icon)
                            <tr>
                                <td>{{ $socialIcons->firstItem() + $index }}</td>
                                <td><i style="font-size: 30px;" class="{{ $icon->icon }}"></i></td>
                                <td><a href="{{ $icon->url }}" target="_blank">{{ $icon->url }}</a></td>
                                 <td>
                                        <a href="{{ route('admin.social-icon.edit', $icon->id) }}"
                                            class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.social-icon.destroy', $icon->id) }}"
                                            class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No Results Found!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer text-right">
            <nav class="d-inline-block">
                @if ($socialIcons->hasPages())
                    {{ $socialIcons->withQueryString()->links() }}
                @endif
            </nav>
        </div>
    </div>
</div>
@endsection
