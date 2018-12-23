<?php

namespace Modules\Travel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Travel\Entities\Travel;

class TravelAttachment extends Model
{
    protected $table = 'travelattachments';
    protected $guarded = [];

    public function travel()
    {
        return $this->belongsTo(Travel::class,'travel_id');
    }
}
