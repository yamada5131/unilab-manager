<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Inertia\Inertia;

class RoomController extends Controller
{
    public function index()
    {
        return Inertia::render('Rooms/Index', [
            //            'rooms' => Rooms::all(),
        ]);
    }

    public function show($id)
    {
        $room = Room::with('computers')->findOrFail($id);

        return Inertia::render('Rooms/Show', [
            'room' => $room,
        ]);
    }
}
