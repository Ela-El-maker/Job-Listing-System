<div class="tab-pane fade show active" id="home4" role="tabpanel" aria-labelledby="home-tab4">
    <div class="card">
        <form action="{{ route('admin.general-settings.update') }}" method="post">
            @csrf
            <div class="row">

                <div class="col-md-12">
                    <div class="form-group">
                        <label for="">Site Name</label>
                        <input type="text" name="site_name"
                            class="form-control  {{ $errors->has('site_name') ? 'is-invalid' : '' }}" value="{{ config('settings.site_name') }}" >
                        <x-input-error :messages="$errors->get('site_name')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Email</label>
                        <input type="text" name="site_email"
                            class="form-control  {{ $errors->has('site_email') ? 'is-invalid' : '' }}" value="{{ config('settings.site_email') }}" >
                        <x-input-error :messages="$errors->get('site_email')" class="mt-2" />
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Phone</label>
                        <input type="text" name="site_phone"
                            class="form-control  {{ $errors->has('site_phone') ? 'is-invalid' : '' }}" value="{{ config('settings.site_phone') }}" >
                        <x-input-error :messages="$errors->get('site_phone')" class="mt-2" />
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Site Default Currency</label>
                        <select name="site_default_currency"
                            class="form-control select2 {{ $errors->has('site_default_currency') ? 'is-invalid' : '' }}"
                            id="">
                            <option value="">Select</option>
                            @foreach (config('currencies.currency_list') as $key => $currency)
                            <option @selected($currency === config('settings.site_default_currency')) value="{{ $currency }}">{{ $currency }}</option>

                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('site_default_currency')" class="mt-2" />
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Currency Icon</label>
                        <input type="text" name="site_currency_icon"
                            class="form-control  {{ $errors->has('site_currency_icon') ? 'is-invalid' : '' }}" value="{{ config('settings.site_currency_icon') }}" >
                        <x-input-error :messages="$errors->get('site_currency_icon')" class="mt-2" />
                    </div>
                </div>


            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary"> Update</button>
            </div>
        </form>

    </div>
</div>
