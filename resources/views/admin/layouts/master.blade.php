<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>General Dashboard &mdash; Ela</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/select2/dist/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-iconpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('admin.layouts.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('contents')
            </div>

            <footer class="main-footer">
                <div class="footer-left">
                    Copyright &copy; {{ date('Y') }} <div class="bullet"></div> Design By <a
                        href="https://portfolio.felixeladi.co.ke/">Ela Kali</a>
                </div>
                <div class="footer-right">

                </div>
            </footer>
        </div>
    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/modules/select2/dist/js/select2.full.min.js') }}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>

    <!-- JS Libraies -->
    <script src="{{ asset('admin/assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('admin/assets/js/bootstrap-iconpicker.bundle.min.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('admin/assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>



    <!-- Template JS File -->
    <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
    <script src="{{ asset('admin/assets/js/custom.js') }}"></script>

    @stack('scripts')
    <script>
        // ClassicEditor
        //     .create(document.querySelector('#editor'))
        //     .catch(error => {
        //         console.error(error);
        //     });

        ClassicEditor
            .create(document.querySelector('#editor'), {

                ckfinder: {
                    uploadUrl: "{{ route('admin.upload.image', ['_token' => csrf_token()]) }}",
                    options: {},

                }
            })
            .catch(error => {
                console.error(error);
            });

        // ClassicEditor
        //     .create(document.querySelector('#editor'), {
        //         ckfinder: {
        //             uploadUrl: "{{ route('admin.upload.image') }}",
        //             options: {
        //                 resourceType: 'Images'
        //             },
        //             headers: {
        //                 'X-CSRF-TOKEN': "{{ csrf_token() }}",
        //                 'Accept': 'application/json'
        //             }
        //         },
        //         image: {
        //             toolbar: ['imageTextAlternative', '|', 'imageStyle:alignLeft', 'imageStyle:full',
        //                 'imageStyle:alignRight'
        //             ],
        //             upload: {
        //                 types: ['jpeg', 'png', 'jpg', 'gif', 'webp']
        //             }
        //         }
        //     })
        //     .then(editor => {
        //         console.log('CKEditor initialized successfully');

        //         // Handle successful image uploads
        //         editor.plugins.get('FileRepository').on('change:uploaded', (evt, data) => {
        //             if (data.status === 'uploaded') {
        //                 console.log('Image uploaded successfully:', data.url);
        //             }
        //         });

        //         // Handle upload errors
        //         editor.plugins.get('FileRepository').on('change:uploaded', (evt, data) => {
        //             if (data.status === 'error') {
        //                 console.error('Upload error:', data.error);
        //             }
        //         });
        //     })
        //     .catch(error => {
        //         console.error('Editor initialization error:', error);
        //     });



        $(".delete-item").on('click', function(e) {
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
                        let url = $(this).attr('href')
                        // console.log(url);
                        $.ajax({
                            method: 'DELETE',
                            url: url,
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
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
                        swal('Your data is safe!');
                    }
                });
        });
    </script>
</body>

</html>
