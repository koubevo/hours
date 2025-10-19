<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hour extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'employee_id',
        'work_date',
        'start_time',
        'end_time',
        'earning',
        'description',
        'status',
    ];

    protected $appends = ['formatted_work_date'];

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

    public function getFormattedWorkDateAttribute(): ?string
    {
        return $this->work_date ? Carbon::parse($this->work_date)->format('d.m.y') : null;
    }

    public function getFormattedDeletedAtAttribute(): ?string
    {
        return $this->deleted_at ? Carbon::parse($this->deleted_at)->format('d.m.y H:i') : null;
    }
}
