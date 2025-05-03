@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Locations Posts </h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>All Job Locations Posts </h4>
                <div class="card-header-form">
                    <form action="{{ route('admin.job-location.index') }}" method="GET">
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
                <a href="{{ route('admin.job-location.create') }}" class="btn btn-primary"><i
                        class="fas fa-plus-circle"></i>
                    Create New</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>#</th> <!-- Add this column for numbering -->
                            <th>Image</th>
                            <th>Country</th>
                            <th>State</th>
                            <th>Status</th>
                            <th style="width: 20%">Action</th>
                        </tr>
                        <tbody>
                            @forelse ($jobLocations as $location)
                                <tr>
                                    <td>
                                        {{ ($jobLocations->currentPage() - 1) * $jobLocations->perPage() + $loop->iteration }}
                                    </td>

                                    <td>
                                        <div class="d-flex">
                                            <div class="mr-2">
                                                <img style="width: 50px; height: 50px; object-fit: cover;"
                                                     src="{{ asset($location->image) }}"
                                                     alt="Image">
                                            </div>
                                        </div>
                                    </td>

                                    <td>{{ $location->country?->name ?? 'No Country' }}</td>

                                    <td>{{ $location->state?->name ?? 'No State' }}</td>

                                    <td>
                                        @php
                                            $badgeColors = [
                                                'featured' => 'primary',
                                                'trending' => 'warning',
                                                'hot' => 'danger',
                                                'active' => 'success'
                                            ];
                                        @endphp

                                        @if($location->status && isset($badgeColors[$location->status]))
                                            <span class="badge badge-{{ $badgeColors[$location->status] }}">
                                                {{ ucfirst($location->status) }}
                                            </span>
                                        @else
                                            <span class="badge badge-secondary">Unknown</span>
                                        @endif
                                    </td>


                                    <td>
                                        <a href="{{ route('admin.job-location.edit', $location->id) }}"
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="{{ route('admin.job-location.destroy', $location->id) }}"
                                           class="btn btn-sm btn-danger delete-item">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">No Results Found!</td>
                                </tr>
                            @endforelse
                        </tbody>


                    </table>
                </div>
            </div>

            <div class="card-footer text-right">
                <nav class="d-inline-block">
                    @if ($jobLocations->hasPages())
                        {{ $jobLocations->withQueryString()->links() }}
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
@endpush
