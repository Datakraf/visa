<?php

namespace Modules\Travel\Traits;

use Modules\Travel\Entities\TravelAttachment;

trait Attachments
{
    public function saveAttachments($request, $travel)
    {
        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                if (!empty($file)) {
                    $filename = time() . $file->getClientOriginalName();
                    $file->move('uploads/applicationsattachments', $filename);
                    TravelAttachment::create([
                        'travel_id' => $travel->id,
                        'path' => 'uploads/travelattachments/' . $filename
                    ]);
                }
            }
        }
    }
}