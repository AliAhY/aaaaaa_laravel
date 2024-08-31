<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Members extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'full_name',
        'father_name',
        'mother_name',
        'gender',
        'dob',
        'lob',
        'marital_status',
        'family_member',
        'disability',
        'disability_type',
        'disability_company',
        'family_disability',
        'family_disability_type',
        'count_of_worker',
        'father_job',
        'mother_job',
        'military_status',
        'city',
        'address',
        'location_status',
        'phone1',
        'phone2',
        'national_id',
        'education_certificate',
        'education_field',
        'date_of_certificate',
        'graduated',
        'university_year',
        'icdl',
        'other_certificates',
        'previous_courses',
        'beneficial_undp',
        'current_volunteer',
        'organization_name',
        'previous_experiences',
        'work_now',
        'current_job',
        'favorite_job',
        'course_chosen_id',
        'fragility_father_job',
        'fragility_mother_job',
        'fragility_disability',
        'fragility_family_member',
        'fragility_family_worker',
        'fragility_military',
        'final_result',
        'description',
    ];

    public function courseMembers()  
    {  
        return $this->hasMany(CourseMembers::class);  
    }
}
