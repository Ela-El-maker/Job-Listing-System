@extends('admin.layouts.master')
@section('contents')
    <section class="section">
        <div class="section-header">
            <h1>Update Language Type</h1>
        </div>

        <div class="section-body">
        </div>
    </section>
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Language Types</h4>
            </div>
            <div class="card-body ">
                <form action="{{ route('admin.languages.update', $language->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control {{ hasError($errors, 'name') }}" value="{{ old('name', $language->name) }}"
                            name="name">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
