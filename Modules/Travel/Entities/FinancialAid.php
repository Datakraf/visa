<?php

namespace Modules\Travel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Travel\Entities\Travel;

class FinancialAid extends Model
{
    protected $table = 'financialaids';
    protected $guarded = [];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }
}
