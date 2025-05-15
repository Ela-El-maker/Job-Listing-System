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
        <h1><i class="fas fa-edit mr-2"></i>Edit Role</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.role.index') }}">Roles</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Role</li>
            </ol>
        </nav>
    </div>

    <div class="section-body">
        <div class="row">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="card-title"><i class="fas fa-pen-square mr-2"></i>Edit Role: <span class="text-primary">{{ $role->name }}</span></h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.role.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group mb-4">
                                <label for="role-name" class="form-label font-weight-bold">Role Name</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-id-badge"></i></span>
                                    </div>
                                    <input type="text" id="role-name" class="form-control {{ hasError($errors, 'name') }}"
                                        placeholder="Enter role name" value="{{ old('name', $role->name) }}" name="name">
                                </div>
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <div class="permissions-container">
                                <div class="permissions-header d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="text-primary mb-0"><i class="fas fa-lock mr-2"></i>Manage Permissions</h5>
                                    <div>
                                        <button type="button" id="select-all-btn" class="btn btn-sm btn-outline-primary mr-2">
                                            <i class="fas fa-check-square mr-1"></i> Select All
                                        </button>
                                        <button type="button" id="deselect-all-btn" class="btn btn-sm btn-outline-secondary">
                                            <i class="fas fa-square mr-1"></i> Deselect All
                                        </button>
                                    </div>
                                </div>

                                <div class="accordion" id="permissionsAccordion">
                                    @foreach ($permissions as $groupName => $groupPermissions)
                                        <div class="card mb-3 border">
                                            <div class="card-header bg-light" id="heading{{ Str::slug($groupName) }}">
                                                <div class="d-flex justify-content-between align-items-center permission-group-header"
                                                    data-toggle="collapse"
                                                    data-target="#collapse{{ Str::slug($groupName) }}"
                                                    aria-expanded="true"
                                                    aria-controls="collapse{{ Str::slug($groupName) }}">
                                                    <h6 class="mb-0 font-weight-bold text-uppercase">
                                                        <i class="fas fa-layer-group mr-2"></i>{{ $groupName }}
                                                    </h6>
                                                    <button type="button" class="btn btn-sm btn-outline-dark group-selector">
                                                        <i class="fas fa-check-circle mr-1"></i> Toggle Group
                                                    </button>
                                                </div>
                                            </div>
                                            <div id="collapse{{ Str::slug($groupName) }}" class="collapse show"
                                                aria-labelledby="heading{{ Str::slug($groupName) }}"
                                                data-parent="#permissionsAccordion">
                                                <div class="card-body pt-3 pb-1">
                                                    <div class="row permission-items">
                                                        @foreach ($groupPermissions as $permission)
                                                            <div class="col-lg-3 col-md-4 col-sm-6 mb-3">
                                                                <div class="permission-item p-2 rounded">
                                                                    <div class="custom-control custom-switch">
                                                                        <input type="checkbox"
                                                                            class="custom-control-input permission-checkbox"
                                                                            id="permission_{{ $permission->id }}"
                                                                            name="permissions[]"
                                                                            value="{{ $permission->name }}"
                                                                            {{ in_array($permission->name, $rolePermissions) ? 'checked' : '' }}>
                                                                        <label class="custom-control-label d-flex align-items-center"
                                                                            for="permission_{{ $permission->id }}">
                                                                            <span class="text-dark permission-label">{{ $permission->name }}</span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="form-group mt-4 text-right">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-secondary mr-2">
                                    <i class="fas fa-arrow-left mr-1"></i> Back to List
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update Role
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
