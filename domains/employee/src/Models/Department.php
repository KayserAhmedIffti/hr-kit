<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    protected $fillable = [
        'department_name',
        'department_bn',
        'status'


    ];

    protected $appends = ['status_text'];

    public function getStatusTextAttribute() {
        return $this->attributes['status'] == 1 ? 'Active' : 'Inactive';
    }

    
}