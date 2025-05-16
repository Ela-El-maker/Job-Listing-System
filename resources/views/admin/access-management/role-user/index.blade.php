@extends('admin.layouts.master')
@section('contents')
    <style>
        .permission-tags {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
        }

        .badge {
            font-size: 0.8rem;
            font-weight: 500;
        }

        .permission-dropdown {
            width: 300px;
            max-height: 200px;
            overflow-y: auto;
        }

        .empty-state {
            text-align: center;
            padding: 40px 0;
        }

        .empty-state-icon {
            width: 70px;
            height: 70px;
            background-color: #f3f3f3;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
        }

        .empty-state-icon i {
            font-size: 30px;
            color: #6c757d;
        }

        .table th {
            font-weight: 600;
            color: #495057;
        }

        .table-hover tbody tr:hover {
            background-color: rgba(0, 123, 255, 0.04);
        }
    </style>
    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1><i class="fas fa-user-tag mr-2"></i>Roles Users</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Roles</li>
                </ol>
            </nav>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-list mr-2"></i>All Users Roles
                                {{-- <span class="badge badge-primary ml-2">{{ $roles->total() }}</span> --}}
                            </h4>

                            <div class="card-header">
                                <h4>All Roles and Permissions </h4>
                                <div class="card-header-form">
                                    <form action="{{ route('admin.role-user.index') }}" method="GET">
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
                                <a href="{{ route('admin.role-user.create') }}" class="btn btn-primary"><i
                                        class="fas fa-plus-circle"></i>
                                    Create New</a>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr class="bg-light">
                                            <th class="pl-4">#</th>
                                            <th>Admin Name</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th style="width: 140px" class="text-center">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($admins as $admin)
                                            <tr>
                                                <td class="pl-4">{{ $admins->firstItem() + $loop->index }}</td>

                                                <td>
                                                    <span class="font-weight-bold">{{ $admin?->name }}</span>
                                                </td>
                                                <td>
                                                    {{ $admin?->email }}
                                                </td>
                                                <td>
                                                    {{ $admin->getRoleNames()->first() }}
                                                </td>
                                                <td>
                                                    @if ($admin->getRoleNames()->first() !== 'Super Admin')
                                                        <a href="{{ route('admin.role-user.edit', $admin?->id) }}"
                                                            class="btn-small btn btn-primary">
                                                            <i class="fas fa-edit"></i>
                                                        </a>
                                                        <a href="{{ route('admin.role-user.destroy', $admin?->id) }}"
                                                            class="btn-small btn btn-danger delete-item">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-4">
                                                    <div class="empty-state">
                                                        <div class="empty-state-icon">
                                                            <i class="fas fa-search"></i>
                                                        </div>
                                                        <h2 class="mt-3">No Roles Found</h2>
                                                        <p class="lead">
                                                            We couldn't find any roles matching your search criteria.
                                                        </p>
                                                        <a href="{{ route('admin.role.index') }}"
                                                            class="btn btn-outline-primary mt-3">
                                                            <i class="fas fa-redo mr-1"></i> Clear Filters
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer bg-white">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    Showing {{ $admins->firstItem() ?? 0 }} to {{ $admins->lastItem() ?? 0 }} of
                                    {{ $admins->total() }} entries
                                </div>
                                <div>
                                    @if ($admins->hasPages())
                                        {{ $admins->withQueryString()->links() }}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();

            // Handle delete confirmation

        });
    </script>
@endpush
