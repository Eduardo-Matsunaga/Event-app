<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendingShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user=Auth::user();
        $events = $user->attendingEvents()->with('country','tags')->paginate(12);
        return view('attendingShow', compact('events'));
    }
}
