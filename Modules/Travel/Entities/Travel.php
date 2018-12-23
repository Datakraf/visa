<?php

namespace Modules\Travel\Entities;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Travel\Entities\Participant;
use Modules\Travel\Entities\FinancialAid;
use BrianFaust\Commentable\Traits\HasComments;
use Spatie\ModelStatus\HasStatuses;

class Travel extends Model
{
    use HasComments,HasStatuses;

    protected $table = 'travels';
    protected $guarded = [];

    public function setEventStartDateAttribute($value)
    {
        $this->attributes['event_start_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getEventStartDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
    public function setEventEndDateAttribute($value)
    {
        $this->attributes['event_end_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getEventEndDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }


    public function setTravelStartDateAttribute($value)
    {
        $this->attributes['travel_start_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getTravelStartDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }
    public function setTravelEndDateAttribute($value)
    {
        $this->attributes['travel_end_date'] = Carbon::createFromFormat(config('app.date_format'), $value)->format('Y-m-d');
    }
    public function getTravelEndDateAttribute($value)
    {
        return Carbon::createFromFormat('Y-m-d', $value)->format(config('app.date_format'));
    }

    public function participants()
    {
        return $this->hasMany(Participant::class);
    }

    public function financialAid()
    {
        return $this->hasMany(FinancialAid::class);
    }
}
