<?php

namespace Modules\Travel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Travel\Entities\Travel;
use Modules\Travel\Entities\FinancialInstrument;

class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public $instrument;
    public function __construct(FinancialInstrument $instrument)
    {
        $this->instrument = $instrument;
    }
    public function index()
    {

        return view('travel::test-save', ['instruments' => $this->instrument->all()]);
    }
    public function store(Request $request)
    {
                
        for ($i = 0; $i < count($request->has('financial_instrument')); ++$i) {
            if ($request->remarks[$i] != '' ){
                Travel::create([
                    'application_id' => 1,
                    'financialinstrument_id' => $request->financial_instrument[$i],
                    'remarks' => $request->remarks[$i]
                ]);
            }

        }
        toast('success', 'success', 'top');
        return back();
    }


}
