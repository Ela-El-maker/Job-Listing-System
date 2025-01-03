<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PlanCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    // public function authorize(): bool
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'label' => ['required','max:100'],
            'price' => ['required','min:0','integer'],
            'job_limit' => ['required','integer'],
            'featured_job_limit' => ['required','integer'],
            'highlight_job_limit' => ['required','integer'],
            'profile_verified' => ['required','boolean'],
            'recommended' => ['required','boolean'],
            'frontend_show' => ['required','boolean'],
            'show_at_home' => ['required','boolean'],
        ];
    }
}
