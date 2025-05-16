@extends('admin.layouts.master')
@section('contents')
    <style>
        .permission-group-header {
            cursor: pointer;
        }

        .permission-group-header:hover {
            background-color: rgba(0, 0, 0, 0.03);
        }

        .permission-item {
            transition: all 0.2s ease;
            border: 1px solid transparent;
        }

        .permission-item:hover {
            border-color: #e9ecef;
        }

        .permission-label {
            font-size: 0.9rem;
            margin-left: 5px;
        }

        .permissions-header {
            border-bottom: 1px solid #e9ecef;
            padding-bottom: 10px;
        }

        .accordion .card-header {
            padding: 0.75rem 1.25rem;
        }

        .permissions-container {
            border: 1px solid #e9ecef;
            border-radius: 0.25rem;
            padding: 1.25rem;
            background-color: #f8f9fa;
        }
    </style>

    <section class="section">
        <div class="section-header d-flex justify-content-between align-items-center">
            <h1><i class="fas fa-user-shield mr-2"></i>Edit User Role Assignment</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.role-user.index') }}">Users</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Edit User Role</li>
                </ol>
            </nav>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h4 class="card-title"><i class="fas fa-user-edit mr-2"></i>Edit User: {{ $user->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.role-user.update', $user->id) }}" method="post">
                                @csrf
                                @method('PUT')

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="name" class="form-label font-weight-bold">Name</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                                </div>
                                                <input type="text" id="name"
                                                    class="form-control {{ hasError($errors, 'name') }}"
                                                    placeholder="Enter user name" value="{{ old('name', $user->name) }}"
                                                    name="name">
                                            </div>
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="email" class="form-label font-weight-bold">Email Address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" id="email"
                                                    class="form-control {{ hasError($errors, 'email') }}"
                                                    placeholder="Enter email address"
                                                    value="{{ old('email', $user->email) }}" name="email" readonly>
                                            </div>
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="password" class="form-label font-weight-bold">New Password (Leave
                                                blank to keep current)</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" id="password"
                                                    class="form-control {{ hasError($errors, 'password') }}"
                                                    placeholder="Enter new password" name="password">

                                            </div>
                                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label for="password_confirmation" class="form-label font-weight-bold">Confirm
                                                New Password</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                                </div>
                                                <input type="password" id="password_confirmation" class="form-control"
                                                    placeholder="Confirm new password" name="password_confirmation">
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mb-4">
                                    <label for="role-name" class="form-label font-weight-bold">Select Role</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                        </div>
                                        <select id="role-name" class="form-control  {{ hasError($errors, 'role') }}"
                                            name="role">
                                            <option value="">-- Select a role --</option>
                                            @foreach ($roles as $role)
                                                <option value="{{ $role->name }}"
                                                    {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <x-input-error :messages="$errors->get('role')" class="mt-2" />
                                </div>



                                <div class="form-group mt-4 text-right">
                                    <a href="{{ route('admin.role-user.index') }}" class="btn btn-secondary mr-2">
                                        <i class="fas fa-arrow-left mr-1"></i> Back to List
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i> Update User
                                    </button>
                                </div>
                            </form>
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
            // Initialize select2
            $('.select2').select2();

            // Toggle group permissions
            $('.group-selector').on('click', function(e) {
                e.stopPropagation();
                const $permissionGroup = $(this).closest('.card').find('.permission-checkbox');
                const allChecked = $permissionGroup.length === $permissionGroup.filter(':checked').length;

                $permissionGroup.prop('checked', !allChecked);
            });

            // Select all permissions
            $('#select-all-btn').on('click', function() {
                $('.permission-checkbox').prop('checked', true);
            });

            // Deselect all permissions
            $('#deselect-all-btn').on('click', function() {
                $('.permission-checkbox').prop('checked', false);
            });

            // Highlight permission items on hover
            $('.permission-item').hover(
                function() {
                    $(this).addClass('bg-light');
                },
                function() {
                    $(this).removeClass('bg-light');
                }
            );
        });
    </script>
@endpush
