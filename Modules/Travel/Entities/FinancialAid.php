<?php

namespace Modules\Travel\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Travel\Entities\Travel;
use Modules\Travel\Entities\FinancialInstrument;

class FinancialAid extends Model
{
    protected $table = 'financialaids';
    protected $guarded = [];

    public function travel()
    {
        return $this->belongsTo(Travel::class);
    }

    public function financialinstrument(){
        return $this->belongsTo(FinancialInstrument::class,'financialinstrument_id');
    }
}
