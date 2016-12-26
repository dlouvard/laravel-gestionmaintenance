<?php

namespace Dlouvard\LaravelGestionmaintenance\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{

    protected $fillable = [
        'user_id',
        'title',
        'body',
        'begin',
        'end',
        'status',
        'message'
    ];

    public function scopeIdDesc($query)
    {
        $query->orderBy('id', 'DESC');
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    /**
     * BEGIN
     */
    public function getBeginAllAttribute()
    {
        return Carbon::parse($this->begin)->setTimezone('Europe/Paris')->format('d/m/Y H:i');
    }

    public function getBeginDateAttribute()
    {
        return Carbon::parse($this->begin)->setTimezone('Europe/Paris')->format('d/m/Y');
    }

    public function getBeginHourAttribute()
    {
        return Carbon::parse($this->begin)->setTimezone('Europe/Paris')->format('H:i');
    }

    /**
     * END
     */
    public function getEndAllAttribute()
    {
        return Carbon::parse($this->end)->setTimezone('Europe/Paris')->format('d/m/Y H:i');
    }

    public function getEndDateAttribute()
    {
        return Carbon::parse($this->end)->setTimezone('Europe/Paris')->format('d/m/Y');
    }

    public function getEndHourAttribute()
    {
        return Carbon::parse($this->end)->setTimezone('Europe/Paris')->format('H:i');
    }
}