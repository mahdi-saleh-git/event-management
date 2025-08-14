<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Event::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $event = Event::create([
            ...$request->validate([
                'name' => 'required|max:225',
                'description' => 'nullable|max:1000',
                'start_at' => 'required|date|after_or_equal:today',
                'end_at' => 'required|date|after:start_at',
            ]),
            'user_id' => 1,
        ]);

        return $event;
    }

    /**
     * Display the specified resource.
     */
    public function show(Event $event)
    {
        return $event;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Event $event)
    {
        $event->update(
            $request->validate([
                'name' => 'sometimes|max:225',
                'description' => 'nullable|max:1000',
                'start_at' => 'sometimes|date',
                'end_at' => 'sometimes|date|after:start_at',
            ])
            );
        return $event;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Event $event)
    {
        $event->delete();

        // return response(status : 204);

        return response()->json([
            "message" => "Delete Success"
        ]);

    }
}
