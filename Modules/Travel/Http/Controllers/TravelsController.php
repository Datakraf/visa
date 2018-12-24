<?php

namespace Modules\Travel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Travel\Entities\Travel;
use PragmaRX\Countries\Package\Countries as Country;
use Modules\Travel\Entities\FinancialInstrument;
use Modules\Travel\Traits\Attachments;
use Modules\Travel\Traits\Financials;
use Modules\Travel\Traits\Submissions;
use Modules\Travel\Traits\Participants;
use DB;

class TravelsController extends Controller
{
    use Attachments, Financials, Submissions, Participants;

    public $travel;
    public $instrument;
    public $country;

    public function __construct(Request $request, Travel $travel, Country $country, FinancialInstrument $instrument)
    {
        $this->travel = $travel;
        $this->data = [
            'user_id' => $request->user_id,
            'title' => $request->title,
            'venue' => $request->venue,
            'state' => $request->state,
            'country' => $request->country,
            'description' => $request->description,
            'event_start_date' => $request->event_start_date,
            'event_end_date' => $request->event_end_date,
            'travel_start_date' => $request->travel_start_date,
            'travel_end_date' => $request->travel_end_date,
            'alternate_email' => $request->alternate_email,
            'type' => $request->type,
            'event_type' => $request->event_type,
            'travel_type' => $request->travel_type
        ];
        $this->country = $country;
        $this->instrument = $instrument;
    }
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        return view('travel::index', ['travels' => $this->travel->all()]);
    }

    public function create()
    {
        return view('travel::create-update', [
            'instruments' => $this->instrument->all(),
            'countries' => $this->country->all()
        ]);
    }

    public function store(Request $request)
    {
        $travel = $this->travel->create($this->data);
        $this->checkTravelType($request, $travel);
        $this->checkForLateSubmission($request, $travel);
        $this->saveParticipants($travel);
        $this->saveFinancialAid($travel);
        $this->saveAttachments($request, $travel);
        $this->saveAsDraft($request, $travel);
        $this->saveSubmit($request, $travel);
        return back();
    }


    public function show($id)
    {
        $travel = $this->travel->find($id);
        $statuses = $travel->statuses->sortBy('created_at');
        $remarks = $travel->comments->sortByDesc('created_at');
        $financialaids = $travel->financialAids;
        $participants = $travel->participants;
        $flag_icon = Country::where('name.common', $travel->country)->pluck('flag.flag-icon');
        return view('travel::show', compact('travel', 'remarks', 'statuses', 'financialaids', 'flag_icon', 'participants'));        
    }

    public function edit()
    {
        return view('travel::edit');
    }


    public function update(Request $request)
    {
    }


    public function destroy($id)
    {
        $this->travel->find($id)->delete();
        toast('The application deleted successfully', 'success', 'top-right');
        return back();
    }

    public function loadParticipants(Request $request)
    {
        if ($request->has('q')) {
            $input = $request->q;
            $data = DB::table('users')->where('matric_num', '=', $input)->get();
            return response()->json($data);
        }
    }

    public function loadSupervisors(Request $request)
    {
        if ($request->has('q')) {
            $input = $request->q;
            $data = DB::table('users')->where('name', 'LIKE', '%' . $input . '%')->get();
            return response()->json($data);
        }
    }

    public function loadCollegeFellows(Request $request)
    {
        if ($request->has('q')) {
            $input = $request->q;
            $data = DB::table('users')->where('name', 'LIKE', '%' . $input . '%')->get();
            return response()->json($data);
        }
    }

}
