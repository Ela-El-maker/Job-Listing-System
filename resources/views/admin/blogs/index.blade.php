@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Blog Posts </h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Blog Posts </h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.blogs.index') }}" method="GET">
                        <div class="input-group">
                            <input type="text" name="search" class="form-control" placeholder="Search"
                                value="{{ request('search') }}">
                            <div class="input-group-btn">
                                <button type="submit" style="height: 42px" class="btn btn-primary"><i
                                        class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Featured</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($blogs as $blog)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    {{-- Title --}}
                                    <td>{{ $blog?->title }}</td>

                                    {{-- Description (limited to 80 chars) --}}
                                    <td>{{ Str::limit(strip_tags($blog?->description), 80, '...') }}</td>

                                    {{-- Image Preview --}}
                                    <td>
                                        @if ($blog?->image)
                                            <img src="{{ asset($blog->image) }}" alt="Blog Image" width="60"
                                                height="50" style="object-fit: cover; border-radius: 5px;" />
                                        @else
                                            <span style="font-size: 12px; color: #999;">No Image</span>
                                        @endif
                                    </td>

                                    {{-- Status Badge --}}
                                    <td>
                                        @if ($blog?->status == 1)
                                            <span
                                                style="background-color: #d4edda; color: #155724; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                                Active
                                            </span>
                                        @else
                                            <span
                                                style="background-color: #f8d7da; color: #721c24; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Featured Badge --}}
                                    <td>
                                        @if ($blog?->featured == 1)
                                            <span
                                                style="background-color: #cce5ff; color: #004085; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                                Yes
                                            </span>
                                        @else
                                            <span
                                                style="background-color: #e2e3e5; color: #383d41; padding: 2px 8px; border-radius: 12px; font-size: 12px;">
                                                No
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Action Buttons --}}
                                    <td>
                                        <a href="{{ route('admin.blogs.edit', $blog?->id) }}"
                                            class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.blogs.destroy', $blog?->id) }}"
                                            class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No Results Found!</td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($blogs->hasPages())
                        {{ $blogs->withQueryString()->links() }}
                    @endif
                </nav>

            </div>
        </div>
    </div>
@endsection
