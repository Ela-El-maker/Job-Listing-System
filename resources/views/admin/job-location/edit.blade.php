@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Job Locations Section</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Job Locations</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.job-location.update', $jobLocation?->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <x-image-preview :height="200" :width="400" :source="old('image', $jobLocation?->image)" name="image"
                            label="Current Image" class="" />
                        {{-- If the hero has an image, show it --}}
                        <label for="image">Image</label>
                        <input type="file" class="form-control-file {{ hasError($errors, 'image') }}" name="image">
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>


                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Country </label>
                                <select class="form-control country {{ hasError($errors, 'country') }} select2"
                                    name="country">
                                    <option value="">Choose</option>
                                    @foreach ($countries as $country)
                                        <option @selected($country?->id === $jobLocation?->country_id) value="{{ $country?->id }}">
                                            {{ $country?->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('country')" class="mt-2" />
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">State </label>
                                <select class="form-control state {{ hasError($errors, 'state') }} select2" name="state">
                                    <option value="">Choose</option>
                                    @foreach ($states as $state)
                                        <option @selected($state?->id === $jobLocation?->state_id) value="{{ $state?->id }}">
                                            {{ $state?->name }}</option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('state')" class="mt-2" />
                            </div>
                        </div>

                    </div>
                    <div class="form-group">
                        <label for="">Status </label>
                        <select class="form-control status {{ hasError($errors, 'status') }} select2" name="status">
                            <option value="">Choose</option>
                            <option @selected($jobLocation?->status == 'featured' ) value="featured">Featured</option>
                            <option @selected($jobLocation?->status == 'trending' ) value="trending">Trending</option>
                            <option @selected($jobLocation?->status == 'hot' ) value="hot">HOT</option>
                        </select>
                        <x-input-error :messages="$errors->get('status')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
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
