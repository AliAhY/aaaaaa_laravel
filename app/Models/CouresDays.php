<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CouresDays extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'date_of_day',
        'number_of_hours',
        'cousre_id'
    ];

    public function course()  
    {  
        return $this->belongsTo(Courses::class);  
    }  

    public function courseMembers()  
    {  
        return $this->hasMany(CourseMembers::class);  
    } 
}
