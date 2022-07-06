<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemSettings extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'address',
        'file_path'
    ];
}
