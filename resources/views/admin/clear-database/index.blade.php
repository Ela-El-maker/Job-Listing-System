@extends('admin.layouts.master')

@section('contents')
    <section class="section">
        <div class="section-header">
            <h1><i class="fas fa-database mr-2"></i>Clear Database Section</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4><i class="fas fa-server mr-2"></i>Database Management</h4>
                        </div>
                        <div class="card-body">
                            <!-- Alert Icon Warning -->
                            <div class="alert alert-danger d-flex align-items-center" role="alert">
                                <div class="mr-3">
                                    <i class="fas fa-exclamation-triangle fa-2x"></i>
                                </div>
                                <div>
                                    <h5 class="alert-heading"><i class="fas fa-skull-crossbones mr-1"></i> Critical Warning!
                                    </h5>
                                    <p class="mb-0">This action will <strong>permanently delete ALL data</strong> from the
                                        database. This operation cannot be undone and may result in <strong>complete data
                                            loss</strong>.</p>
                                </div>
                            </div>

                            <!-- Clear DB Form -->
                            <form method="POST" action="" class="mt-4 clear_db">
                                @csrf
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="confirm-clear" required>
                                        <label class="custom-control-label" for="confirm-clear"><i
                                                class="fas fa-check-circle mr-1"></i> I understand that this action will
                                            permanently delete all data.</label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-keyboard"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="confirmation-text"
                                            placeholder="Type 'DELETE' to confirm" required>
                                    </div>
                                    <small class="form-text text-muted"><i class="fas fa-info-circle mr-1"></i> Please type
                                        DELETE in capital letters to confirm.</small>
                                </div>
                                <button type="submit" class="btn btn-danger" id="clear-db-btn" disabled>
                                    <i class="fas fa-trash mr-1"></i> Clear Database
                                </button>
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
            const confirmCheckbox = $('#confirm-clear');
            const confirmationText = $('#confirmation-text');
            const clearButton = $('#clear-db-btn');

            // Enable button only when both conditions are met
            function updateButtonState() {
                if (confirmCheckbox.is(':checked') && confirmationText.val().toUpperCase() === 'DELETE') {
                    clearButton.prop('disabled', false);
                } else {
                    clearButton.prop('disabled', true);
                }
            }

            confirmCheckbox.on('change', updateButtonState);
            confirmationText.on('keyup', updateButtonState);

            // Form submission handler
            $('.clear_db').on('submit', function(e) {
                e.preventDefault();

                swal({
                        title: 'Are you sure?',
                        text: 'Once deleted, you will not be able to recover this data!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // let url = $(this).attr('href')
                            // console.log(url);
                            $.ajax({
                                method: 'POST',
                                url: "{{ route('admin.clear-database') }}",
                                data: {
                                    _token: "{{ csrf_token() }}"
                                },
                                beforeSend: function(){
                                    swal('Clearing database... Please don\'t do anything!!!',{
                                        icon: 'info',
                                        buttons:false,
                                        closeOnClickOutside: false
                                    });
                                },
                                success: function(response) {
                                    // window.location.reload();
                                     swal(response.message, {
                                        icon: 'success',
                                    });
                                    window.location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.log(xhr);
                                    swal(xhr.responseJSON.message, {
                                        icon: 'error',
                                    });
                                }
                            });

                        } else {
                            swal('Your Database data is safe!');
                        }
                    });
            });
        });
    </script>
@endpush
