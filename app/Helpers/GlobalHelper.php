<?php

/**
 *
 * Check Input errror
 *
 */

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
    function setSidebarActive(array $routes) : ?String
    {
        foreach($routes as $route)
        {
            if(request()->routeIs($route))
            {
                return 'active';
            }
        }
        return null;
    }
}

/*** Check profile completion */

if (!function_exists('isCompanyProfileComplete')) {
    function isCompanyProfileComplete() : ?bool
    {
        $requiredFields = ['logo','banner','vision','name','industry_type_id','organization_type_id','team_size_id','establishment_date','phone','email','country','website'];
        $companyProfile = Company::where('user_id',auth()->user()->id)->first();

        foreach ($requiredFields as $field) {
            # code...
            if(empty($companyProfile->{$field}))
            {
                return false;
            }
        }
        return true;
    }
}
