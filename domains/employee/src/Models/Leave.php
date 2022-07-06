<?php

namespace SkylarkSoft\HoneyComb\Employee\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Leave extends Model
{
    use HasFactory;

    protected $fillable = [
           'leave_type',
           'start_date',
           'end_date'
    ];

    protected $appends = [
        'diff'
    ];

    public function getDiffAttribute() {
        if(isset($this->attributes['start_date']) && isset($this->attributes['end_date'])) {
            return Carbon::parse($this->attributes['start_date'])
            ->diffInDays($this->attributes['end_date']) + 1;
        }
        return 0;
    }
}
