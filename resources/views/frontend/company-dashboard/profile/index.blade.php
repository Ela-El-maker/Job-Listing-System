@extends('frontend.layouts.master')
@section('contents')
    <section class="section-box mt-75">
        <div class="breacrumb-cover">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <h2 class="mb-20">Company Profile</h2>
                        <ul class="breadcrumbs">
                            <li><a class="home-icon" href="index.html">Home</a></li>
                            <li>Company Profile</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-box mt-120">
        <div class="container">
            <div class="row">
                @include('frontend.company-dashboard.sidebar')

                <div class="col-lg-9 col-md-8 col-sm-12 col-12 mb-50">

                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                                aria-selected="true">Company Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                                aria-selected="false">Founding Info</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill"
                                data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Account Setting</button>
                        </li>
                    </ul>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <form action="{{ route('company.profile.company-info') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <x-image-preview :height="200" :width="200" :source="$companyInfo?->logo" />
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Logo *</label>
                                            <input class="form-control {{ $errors->has('logo') ? 'is-invalid' : '' }}"
                                                name="logo" type="file" value="">
                                            <x-input-error :messages="$errors->get('logo')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <x-image-preview :height="200" :width="500" :source="$companyInfo?->banner" />
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Banner *</label>
                                            <input class="form-control {{ $errors->has('banner') ? 'is-invalid' : '' }}"
                                                name="banner" type="file" value="">
                                            <x-input-error :messages="$errors->get('banner')" class="mt-2" />

                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Name *</label>
                                            <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                                name="name" type="text" value="{{ $companyInfo?->name }}">
                                            <x-input-error :messages="$errors->get('name')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Bio *</label>
                                            <textarea class="{{ $errors->has('bio') ? 'is-invalid' : '' }}" name="bio" type="text" id="">{{ $companyInfo?->bio }}</textarea>
                                            <x-input-error :messages="$errors->get('bio')" class="mt-2" />


                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Company Vision *</label>
                                            <textarea class="{{ $errors->has('vision') ? 'is-invalid' : '' }}" name="vision" type="text" id="">{{ $companyInfo?->vision }}</textarea>
                                            <x-input-error :messages="$errors->get('vision')" class="mt-2" />

                                        </div>
                                    </div>


                                </div>
                                <div class="box-button mt-15">
                                    <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <form action="{{ route('company.profile.founding-info') }}" method="post">
                                @csrf
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Industry Type *</label>
                                            <select name="industry_type"
                                                class="form-control form-icons select-active {{ $errors->has('industry_type') ? 'is-invalid' : '' }} "
                                                value="{{ $companyInfo?->industry_type }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($industryTypes as $industryType)
                                                    <option @selected($industryType->id === $companyInfo?->industry_type_id) value="{{ $industryType->id }}">
                                                        {{ $industryType->name }}</option>
                                                @endforeach

                                            </select>
                                            <x-input-error :messages="$errors->get('industry_type')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Organization Type *</label>
                                            <select name="organization_type"
                                                class="form-control form-icons select-active {{ $errors->has('organization_type') ? 'is-invalid' : '' }} "
                                                value="{{ $companyInfo?->organization_type }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($organizationTypes as $organizationType)
                                                    <option @selected($organizationType->id === $companyInfo?->organization_type_id)
                                                        value="{{ $organizationType->id }}">{{ $organizationType->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('organization_type')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Team Size *</label>
                                            <select name="team_size"
                                                class="form-control form-icons select-active {{ $errors->has('team_size') ? 'is-invalid' : '' }}"
                                                value="{{ $companyInfo?->team_size }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($teamSizes as $teamSize)
                                                    <option @selected($teamSize->id === $companyInfo?->team_size_id) value="{{ $teamSize->id }}">
                                                        {{ $teamSize->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('team_size')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Establishment Date </label>
                                            <input type="text" name="establishment_date"
                                                value="{{ $companyInfo?->establishment_date }}"
                                                class="form-control datepicker {{ $errors->has('establishment_date') ? 'is-invalid' : '' }}
                        ">
                                            <x-input-error :messages="$errors->get('establishment_date')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Website </label>
                                            <input type="text" name="website" value="{{ $companyInfo?->website }}"
                                                class="form-control {{ $errors->has('website') ? 'is-invalid' : '' }}
            ">
                                            <x-input-error :messages="$errors->get('website')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Email Address *</label>
                                            <input type="email" name="email" value="{{ $companyInfo?->email }}"
                                                class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Contact Number *</label>
                                            <input type="text" name="phone" value="{{ $companyInfo?->phone }}"
                                                class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">Country *</label>
                                            <select name="country"
                                                class="form-control form-icons country select-active {{ $errors->has('country') ? 'is-invalid' : '' }}"
                                                value="{{ $companyInfo?->country }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($countries as $country)
                                                    <option @selected($country->id === $companyInfo?->country) value="{{ $country->id }}">
                                                        {{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('country')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">State</label>
                                            <select name="state"
                                                class="form-control form-icons state select-active {{ $errors->has('state') ? 'is-invalid' : '' }}"
                                                value="{{ $companyInfo?->state }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($states as $state)
                                                    <option @selected($state->id === $companyInfo?->state) value="{{ $state->id }}">
                                                        {{ $state->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group select-style">
                                            <label class="font-sm color-text-mutted mb-10">City</label>
                                            <select name="city"
                                                class="form-control form-icons city select-active {{ $errors->has('city') ? 'is-invalid' : '' }}"
                                                value="{{ $companyInfo?->city }}" id="">
                                                <option value="">Select</option>
                                                @foreach ($cities as $city)
                                                    <option @selected($city->id === $companyInfo?->city) value="{{ $city->id }}">
                                                        {{ $city->name }}</option>
                                                @endforeach
                                            </select>
                                            <x-input-error :messages="$errors->get('city')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Address</label>
                                            <input type="text" name="address" value="{{ $companyInfo?->address }}"
                                                class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}">
                                            <x-input-error :messages="$errors->get('address')" class="mt-2" />

                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-sm color-text-mutted mb-10">Map Link</label>
                                            <input type="text" value="{{ $companyInfo?->map_link }}" name="map_link"
                                                class="form-control ">

                                        </div>
                                    </div>


                                </div>
                                <div class="box-button mt-15">
                                    <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">
                            <div class="row">
                                <form action="{{ route('company.profile.account-info') }}" method="post">
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
                                </form>

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
            $('.country').on('change', function() {
                let country_id = $(this).val();
                // remove all previous cities
                $('.city').html("")
                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-states', ':id') }}'.replace(":id", country_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value = "${value.id}">${value.name}</option>`
                        });
                        $('.state').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });

            // get cities
            $('.state').on('change', function() {
                let state_id = $(this).val();


                $.ajax({
                    method: 'GET',
                    url: '{{ route('get-cities', ':id') }}'.replace(":id", state_id),
                    data: {},
                    success: function(response) {
                        let html = '';
                        $.each(response, function(index, value) {
                            html +=
                                `<option value = "${value.id}">${value.name}</option>`
                        });
                        $('.city').html(html);
                    },
                    error: function(xhr, status, error) {

                    }
                })
            });
        })
    </script>
@endpush
