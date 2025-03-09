<?php

/**
 *
 * Check Input errror
 *
 */

use App\Models\Candidate;
use App\Models\Company;
use Illuminate\Support\Facades\Auth;

if (!function_exists('hasError')) {
    function hasError($errors, string $name): ?String
    {
        return $errors->has($name) ? 'is-invalid' : '';
    }
}


/*** Set sidebar active */

if (!function_exists('setSidebarActive')) {
    function setSidebarActive(array $routes): ?String
    {
        foreach ($routes as $route) {
            if (request()->routeIs($route)) {
                return 'active';
            }
        }
        return null;
    }
}

/*** Check company profile completion */

if (!function_exists('isCompanyProfileComplete')) {
    function isCompanyProfileComplete(): ?bool
    {
        $requiredFields = [
            'logo',
            'banner',
            'vision',
            'name',
            'industry_type_id',
            'organization_type_id',
            'team_size_id',
            'establishment_date',
            'phone',
            'email',
            'country',
            'website'
        ];
        $companyProfile = Company::where('user_id', auth()->user()->id)->first();

        foreach ($requiredFields as $field) {
            # code...
            if (empty($companyProfile->{$field})) {
                return false;
            }
        }
        return true;
    }
}



/*** Check candidate profile completion */

if (!function_exists('isCandidateProfileComplete')) {
    function isCandidateProfileComplete(): ?bool
    {
        $requiredFields = [
            'experience_id',
            'profession_id',
            'title',
            'image',
            'cv',
            'full_name',
            'birth_date',
            'gender',
            'status',
            'marital_status',
            'bio',
            'country',
            'state',
            'city',
            'address',
            'phone_one',
            'phone_two',
            'email',
        ];
        $candidateProfile = Candidate::where('user_id', auth()->user()->id)->first();

        foreach ($requiredFields as $field) {
            # code...
            if (empty($candidateProfile->{$field})) {
                return false;
            }
        }
        return true;
    }
}


/*** Format date */

if (!function_exists('formatDate')) {
    function formatDate(?string $date): ?String
    {
        if ($date) {
            return date('d M Y', strtotime($date));
        }
        return null;
    }
}


//
/**
 * Store plan info in session
 */

if (!function_exists('storePlanInformation')) {
    function storePlanInformation()
    {
        session()->forget('user_plan');
        session([
            'user_plan' => isset(auth()->user()->company?->userPlan) ? auth()->user()->company?->userPlan : []
        ]);
    }
}
