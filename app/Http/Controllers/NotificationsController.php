<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Notification;
use Auth;
use Illuminate\Support\Facades\URL;
use Modules\Travel\Entities\Travel;

class NotificationsController extends Controller
{
    public function __construct(Travel $travel)
    {
        $this->travel = $travel;
    }
    
    public function index()
    {
        $results = Notification::where('receiver_id', '=', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('backend.notifications.index', compact('results'));
    }

    public function markAsRead($id, $travel_id)
    {
        Auth::user()->notifications->find($id)->markAsRead();
        
        if (isset($travel_id)) {
            $app = $this->travel->find($application_id);
            // $app->setStatus('Read', 'Read by '.Auth::user()->profile->title.' '.Auth::user()->name);
            $signedUrl = URL::signedRoute('applications.show', ['id'=> $travel_id]);
            return redirect($signedUrl);
        }
    }
}
