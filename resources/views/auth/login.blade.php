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
                <div class="col-lg-5 col-md-6 col-sm-12 mx-auto">
                    <div class="login-register-cover">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />
                        <div class="text-center">
                            <h2 class="mb-5 text-brand-1">Login</h2>
                            <p class="font-sm text-muted mb-30">Please Provide your Login Credentials</p>
                        </div>



                        <form class="login-register text-start mt-20" method="POST" action="{{ route('login') }}">
                            @csrf
                            <!-- Email Address -->
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <label class="form-label" for="input-3">Email Address *</label>
                                        <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}"
                                            id="input-3" type="email" name="email" required=""
                                            value="{{ old('email') }}" placeholder="ela@gmail.com">
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                                <!-- Password -->
                                <div class="col-xl-12">
                                    <div class="form-group">
                                        <div class="d-flex justify-content-between">
                                        <label class="form-label" for="input-4">Password *</label>
                                        <a href="{{ route('password.request') }}">Forgot Password ?</a>
                                        </div>

                                        <input class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}"
                                            id="input-4" type="password" required="" name="password"
                                            placeholder="************">
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />

                                    </div>
                                </div>
                                <!-- Remember Me -->
                                <div class="col-xl-12">
                                    <div class="form-check form-check-inline">
                                        <input type="checkbox" class="form-check-input " style="margin-right: 10px"
                                            name="remember">
                                        <label for="remember_me" class="form-check-label">Remember Me</label>
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <button class="btn btn-default hover-up w-100" type="submit" name="login">Login</button>
                            </div>
                            <div class="text-muted text-center">Don't have an account?
                                <a href="{{ route('register') }}">Registration</a>
                            </div>
                        </form>
                        {{-- <div class="text-center mt-20">
              <div class="divider-text-center"><span>Or continue with</span></div>
              <button class="btn social-login hover-up mt-20"><img src="{{ asset('frontend/assets/imgs/template/icons/icon-google.svg') }}"
                  alt="joblist"><strong>Sign up with Google</strong></button>
            </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="mt-120"></div>
@endsection
