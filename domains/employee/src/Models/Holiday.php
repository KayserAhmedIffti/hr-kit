<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Holiday extends Model
{
    use HasFactory;

    protected $fillable = [
        'holiday',
        'date',
        'end_date'
    ];

    protected function getDateAttribute()
    {
        return $this->attributes['date'] ? Carbon::make($this->attributes['date'])->format('Y-m-d') : null;
    }

    protected function getEndDateAttribute()
    {
        return $this->attributes['end_date'] ? Carbon::make($this->attributes['end_date'])->format('Y-m-d') : null;
    }
}
