<?php

namespace App\Models;

use App\Enum\HoursStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Carbon\Carbon;

class Employee extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'hour_rate',
        'is_hidden'
    ];

    public function hours()
    {
        return $this->hasMany(Hour::class);
    }

    public function hasHoursToday(): bool
    {
        return $this->hours()->where('work_date', Carbon::today()->toDateString())->exists();
    }

    public function hasDraftHoursToday(): bool
    {
        return $this->hours()
            ->where('work_date', Carbon::today()->toDateString())
            ->where('status', '=', HoursStatus::Draft)
            ->exists();
    }

    public function firstDraftHoursToday(): ?Hour
    {
        return $this->hours()
            ->where('work_date', Carbon::today()->toDateString())
            ->where('status', '=', HoursStatus::Draft)
            ->first();
    }

    public function todayHours()
    {
        return $this->hours()->where('work_date', Carbon::today()->toDateString())->get();
    }
}
