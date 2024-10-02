@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Edit Price Plans</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Plan</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.plans.update', $plan->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Label</label>
                                <input type="text" class="form-control {{ hasError($errors, 'label') }}"
                                    value="{{ old('label',$plan?->label) }}" name="label">
                                <x-input-error :messages="$errors->get('label')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Price</label>
                                <input type="text" class="form-control {{ hasError($errors, 'price') }}"
                                    value="{{ old('price',$plan?->price) }}" name="price">
                                <x-input-error :messages="$errors->get('price')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Job Limit</label>
                                <input type="text" class="form-control {{ hasError($errors, 'job_limit') }}"
                                    value="{{ old('job_limit',$plan?->job_limit) }}" name="job_limit">
                                <x-input-error :messages="$errors->get('job_limit')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Featured Job Limit</label>
                                <input type="text" class="form-control {{ hasError($errors, 'featured_job_limit') }}"
                                    value="{{ old('featured_job_limit',$plan?->featured_job_limit) }}" name="featured_job_limit">
                                <x-input-error :messages="$errors->get('featured_job_limit')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Highlight Job Limit</label>
                                <input type="text" class="form-control {{ hasError($errors, 'highlight_job_limit') }}"
                                    value="{{ old('highlight_job_limit',$plan?->highlight_job_limit) }}" name="highlight_job_limit">
                                <x-input-error :messages="$errors->get('highlight_job_limit')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Recommended</label>
                                    <select name="recommended" class="form-control {{ hasError($errors, 'recommended') }}"
                                    value="{{ old('recommended') }}" id="">
                                    <option @selected($plan?->recommended === 0) value="0">No</option>
                                    <option @selected($plan?->recommended === 1) value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('recommended')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Profile Verified</label>
                                    <select name="profile_verified" class="form-control {{ hasError($errors, 'profile_verified') }}"
                                    value="{{ old('profile_verified') }}" id="">
                                    <option @selected($plan?->profile_verified === 0) value="0">No</option>
                                    <option @selected($plan?->profile_verified === 1) value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('profile_verified')" class="mt-2" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Show this Package in frontend</label>
                                    <select name="frontend_show" class="form-control {{ hasError($errors, 'frontend_show') }}"
                                    value="{{ old('frontend_show') }}" id="">
                                    <option @selected($plan?->frontend_show === 0) value="0">No</option>
                                    <option @selected($plan?->frontend_show === 1) value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('frontend_show')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Show this Package in Home</label>
                                    <select name="show_at_home" class="form-control {{ hasError($errors, 'show_at_home') }}"
                                    value="{{ old('show_at_home') }}" id="">
                                    <option @selected($plan?->show_at_home === 0)  value="0">No</option>
                                    <option @selected($plan?->show_at_home === 1)  value="1">Yes</option>
                                </select>
                                <x-input-error :messages="$errors->get('show_at_home')" class="mt-2" />
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
