<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SavedShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $user = Auth::user(); // Obtém o usuário autenticado
        $events = $user->savedEvents()->with('country', 'tags')->paginate(12);
        return view('savedShow', compact('events'));
    }
}
