<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
    <form action="{{ route('candidate.profile.profile-info.update') }}" method="post">
        @csrf
        <div class="row">


            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Gender *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('gender') ? 'is-invalid' : '' }}"
                                name="gender" type="text" value="{{ $candidate?->gender }}">
                                <option value="">Select One</option>
                                <option @selected($candidate?->gender === 'male') value="male">Male</option>
                                <option @selected($candidate?->gender === 'female') value="female">Female</option>
                            </select>
                            <x-input-error :messages="$errors->get('gender')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Marital Status *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('marital_status') ? 'is-invalid' : '' }}"
                                name="marital_status" type="text" value="{{ $candidate?->marital_status }}">
                                <option value="">Select One</option>
                                <option @selected($candidate?->marital_status === 'single') value="single">Single</option>
                                <option @selected($candidate?->marital_status === 'married') value="married">Married</option>
                            </select>
                            <x-input-error :messages="$errors->get('marital_status')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Profession *</label>
                            <select
                                class="form-control form-icons select-active {{ $errors->has('profession') ? 'is-invalid' : '' }}"
                                name="profession" value="{{ $candidate?->profession_id }}">
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
                                class="form-control form-icons select-active {{ $errors->has('availability') ? 'is-invalid' : '' }}"
                                name="availability" value="{{ $candidate?->status }}">
                                <option value="">Select One</option>
                                <option @selected($candidate?->status === 'available') value="available">Available</option>
                                <option @selected($candidate?->status === 'not_available') value="not_available">Not Available</option>
                            </select>
                            <x-input-error :messages="$errors->get('availability')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Skills You Have *</label>

                            <select
                                class="form-control form-icons select-active {{ $errors->has('skill_you_have') ? 'is-invalid' : '' }}"
                                name="skill_you_have[]" value="" multiple="">
                                <option value="">Select One</option>
                                @foreach ($skills as $skill)
                                    @php
                                        $candidateSkills = $candidate?->skills->pluck('skill_id')->toArray() ?? [];
                                    @endphp

                                    <option @selected(in_array($skill->id, $candidateSkills)) value="{{ $skill->id }}">
                                        {{ $skill->name }}</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('skill_you_have')" class="mt-2" />
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group select-style">
                            <label class="font-sm color-text-mutted mb-10">Languages you know *</label>

                            <select
                                class="form-control form-icons select-active {{ $errors->has('language_you_know') ? 'is-invalid' : '' }}"
                                name="language_you_know[]" value="" multiple="">
                                <option value="">Select One</option>

                                @foreach ($languages as $language)

                                    @php

                                        $candidateLanguages = $candidate?->languages->pluck('language_id')->toArray() ?? [];

                                    @endphp

                                    <option @selected(in_array($language->id, $candidateLanguages)) value="{{ $language->id }}">
                                        {{ $language->name }}</option>

                                @endforeach

                            </select>
                            <x-input-error :messages="$errors->get('language_you_know')" class="mt-2" />
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group">
                            <label class="font-sm color-text-mutted mb-10">Biography *</label>
                            <textarea name="biography" class=" {{ $errors->has('biography') ? 'is-invalid' : '' }}" id="editor">
                                {!! $candidate?->bio !!}
                            </textarea>
                            <x-input-error :messages="$errors->get('biography')" class="mt-2" />
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
