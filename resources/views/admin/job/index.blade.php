@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Posts </h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Job Posts </h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.jobs.index') }}" method="GET">
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
                <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary"><i class="fas fa-plus-circle"></i>
                    Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th> <!-- Add this column for numbering -->
                            <th>Job</th>
                            <th>Category/Role</th>
                            <th>Salary</th>
                            <th>Deadline</th>
                            <th>Status</th>
                            <th>Approve</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($jobs as $job)
                                <tr>

                                    <td>{{ ($jobs->currentPage() - 1) * $jobs->perPage() + $loop->iteration }}</td>

                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img style="width: 50px;height:50px;object-fit:cover;"
                                                    src="{{ asset($job?->company?->logo) }}" alt="">
                                            </div>
                                            <div>
                                                <b>{{ $job?->title }}</b>
                                                <br>
                                                <span>{{ $job?->company?->name }} - {{ $job?->jobType?->name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <b>{{ $job?->category?->name }}</b>
                                            <br>
                                            <span>{{ $job?->jobRole?->name }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        @if ($job?->salary_mode === 'range')
                                            {{ $job?->min_salary }} - {{ $job?->max_salary }}
                                            {{ config('settings.site_default_currency') }}
                                            <br>
                                            <span>{{ $job?->salaryType?->name }}</span>
                                        @else
                                            {{ $job?->custom_salary }}
                                            <br>
                                            <span>{{ $job?->salaryType?->name }}</span>
                                        @endif
                                    </td>
                                    <td>{{ formatDate($job?->deadline) }}</td>
                                    <td>
                                        @if ($job?->status === 'pending')
                                            <span class="badge badge-warning">Pending</span>
                                        @elseif ($job?->deadline > date('Y-m-d'))
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Expired</span>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        <div class="form-group">
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" data-id="{{ $job?->id }}"
                                                    name="custom-switch-checkbox" class="custom-switch-input post_status">
                                                <span class="custom-switch-indicator"></span>
                                            </label>

                                        </div>
                                    </td> --}}
                                    {{-- <td>
                                        <div class="form-group">
                                            <label class="custom-switch mt-2">
                                                <input type="checkbox" data-id="{{ $job->id }}"
                                                    name="custom-switch-checkbox" class="custom-switch-input post_status"
                                                    {{ $job->status === 'active' ? 'checked' : '' }}>
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </td> --}}
                                    <td>
                                        <div class="form-group">
                                            <label class="custom-switch mt-2">
                                                <input @checked($job->status === 'active') type="checkbox"
                                                    data-id="{{ $job->id }}" name="custom-switch-checkbox"
                                                    class="custom-switch-input post_status">
                                                <span class="custom-switch-indicator"></span>
                                            </label>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.jobs.edit', $job?->id) }}"
                                            class="btn-small btn btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.jobs.destroy', $job?->id) }}"
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
                    @if ($jobs->hasPages())
                        {{ $jobs->withQueryString()->links() }}
                    @endif
                </nav>

            </div>
        </div>
    </div>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.post_status').on('change', function() {
                let id = $(this).data('id');
                let isChecked = $(this).is(':checked'); // Get the current state of the toggle
                let newStatus = isChecked ? 'active' : 'inactive'; // Determine the new status

                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.job-status.update', ':id') }}'.replace(":id", id),
                    data: {
                        _token: "{{ csrf_token() }}",
                        status: newStatus // Send the new status to the backend
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            window.location
                                .reload(); // Reload the page to reflect the updated status
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('An error occurred while updating the status:', error);
                        // Optionally, show a user-friendly error message (e.g., using toastr)
                        // toastr.error('An error occurred while updating the status.');
                    }
                });
            });
        });
    </script>

    {{-- <script>
        $(document).ready(function() {
            $('.post_status').on('change', function() {
                let id = $(this).data('id');

                $.ajax({
                    method: 'POST',
                    url: '{{ route('admin.job-status.update', ':id') }}'.replace(":id", id),
                    data: {
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        if (response.message == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr, status, error) {

                    }
                });
            })
        })
    </script> --}}
@endpush
