@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Blog</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.candidate-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Basic Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Profile</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-experience-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-experience" type="button" role="tab"
                                aria-controls="pills-experience" aria-selected="false">Experience & Education</button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        @include('frontend.candidate-dashboard.profile.sections.basic-section')

                        @include('frontend.candidate-dashboard.profile.sections.profile-section')

                        @include('frontend.candidate-dashboard.profile.sections.experience-section')

                        <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
                            <div class="row">
                                {{-- <form action="{{ route('company.profile.account-info') }}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Username *</label>
                                                <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                    type="text" name="name" value="{{ auth()->user()->name }}">
                                                <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Email Address *</label>
                                                <input
                                                    class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                                    type="text" name="email" value="{{ auth()->user()->email }}">
                                                <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-shadow">Save</button>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                                <hr>
                                <form action="{{ route('company.profile.password-update') }}" method="post">
                                    @csrf
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Password *</label>
                                                <input
                                                    class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                                    name="password" type="password" value="">
                                                <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="font-sm color-text-mutted mb-10">Confirm Password *</label>
                                                <input
                                                    class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}"
                                                    name="password_confirmation" type="password" value="">
                                                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-default btn-shadow">Save</button>
                                            </div>
                                        </div>

                                    </div>
                                </form> --}}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal -->
    <div class="modal fade" id="experienceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" id = "ExperienceForm">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Company *</label>
                                    <input type="text" class="form-control" required name="company" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Department  *</label>
                                    <input type="text" class="form-control" required name="department" id="">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Designation *</label>
                                    <input type="text" class="form-control" required name="designation" id="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Start Date *</label>
                                    <input type="text" required class="form-control datepicker" name="start" id="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">End Date *</label>
                                    <input type="text" required class="form-control datepicker" name="end" id="">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" name="currently_working"
                                        id="currently-working">
                                    <label class="form-check-label" for="currently-working">I am Currently Working</label>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Responsibilities</label>
                                    <textarea maxlength="500" name="responsibilities" class="" id=""></textarea>
                                </div>
                            </div>


                        </div>
                        <div class="text-right">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add
                        Experience</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#ExperienceForm').on('submit', function(event) {
                event.preventDefault();
                const formData = $(this).serialize();
                console.log(formData);
                $.ajax({
                    method: 'POST',
                    url: "{{ route('candidate.experience.store') }}",
                    data: formData,
                    success: function(response) {

                    },
                    error: function(xhr,status,error){

                    }
                });
            });
        });
    </script>
@endpush
