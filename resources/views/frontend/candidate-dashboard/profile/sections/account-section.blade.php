<div class="tab-pane fade show " id="pills-account" role="tabpanel" aria-labelledby="pills-account-tab">

    <form action="{{ route('candidate.profile.account-info.update') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">


            <div class="col-md-12">
                <h4>Location</h4>
                <div class="row mt-3">

                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Country *</label>

                            <select
                                class="form-control form-icons select-active {{ hasError($errors, 'country') }} country"
                                name="country" value="">
                                <option value="">Select One</option>
                                @foreach ($countries as $country)
                                    <option @selected($country->id === $candidate?->country) value="{{ $country->id }}">
                                        {{ $country->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('country')" class="mt-2" />

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">State </label>

                            <select class="form-control form-icons select-active {{ hasError($errors, 'state') }} state"
                                name="state" value="">
                                <option value="">Select One</option>
                                @foreach ($states as $state)
                                    <option @selected($state->id === $candidate?->state) value="{{ $state->id }}">
                                        {{ $state->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('state')" class="mt-2" />

                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">City </label>

                            <select class="form-control form-icons select-active {{ hasError($errors, 'city') }} city"
                                name="city" value="">
                                <option value="">Select One</option>
                                @foreach ($cities as $city)
                                    <option @selected($city->id === $candidate?->city) value="{{ $city->id }}">
                                        {{ $city->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('city')" class="mt-2" />

                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Address</label>
                            <input class="form-control {{ hasError($errors, 'address') }}" name="address"
                                type="text" value="{{ $candidate?->address }}">
                            <x-input-error :messages="$errors->get('address')" class="mt-2" />

                        </div>

                    </div>

                </div>
            </div>


            <div class="col-md-12">
                <h4>Your Contact Information</h4>
                <div class="row mt-3">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Phone </label>
                            <input class="form-control {{ hasError($errors, 'phone') }}" name="phone" type="text"
                                value="{{ $candidate?->phone_one }}">
                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />

                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Secondary Phone </label>
                            <input class="form-control {{ hasError($errors, 'secondary_phone') }}"
                                name="secondary_phone" type="text" value="{{ $candidate?->phone_two }}">
                            <x-input-error :messages="$errors->get('secondary_phone')" class="mt-2" />

                        </div>

                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Email </label>
                            <input class="form-control {{ hasError($errors, 'email') }}" name="email" type="email"
                                value="{{ $candidate?->email }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />

                        </div>

                    </div>

                </div>
            </div>


        </div>
        <div class=" mt-15">
            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
        </div>
    </form>
    <hr class="mt-4">
    <div class="mt-4">
        <form action="{{ route('candidate.profile.account-email.update') }}" method="post">
            @csrf
            <h4>Change Account Email Address</h4>
            <br>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="font-sm color-text-mutted mb-10">Account Email</label>
                    <input class="form-control {{ hasError($errors, 'account_email') }}" name="account_email"
                        type="email" value="{{ auth()->user()->email }}">
                    <x-input-error :messages="$errors->get('account_email')" class="mt-2" />

                </div>

            </div>


            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

    <hr class="mt-4">
    <div class="mt-4">
        <form action="{{ route('candidate.profile.account-password.update') }}" method="post">
            @csrf
            <h4>Change Account Password</h4>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Password</label>
                        <input class="form-control {{ hasError($errors, 'password') }}" name="password" type="password"
                            value="">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                    </div>

                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="font-sm color-text-mutted mb-10">Confirm Password</label>
                        <input class="form-control {{ hasError($errors, 'password_confirmation') }}"
                            name="password_confirmation" type="password" value="">
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                    </div>

                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Save</button>
            </div>
        </form>
    </div>

</div>


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
