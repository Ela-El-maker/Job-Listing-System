@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Footer Section</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Create Footer</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.footer.update', 1) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') {{-- For updating the footer --}}

                    {{-- Image Preview --}}
                    <x-image-preview :height="100" :width="300" :source="$footer?->logo" />

                    {{-- Image Upload --}}
                    <div class="form-group mb-3">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file {{ hasError($errors, 'logo') }}" name="logo">
                        <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                    </div>




                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control {{ hasError($errors, 'details') }}" name="details" rows="4">{{ old('details', $footer?->details) }}</textarea>
                        <x-input-error :messages="$errors->get('details')" class="mt-2" />
                    </div>

                    <div class="form-group">
                        <label for="">Copyright</label>
                        <input type="text" class="form-control {{ hasError($errors, 'copyright') }}"
                            value="{{ old('copyright', $footer?->copyright) }}" name="copyright">
                        <x-input-error :messages="$errors->get('copyright')" class="mt-2" />
                    </div>


                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
@endsection
