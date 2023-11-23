<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::all();

        return view('administrator.event', ['events' => $events]);
    }
    public function eventBeranda()
    {
        $events = Event::all();

        return view('user.event', ['events' => $events]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'location' => 'required',
        ]);


        Event::create([
            'name' => $request->name,
            'description' =>$request->description,
            'start_date' => $request->start_date,
            'end_date' =>  $request->end_date,
            'location' => $request->location,
        ]);

        return redirect()->route('admin.eventManagement');
    }
    public function delete($id)
    {

        $content = Event::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.eventManagement')->with('success', 'Content deleted successfully');
        }

        return redirect()->route('admin.eventManagement')->with('error', 'Content not found');
    }

}
