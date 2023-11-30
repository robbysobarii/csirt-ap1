<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

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
    public function show($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        return response()->json($event);
    }


    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'location' => 'required',
        ]);
    
        $eventId = $request->input('event_id');
        $eventData = [
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'location' => $request->location,
        ];
    
        $formMethod = $request->get('formMethod');
    
        if ($formMethod === "store") {
            // Store new event
            Event::create($eventData);
    
            return redirect()->route('admin.eventManagement')->with('success', 'New event created successfully');
        } elseif ($formMethod === "update") {
            // Update existing event
            $event = Event::find($eventId);
    
            if (!$event) {
                return redirect()->route('admin.eventManagement')->with('error', 'Event not found');
            }
    
            $event->update($eventData);
    
            return redirect()->route('admin.eventManagement')->with('success', 'Event updated successfully');
        }
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
