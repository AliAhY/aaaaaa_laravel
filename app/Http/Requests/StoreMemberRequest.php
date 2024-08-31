<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'full_name' => 'required|max:255',
            'father_name' => 'required|max:255',
            'mother_name' => 'required|max:255',
            'gender' => 'required',
            'dob' => 'required',
            'lob' => 'required|max:65535',
            'marital_status' => 'required',
            'family_member' => 'required|max:2',
            'disability' => 'required',
            'disability_type' => 'exclude_if:disability,0|required|max:65535',
            'disability_company' => 'required',
            'family_disability' => 'required',
            'family_disability_type' => 'exclude_if:family_disability,0|required|max:65535',
            'count_of_worker' => 'required|max:2',
            'father_job' => 'required',
            'mother_job' => 'required',
            'military_status' => 'required',
            'city' => 'required',
            'address' => 'required|max:65535',
            'location_status' => 'required|max:65535',
            'phone1' => 'required|digits:10|starts_with:09',
            'phone2' => 'required|digits:10|starts_with:09',
            'national_id' => 'required',
            'education_certificate' => 'required',
            'education_field' => 'exclude_if:education_certificate,تعليم أساسي|required|max:255',
            'date_of_certificate' => 'required',
            'graduated' => 'required',
            'icdl' => 'required',
            'beneficial_undp' => 'required',
            'current_volunteer' => 'required',
            'organization_name' => 'exclude_if:current_volunteer,0|required|max:255',
            'work_now' => 'required',
            'current_job' => 'exclude_if:work_now,0|required|max:255',
            'favorite_job' => 'required',
            'course_chosen_id' => 'required',
            'fragility_father_job' => 'required|digits:1',
            'fragility_mother_job' => 'required|digits:1',
            'fragility_disability' => 'required|digits:1',
            'fragility_family_member' => 'required|digits:1',
            'fragility_family_worker' => 'required|digits:1',
            'fragility_military' => 'required|digits:1',
            'description' => 'required',

        ];
    }
}
