<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikedShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        $events = $user->likedEvents()->with('country', 'tags')->paginate(12);
        return view('likedShow', compact('events'));
    }
}
