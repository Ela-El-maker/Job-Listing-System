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



/**
 * Format Location
 */

if (!function_exists('formatLocation')) {
    function formatLocation($country = null, $state = null, $city = null, $address = null): ?String
    {
        $location = '';
        if ($address) {
            $location .= $address;
        }
        if ($city) {
            $location .= $address ?  ', ' . $city : $city;
        }
        if ($state) {
            $location .= $city ?  ', ' . $state : $state;
        }
        if ($country) {
            $location .= $state ? ', ' . $country : $country;
        }
        return $location;
    }
}
if (!function_exists('relativeTime')) {
    /**
     * Format a timestamp as a relative time string (e.g., "4 mins ago").
     *
     * @param string $timestamp The timestamp to format.
     * @return string
     */
    function relativeTime($timestamp)
    {
        $now = new DateTime();
        $then = new DateTime($timestamp);
        $diff = $now->diff($then);

        if ($diff->y > 0) {
            return $diff->y . ' year' . ($diff->y > 1 ? 's' : '') . ' ago';
        } elseif ($diff->m > 0) {
            return $diff->m . ' month' . ($diff->m > 1 ? 's' : '') . ' ago';
        } elseif ($diff->d > 0) {
            return $diff->d . ' day' . ($diff->d > 1 ? 's' : '') . ' ago';
        } elseif ($diff->h > 0) {
            return $diff->h . ' hour' . ($diff->h > 1 ? 's' : '') . ' ago';
        } elseif ($diff->i > 0) {
            return $diff->i . ' min' . ($diff->i > 1 ? 's' : '') . ' ago';
        } else {
            return 'Just now';
        }
    }
}


if (!function_exists('calculateEarnings')) {
    function calculateEarnings($amounts)
    {
        $total = 0;
        foreach ($amounts as $value) {
            // Remove anything except digits and decimal point
            $clean = preg_replace('/[^0-9.]/', '', $value);
            $total += (float)$clean;
        }
        return $total;
    }
}

if (!function_exists('canAccess')) {
    function canAccess(array $permission): bool
    {
        $permission = auth()->guard('admin')->user()->hasAnyPermission($permission);
        $superAdmin = auth()->guard('admin')->user()->hasRole('Super Admin');

        if ($permission || $superAdmin) {
            return true;
        } else {
            return false;
        }
    }
}
