<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class Hour extends Model
{
    protected $fillable = [
        'employee_id',
        'work_date',
        'start_time',
        'end_time',
        'earning',
        'description'
    ];

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }

    public function getStartTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    public function getEndTimeAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('H:i') : null;
    }

    public function getWorkDateAttribute($value)
    {
        return $value ? Carbon::parse($value)->format('d.m.') : null;
    }
}
