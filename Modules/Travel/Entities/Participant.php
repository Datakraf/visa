<?php

namespace Modules\Travel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Travel\Entities\Travel;

class Participant extends Model
{
    protected $table = 'participants';
    protected $guarded = [];

    public function travel()
    {
        return $this->belongsTo(Travel::class,'');
    }
}
