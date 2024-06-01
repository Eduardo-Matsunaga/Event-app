<?php

namespace App\Http\Controllers;


use App\Models\Event;

class LikeSystemController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke($id)
    {
        $event = Event::findOrFail($id);
        $like = $event->likes()->where('user_id', auth()->id())->first();
        if ($like) {
            $like->delete();
            return response()->json(['liked' => false], 200);
        } else {
            $event->likes()->create([
                'user_id' => auth()->id()
            ]);
            return response()->json(['liked' => true], 201);
        }
    }
}
