<?php

namespace App\Http\Controllers;
use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    public function getEvents()
    {
        $events = Event::latest()->get();

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
            return response()->json(['error' => 'Event tidak ditemukan'], 404);
        }

        return response()->json($event);
    }

    public function storeOrUpdate(Request $request)
    {
        $eventId = $request->input('event_id');
        $formMethod = $request->get('formMethod');

        try {
            if ($formMethod == "store") {
                $request->validate([
                    'name' => 'required|string',
                    'description' => 'required|string',
                    'start_date' => 'required|date',
                    'end_date' => 'required|date|after:start_date',
                    'location' => 'required|string',
                ]);

                $eventData = $request->only(['name', 'description', 'start_date', 'end_date', 'location']);

                Event::create($eventData);

                return redirect()->route('admin.eventManagement')->with('message', 'Event baru berhasil dibuat');
            } elseif ($formMethod == "update") {
                $event = Event::find($eventId);

                $request->validate([
                    'name' => 'string',
                    'description' => 'string',
                    'start_date' => 'date',
                    'end_date' => 'date|after:start_date',
                    'location' => 'string',
                ]);
                $eventData = [
                    'name' =>  $request->name,
                    'description' =>  $request->description,
                    'start_date' => $request->start_date,
                    'end_date' => $request->end_date,
                    'location' => $request->location,
                    'judul' => $request->judul,
                    'caption' => $request->caption,
                ];


                // Periksa apakah ada perubahan sebelum melakukan pembaruan
                if ($event->name != $eventData['name'] || $event->description != $eventData['description'] || 
                    $event->start_date != $eventData['start_date'] || $event->end_date != $eventData['end_date'] ||
                    $event->location != $eventData['location']) {
                    
                    $event->update($eventData);

                    return redirect()->route('admin.eventManagement')->with('message', 'Event berhasil diperbarui');
                } else {
                    // Tidak ada perubahan yang dilakukan
                    return redirect()->route('admin.eventManagement')->with('message', 'Tidak ada perubahan yang dilakukan');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('admin.eventManagement')->with('message', 'Input gagal, isi formulir dengan benar');
        }
    }

    public function delete($id)
    {
        $content = Event::find($id);

        if ($content) {
            $content->delete();
            return redirect()->route('admin.eventManagement')->with('message', 'Konten berhasil dihapus');
        }

        return redirect()->route('admin.eventManagement')->with('message', 'Konten tidak ditemukan');
    }
}
