<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable=[
       'first_name',
       'last_name',
       'employee_id',
       'father_name',
       'mother_name',
       'dob',
       'n_id',
       'mobile',
       'religion',
       'nominee',
       'spouse',

    ];
}
