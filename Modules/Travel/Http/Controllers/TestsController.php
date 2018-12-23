<?php

namespace Modules\Travel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Travel\Entities\Travel;
class TestsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index()
    {
        return view('travel::test-save');
    }
    public function store(Request $request)
    {
        for ($i = 0; $i < count($request->institution); ++$i) {
            if()
            Travel::create([
                'user_id' => auth()->id(),                
            ]);
        }
    }


}
