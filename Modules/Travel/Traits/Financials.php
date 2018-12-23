<?php

namespace Modules\Travel\Traits;

use Modules\Travel\Entities\Financial;
use Illuminate\Http\Request;
use Modules\Travel\Entities\FinancialAid;

trait Financials
{
    public function saveFinancialAid($travel)
    {
        for ($i = 0; $i < count(request()->get('financial_instrument')); ++$i) {
            if (request()->remarks[$i] != '') {
                FinancialAid::create([
                    'travel_id' => $travel->id,
                    'financialinstrument_id' => request()->financial_instrument[$i],
                    'remarks' => request()->remarks[$i]
                ]);
            }
        }
    }
}