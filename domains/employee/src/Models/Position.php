<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Model
{
    use SoftDeletes, HasFactory;

    protected $table = "positions";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'name_bn',
        'status',

    ];


    // protected $appends = ['status_text'];

    // public function getStatusTextAttribute() {
    //     return $this->attributes['status'] == 1 ? 'Active' : 'Inactive';
    // }
}
