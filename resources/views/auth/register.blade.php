{{-- <x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
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
                            <li>Blog</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="pt-120 login-register">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 mx-auto">
                    <div class="login-register-cover">
                        <div class="text-center">
                            <h2 class="mb-5 text-brand-1">Register</h2>
                            <p class="font-sm text-muted mb-30">Do not have an account.? Create Account</p>
                        </div>
                        <form method="POST" class="login-register text-start mt-20" action="{{ route('register') }}">
                            @csrf

                            <div class="row">
                                <!-- Name -->
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-1">Full Name *</label>
                                        <input class="form-control  {{ $errors->has('name') ? 'is-invalid' : '' }}"
                                            id="input-1" type="text" required="" name="name"
                                            placeholder="FirstName LastName" value="{{ old('name') }}">
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Email Address -->
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-2">Email Address *</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="input-2" type="email" name="email" required=""
                                            placeholder="example@gmail.com" value="{{ old('email') }}">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-4">Password *</label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="input-4" type="password" required="" name="password"
                                            placeholder="************">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Confirm Password -->
                                <div class="col-xl-6">
                                    <div class="form-group">
                                        <label class="form-label" for="input-5">Confirm Password *</label>
                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="input-5" type="password" required="" name="password_confirmation"
                                            placeholder="************">
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <hr>
                                    <h6 for="" class="mb-2">Create Account For</h6>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="account_type" id="typeCandidate"
                                            value="candidate">
                                        <label class="form-check-label" for="typeCandidate">Candidate</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input " type="radio" name="account_type" id="typeCompany"
                                            value="company">
                                        <label class="form-check-label" for="typeCompany">Company</label>
                                    </div>
                                    @if ($errors->has('account_type'))
                                    <div class="invalid-feedback d-block">
                                        {{ $errors->first('account_type') }}
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-default hover-up w-100" type="submit" name="login">Submit
                                        &amp;
                                        Register</button>
                                </div>
                                <div class="text-muted text-center">Already have an account?
                                    <a href="{{ route('login') }}">Sign in</a>
                                </div>
                        </form>
                        {{-- <div class="text-center mt-20">
                            <div class="divider-text-center"><span>Or continue with</span></div>
                            <button class="btn social-login hover-up mt-20"><img
                                    src="assets/imgs/template/icons/icon-google.svg" alt="joblist"><strong>Sign up with
                                    Google</strong></button>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="mt-120"></div>
@endsection
