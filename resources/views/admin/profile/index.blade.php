@extends('admin.layouts.master')
@section('contents')
<style>
    .profile-image-container {
        position: relative;
        width: 150px;
        height: 150px;
        margin: 0 auto 25px;
    }

    .profile-image {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        transition: all 0.3s ease;
    }

    .image-upload-label {
        position: absolute;
        bottom: 0;
        right: 0;
        background: #3498db;
        color: white;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .image-upload-label:hover {
        background: #2980b9;
        transform: scale(1.05);
    }

    .image-upload-input {
        display: none;
    }

    .profile-card {
        border-radius: 15px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .profile-card:hover {
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.12);
    }

    .profile-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        padding: 30px 20px;
        text-align: center;
        color: white;
    }

    .profile-title {
        font-weight: 600;
        margin-bottom: 5px;
    }

    .profile-subtitle {
        opacity: 0.8;
        font-size: 0.9rem;
    }

    .form-control:focus {
        border-color: #6777ef;
        box-shadow: 0 0 0 0.2rem rgba(103, 119, 239, 0.25);
    }

    .input-group-text {
        background-color: #f4f6f9;
    }

    .password-toggle {
        cursor: pointer;
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: #6777ef;
    }
</style>

<section class="section">
    <div class="section-header d-flex justify-content-between align-items-center">
        <h1><i class="fas fa-user-shield mr-2"></i>Admin Profile</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Update Profile</li>
            </ol>
        </nav>
    </div>

    <div class="section-body">
        <div class="row">
            <!-- Profile Picture Card -->
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="card profile-card">
                    <div class="profile-header">
                        <h5 class="profile-title">Profile Picture</h5>
                        <p class="profile-subtitle">Update your profile image</p>
                    </div>
                    <div class="card-body text-center py-4">
                        <div class="profile-image-container">
                            <img id="profile-preview" src="{{asset(auth()->guard('admin')?->user()?->image) }}"
                                 class="profile-image" alt="Profile Image">
                            <label for="profile_image" class="image-upload-label">
                                <i class="fas fa-camera"></i>
                            </label>
                        </div>
                        <h5 class="mt-3 mb-1">{{ auth()->guard('admin')->user()->name ?? 'Admin User' }}</h5>
                        <p class="text-muted">{{ auth()->guard('admin')->user()->email ?? 'admin@example.com' }}</p>
                        <p class="small text-muted mb-0">Click on the camera icon to update your profile picture</p>
                    </div>
                </div>
            </div>

            <!-- Profile Details Card -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-white">
                        <h4 class="card-title"><i class="fas fa-user-edit mr-2"></i>Edit Profile Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.profile.update') }}" method="post" enctype="multipart/form-data">
                            @csrf


                            <input type="file" id="profile_image" name="image" class="image-upload-input" accept="image/*">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="name" class="form-label font-weight-bold">Full Name</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                                            </div>
                                            <input type="text" id="name"
                                                class="form-control {{ hasError($errors, 'name') }}"
                                                placeholder="Enter your full name"
                                                value="{{ old('name', auth()->guard('admin')->user()->name ?? '') }}"
                                                name="name">
                                        </div>
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="email" class="form-label font-weight-bold">Email Address</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                            </div>
                                            <input type="email" id="email"
                                                class="form-control {{ hasError($errors, 'email') }}"
                                                placeholder="Enter email address"
                                                value="{{ old('email', auth()->guard('admin')->user()->email ?? '') }}"
                                                name="email">
                                        </div>
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4 text-right">
                                <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back()">
                                    <i class="fas fa-times mr-1"></i> Cancel
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i> Update Profile
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Password Change Card -->
<div class="col-md-8 offset-md-4">
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h4 class="card-title"><i class="fas fa-key mr-2"></i>Change Password</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.profile.password') }}" method="post">
                @csrf


                <div class="form-group mb-4">
                    <label for="current_password" class="form-label font-weight-bold">Current Password</label>
                    <div class="input-group" style="position: relative;">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                        </div>
                        <input type="password" id="current_password"
                            class="form-control {{ hasError($errors, 'current_password') }}"
                            placeholder="Enter current password"
                            name="current_password" required>
                        <span class="password-toggle" onclick="togglePassword('current_password')">
                            <i class="fas fa-eye"></i>
                        </span>
                    </div>
                    <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="password" class="form-label font-weight-bold">New Password</label>
                            <div class="input-group" style="position: relative;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" id="password"
                                    class="form-control {{ hasError($errors, 'password') }}"
                                    placeholder="Enter new password (min 8 characters)"
                                    name="password" required minlength="8">
                                <span class="password-toggle" onclick="togglePassword('password')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group mb-4">
                            <label for="password_confirmation" class="form-label font-weight-bold">
                                Confirm New Password
                            </label>
                            <div class="input-group" style="position: relative;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-key"></i></span>
                                </div>
                                <input type="password" id="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    name="password_confirmation" required>
                                <span class="password-toggle" onclick="togglePassword('password_confirmation')">
                                    <i class="fas fa-eye"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group mt-4 text-right">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-key mr-1"></i> Change Password
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
        // Preview profile image before upload
        $('#profile_image').change(function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profile-preview').attr('src', e.target.result);
                }
                reader.readAsDataURL(file);
            }
        });
    });

    function togglePassword(fieldId) {
        const field = document.getElementById(fieldId);
        const icon = field.nextElementSibling.querySelector('i');

        if (field.type === 'password') {
            field.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            field.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endpush
