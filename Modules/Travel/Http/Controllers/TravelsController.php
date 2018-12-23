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

    public function __construct(Travel $travel, Country $country, FinancialInstrument $instrument)
    {
        $this->travel = $travel;
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
