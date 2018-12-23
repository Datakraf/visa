<?php

namespace Modules\Travel\Observers;

use Modules\Travel\Entities\Travel;
use Modules\Travel\Entities\FinancialAid;
use Modules\Travel\Entities\Participant;
use Modules\Travel\Traits\Attachment;
use Illuminate\Http\Request;

class TravelsObserver
{
    // public $travel;

    // public function creating(Travel $travel)
    // {
    //     $this->saveFinancialAid();
    //     // $this->saveParticipants();
    // }

    // public function created(Travel $travel){
    //     $this->saveParticipants($travel);
    // }

    // public function saveFinancialAid()
    // {
    //     for ($i = 0; $i < count(request()->get('financial_instrument')); ++$i) {
    //         if (request()->remarks[$i] != '') {
    //             FinancialAid::create([
    //                 'application_id' => $travel->id,
    //                 'financialinstrument_id' => request()->financial_instrument[$i],
    //                 'remarks' => request()->remarks[$i]
    //             ]);
    //         }
    //     }
    // }

    // public function saveParticipants()
    // {
    //     for ($i = 0; $i < count(request()->get('matric_num')); ++$i) {

    //         if (request()->matric_num[$i] != '') {
    //             Participant::create([
    //                 'application_id' => $travel->id,
    //                 'user_id' => request()->matric_num[$i]
    //             ]);
    //         }
    //     }
    // }
}