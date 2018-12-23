<?php

namespace Modules\Travel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Travel\Entities\Travel;
use PragmaRX\Countries\Package\Countries as Country;
use Modules\Travel\Entities\FinancialInstrument;

class TravelsController extends Controller
{
    public $travel;
    public $instrument;
    public $country;

    public function __construct(Request $request, Travel $travel, Country $country, FinancialInstrument $instrument)
    {
        $this->travel = $travel;
        $this->middleware(function ($request, $next) {
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
            return $next($request);
        });
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

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('travel::create-update', [
            'instrument' => $this->instrument->all(),
            'countries' => $this->country->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {
        return view('travel::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('travel::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy($id)
    {
        $this->travel->find($id)->delete();
        toast('The application deleted successfully', 'success', 'top-right');
        return back();
    }
}
