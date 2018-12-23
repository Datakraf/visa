<?php

namespace Modules\Travel\Observers;

use Modules\Travel\Entities\Travel;
use Modules\Travel\Entities\FinancialAid;
use Modules\Travel\Traits\Attachment;
use Illuminate\Http\Request;

class TravelsObserver
{
    public $travel;

    public function creating(Travel $travel)
    {
        // dd(count(request()->get('financial_instrument')));
        for ($i = 0; $i < count(request()->get('financial_instrument')); ++$i) {
            if (request()->remarks[$i] != '') {
                FinancialAid::create([
                    'application_id' => 1,
                    'financialinstrument_id' => request()->financial_instrument[$i],
                    'remarks' => request()->remarks[$i]
                ]);
            }
        }
    }
}