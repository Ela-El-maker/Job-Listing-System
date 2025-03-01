@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Edit Job </h1>
        </div>

        <div class="section-body">
            @foreach ($errors->all() as $error)
                <div class="text-danger">
                    {{ $error }}
                </div>
            @endforeach
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Job </h4>
                    </div>
                    <div class="card-body ">
                        <form action="{{ route('admin.jobs.update', $job?->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h4>Job Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Job Title <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control {{ hasError($errors, 'title') }}"
                                                    name="title" value="{{ old('title', $job?->title) }}">
                                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Select Company <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control {{ hasError($errors, 'company') }} select2"
                                                    name="company">
                                                    <option value="">Choose</option>
                                                    @foreach ($companies as $company)
                                                        <option @selected($company?->id === $job?->company_id) value="{{ $company?->id }}">
                                                            {{ $company?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('company')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Category <span class="text-danger">*</span></label>
                                                <select class="form-control {{ hasError($errors, 'category') }} select2"
                                                    name="category">
                                                    <option value="">Choose</option>
                                                    @foreach ($categories as $category)
                                                        <option @selected($category?->id === $job?->job_category_id) value="{{ $category?->id }}">
                                                            {{ $category?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Total Vacancies <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control {{ hasError($errors, 'vacancies') }}"
                                                    name="vacancies" value="{{ old('vacancies', $job?->vacancies) }}">
                                                <x-input-error :messages="$errors->get('vacancies')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Deadline <span class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control datepicker {{ hasError($errors, 'deadline') }}"
                                                    name="deadline" value="{{ old('deadline', $job?->deadline) }}">
                                                <x-input-error :messages="$errors->get('deadline')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Locations</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">Country </label>
                                                <select
                                                    class="form-control country {{ hasError($errors, 'country') }} select2"
                                                    name="country">
                                                    <option value="">Choose</option>
                                                    @foreach ($countries as $country)
                                                        <option @selected($country?->id === $job?->country_id) value="{{ $country?->id }}">
                                                            {{ $country?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">State </label>
                                                <select class="form-control state {{ hasError($errors, 'state') }} select2"
                                                    name="state">
                                                    <option value="">Choose</option>
                                                    @foreach ($states as $state)
                                                        <option @selected($state?->id === $job?->state_id) value="{{ $state?->id }}">
                                                            {{ $state?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('state')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="">City </label>
                                                <select class="form-control city {{ hasError($errors, 'city') }} select2"
                                                    name="city">
                                                    <option value="">Choose</option>
                                                    @foreach ($cities as $city)
                                                        <option @selected($city?->id === $job?->city_id) value="{{ $city?->id }}">
                                                            {{ $city?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('city')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Address <span class="text-danger">*</span></label>
                                                <textarea class="form-control {{ hasError($errors, 'address') }}" name="address" rows="5">{{ old('address', $job?->address) }}</textarea>
                                                <x-input-error :messages="$errors->get('address')" class="mt-2" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Salary Details</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input @checked($job?->salary_mode === 'range')
                                                            onclick="salaryModeChange('salary_range')" type="radio"
                                                            id="salary_range"
                                                            class="{{ hasError($errors, 'salary_mode') }}"
                                                            name="salary_mode" value="range"
                                                            {{ old('salary_mode') == 'salary_range' ? 'checked' : '' }}
                                                            checked>
                                                        <label for="salary_range">Salary Range</label>
                                                        <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input @checked($job?->salary_mode === 'custom')
                                                            onclick="salaryModeChange('custom_salary')" type="radio"
                                                            id="custom_salary"
                                                            class="{{ hasError($errors, 'salary_mode') }}"
                                                            name="salary_mode" value="custom"
                                                            {{ old('salary_mode') == 'custom_salary' ? 'checked' : '' }}>
                                                        <label for="custom_salary">Custom Range</label>
                                                        <x-input-error :messages="$errors->get('salary_mode')" class="mt-2" />
                                                    </div>
                                                </div>
                                            </div>

                                        </div>


                                        <div class="col-md-12 salary_range_part">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Minimum Salary (MIN) <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control {{ hasError($errors, 'min_salary') }}"
                                                            name="min_salary"
                                                            value="{{ old('min_salary', $job?->min_salary) }}">
                                                        <x-input-error :messages="$errors->get('min_salary')" class="mt-2" />
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="">Maximum Salary (MAX)<span
                                                                class="text-danger">*</span></label>
                                                        <input type="text"
                                                            class="form-control {{ hasError($errors, 'max_salary') }}"
                                                            name="max_salary"
                                                            value="{{ old('max_salary', $job?->max_salary) }}">
                                                        <x-input-error :messages="$errors->get('max_salary')" class="mt-2" />

                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="col-md-12 custom_salary_part d-none">
                                            <div class="form-group">
                                                <label for="">Custom Salary <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="custom_salary"
                                                    class="form-control {{ hasError($errors, 'custom_salary') }}"
                                                    name="custom_salary"
                                                    value="{{ old('custom_salary', $job?->custom_salary) }}">

                                                <x-input-error :messages="$errors->get('custom_salary')" class="mt-2" />
                                            </div>



                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Salary Type <span
                                                        class="text-danger">*</span></label>
                                                <select name="salary_type" id=""
                                                    class="form-control select2 {{ hasError($errors, 'salary_type') }}">
                                                    <option value="">Choose</option>
                                                    @foreach ($salaryTypes as $salaryType)
                                                        <option @selected($salaryType?->id === $job?->salary_type_id)
                                                            value="{{ $salaryType?->id }}">{{ $salaryType?->name }}
                                                        </option>
                                                    @endforeach

                                                </select>

                                                <x-input-error :messages="$errors->get('salary_type')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>



                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Attributes</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Experience <span
                                                        class="text-danger">*</span></label>
                                                <select class="form-control {{ hasError($errors, 'experience') }} select2"
                                                    name="experience">
                                                    <option value="">Choose</option>
                                                    @foreach ($experiences as $experience)
                                                        <option @selected($experience?->id === $job?->job_experience_id)
                                                            value="{{ $experience?->id }}">{{ $experience?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('experience')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Job Role <span class="text-danger">*</span></label>
                                                <select class="form-control {{ hasError($errors, 'job_role') }} select2"
                                                    name="job_role">
                                                    <option value="">Choose</option>
                                                    @foreach ($jobRoles as $jobRole)
                                                        <option @selected($jobRole?->id === $job?->job_role_id) value="{{ $jobRole?->id }}">
                                                            {{ $jobRole?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('job_role')" class="mt-2" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Education</label>
                                                <select class="form-control {{ hasError($errors, 'education') }} select2"
                                                    name="education">
                                                    <option value="">Choose</option>
                                                    @foreach ($educations as $education)
                                                        <option @selected($education?->id === $job?->education_id)
                                                            value="{{ $education?->id }}">{{ $education?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('education')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Job Type <span class="text-danger">*</span></label>
                                                <select class="form-control {{ hasError($errors, 'job_type') }} select2"
                                                    name="job_type">
                                                    <option value="">Choose</option>
                                                    @foreach ($jobTypes as $jobType)
                                                        <option @selected($jobType?->id === $job?->job_type_id) value="{{ $jobType?->id }}">
                                                            {{ $jobType?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('job_type')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Tags <span class="text-danger">*</span></label>
                                                <select multiple
                                                    class="form-control {{ hasError($errors, 'tags') }} select2"
                                                    name="tags[]">
                                                    <option value="">Choose</option>
                                                    @foreach ($tags as $tag)
                                                        <option @selected(in_array($tag->id, $job?->tags()->pluck('tag_id')->toArray())) value="{{ $tag?->id }}">
                                                            {{ $tag?->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('tags')" class="mt-2" />
                                            </div>
                                        </div>

                                        @php
                                            $benefits = $job?->benefits()->with('benefit')->get();
                                            $benefitNames = [];

                                            foreach ($benefits as $benefit) {
                                                # code...
                                                $benefitNames[] = $benefit->benefit->name;
                                            }
                                            $benefitNameString = implode(', ', $benefitNames);

                                        @endphp

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Benefits </label>
                                                <input type="text" name="benefits"
                                                    class="form-control  inputtags {{ hasError($errors, 'benefits') }}"
                                                    value="{{ old('benefits', $benefitNameString) }}">

                                                <x-input-error :messages="$errors->get('benefits')" class="mt-2" />
                                            </div>
                                        </div>

                                        @php
                                            $selectedSkills = $job?->skills()->pluck('skill_id')->toArray();
                                        @endphp

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Skills <span class="text-danger">*</span></label>
                                                <select multiple
                                                    class="form-control {{ hasError($errors, 'skills') }} select2"
                                                    name="skills[]">
                                                    <option value="">Choose</option>
                                                    @foreach ($skills as $skill)
                                                        <option @selected(in_array($skill?->id, $selectedSkills)) value="{{ $skill?->id }}">
                                                            {{ $skill?->name }}</option>
                                                    @endforeach
                                                </select>
                                                <x-input-error :messages="$errors->get('skills')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Application Options</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Recieve Applications <span
                                                        class="text-danger">*</span></label>
                                                <select
                                                    class="form-control {{ hasError($errors, 'receive_applications') }} select2"
                                                    name="receive_applications">
                                                    <option @selected($job?->apply_on == 'app') value="app">On Our Platform
                                                    </option>
                                                    <option @selected($job?->apply_on == 'email') value="email">On your Email
                                                        Address</option>
                                                    <option @selected($job?->apply_on == 'custom_url') value="custom_url">On a custom
                                                        link/URL</option>

                                                </select>
                                                <x-input-error :messages="$errors->get('receive_applications')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Promote</h4>
                                </div>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input @checked($job?->is_featured) type="checkbox" id="featured"
                                                    class="{{ hasError($errors, 'featured') }}" name="featured"
                                                    value="1">
                                                <label for="featured">Featured</label>
                                                <x-input-error :messages="$errors->get('featured')" class="mt-2" />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <input @checked($job?->is_highlighted) type="checkbox" id="highlight"
                                                    class="{{ hasError($errors, 'highlight') }}" name="highlight"
                                                    value="1">
                                                <label for="highlight">Highlight</label>
                                                <x-input-error :messages="$errors->get('highlight')" class="mt-2" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card">
                                <div class="card-header">
                                    <h4>Description</h4>
                                </div>

                                <div class="card-body">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="">Description <span
                                                        class="text-danger">*</span></label>
                                                <textarea id="editor" name="description" class="form-control">{!! $job?->description !!}</textarea>
                                                <x-input-error :messages="$errors->get('description')" class="mt-2" />
                                            </div>
                                        </div>
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
        </div>
    </section>
@endsection


@push('scripts')
    <script>
        $(".inputtags").tagsinput('items');

        function salaryModeChange(mode) {
            // alert(mode);
            if (mode == 'salary_range') {

                $('.salary_range_part').removeClass('d-none');
                $('.custom_salary_part').addClass('d-none');
            } else if (mode == 'custom_salary') {
                $('.salary_range_part').addClass('d-none');
                $('.custom_salary_part').removeClass('d-none');
            }
        }

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
    </script>
@endpush
