<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <form action="{{ route('company.profile.founding-info') }}" method="post">
        @csrf
        <div class="row">


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Gender *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                name="gender" type="text" value="">
                                <option value="">Select One</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Marital Status *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                                name="marital_status" type="text" value="">
                                <option value="">Select One</option>
                                <option value="single">Single</option>
                                <option value="married">Married</option>
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>


                    </div>

                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Profession *</label>

                            <select
                                class="form-control form-icons select-active {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                                name="profession" value="">
                                <option value="">Select One</option>
                                @foreach ($professions as $profession)
                                    <option @selected($profession->id === $candidate?->profession_id) value="{{ $profession->id }}">
                                        {{ $profession->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Your Availability *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                                name="profession" value="">
                                <option value="">Select One</option>
                                <option value="available">Available</option>
                                <option value="not_available">Not Available</option>
                            </select>
                            <x-input-error :messages="$errors->get('profession')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Skills You Have *</label>

                            <select
                                class="form-control form-icons select-active {{ $errors->has('skill_you_have') ? 'is-invalid' : '' }}"
                                name="skill_you_have" value="" multiple="">
                                <option value="">Select One</option>
                                <option value="">Select Two</option>
                                <option value="">Select Three</option>
                            </select>
                            <x-input-error :messages="$errors->get('skill_you_have')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Languages you know *</label>

                            <select
                                class="form-control form-icons select-active {{ $errors->has('skill_you_have') ? 'is-invalid' : '' }}"
                                name="skill_you_have" value="" multiple="">
                                <option value="">Select One</option>
                                <option value="">Select Two</option>
                                <option value="">Select Three</option>
                            </select>
                            <x-input-error :messages="$errors->get('skill_you_have')" class="mt-2" />
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Biography *</label>
                            <textarea name="" class=" {{ $errors->has('marital_status') ? 'is-invalid' : '' }}" id="editor"
                                ></textarea>

                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />

                        </div>
                    </div>



                </div>
            </div>


        </div>
        <div class="box-button mt-15">
            <button class="btn btn-apply-big font-md font-bold">Save All Changes</button>
        </div>
    </form>
</div>
