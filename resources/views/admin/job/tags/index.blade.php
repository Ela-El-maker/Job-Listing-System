@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Tags Types</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Tags Types</h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.tag.index') }}" method="GET">
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
                <a href="{{ route('admin.tag.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th> <!-- Add the correct numbering -->
                            <th>Name</th>
                            <th>Slug</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($tagTypes as $tagType)
                                <tr>
                                    <!-- Calculate the correct numbering -->
                                    <td>{{ ($tagTypes->currentPage() - 1) * $tagTypes->perPage() + $loop->iteration }}</td>
                                    <td>{{ $tagType->name }}</td>
                                    <td>{{ $tagType->slug }}</td>
                                    <td>
                                        <a href="{{ route('admin.tag.edit', $tagType->id) }}"
                                            class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.tag.destroy', $tagType->id) }}"
                                            class="btn-small btn btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>

                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center"> No Results Found! </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($tagTypes->hasPages())
                        {{ $tagTypes->withQueryString()->links() }}
                    @endif
                </nav>

            </div>
        </div>
    </div>
@endsection
