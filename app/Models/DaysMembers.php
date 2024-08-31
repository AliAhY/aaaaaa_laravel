<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DaysMembers extends Model
{
  use HasFactory;
  use SoftDeletes;

  protected $fillable = ['member_id', 'day_id', 'status', 'course_id'];  

    public function courseDay()  
    {  
        return $this->belongsTo(CouresDays::class);  
    }  

    public function member()  
    {  
        return $this->belongsTo(Members::class);  
    }  
   
}
