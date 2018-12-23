<?php

namespace Modules\Travel\Traits;

use Illuminate\Http\Request;
use App\User;
use Carbon\Carbon;
use DB;
use Modules\Travel\Notifications\SubmitApplication;
use Auth;

trait Submissions
{
    protected $totalDaysBeforeSubmission = 21;

    public function checkTravelType($request, $travel)
    {
        if ($request->country == 'Malaysia') {
            $travel->travel_type = 'local';
        } else {
            $travel->travel_type = 'overseas';
        }
        $travel->save();
    }

    public function checkForLateSubmission($request, $travel)
    {
        if ($this->getTotalDaysBeforeSubmission($travel) < $this->totalDaysBeforeSubmission) {
            $travel->comment([
                'title' => 'Late Submission',
                'body' => 'Hello',
            ], $this->admin());
        }
    }

    public function getTotalDaysBeforeSubmission($travel)
    {
        return Carbon::now()->diffInDays(Carbon::parse(strtotime($travel->travel_start_date)));
    }

    public function admin()
    {
        return User::find(19);
    }

    public function saveAsDraft($request, $travel)
    {
        if ($request->has('draft')) {
            $travel->setStatus('Draft', 'Successfully created');
            toast('Application created as draft', 'success', 'top');
        }
    }

    public function saveSubmit($request, $travel)
    {
        //save
        if ($request->has('save-submit')) {
            $supervisor = $this->getSupervisor($request);
            $travel->setStatus('Submitted To Supervisor', 'Submitted to Supervisor');
            $supervisor->notify(new SubmitApplication($travel, Auth::user()));
            DB::table('travel_user')->insert([
                'travel_id' => $travel->id,
                'user_id' => $supervisor->id,
            ]);
            toast('Application created and submitted to ' . $supervisor->name, 'success', 'top');
        }
    }


    public function getSupervisor($request)
    {
        return User::find($request->supervisor);
    }

    public function getApplicant($travel)
    {
        return $travel->user;
    }
}