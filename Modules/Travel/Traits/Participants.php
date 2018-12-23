<?php

namespace Modules\Travel\Traits;

use Illuminate\Http\Request;
use Modules\Travel\Entities\Participant;

trait Participants
{
    public function saveParticipants($travel)
    {
        for ($i = 0; $i < count(request()->get('matric_num')); ++$i) {

            if (request()->matric_num[$i] != '') {
                Participant::create([
                    'travel_id' => $travel->id,
                    'user_id' => request()->matric_num[$i]
                ]);
            }
        }
    }
}