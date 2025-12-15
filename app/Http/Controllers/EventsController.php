<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Client;
use App\Models\Package;
use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-operations']);
    }

    public function index()
    {
        $events = Event::with(['client', 'package'])->orderBy('actual_date', 'desc')->paginate(20);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $packages = Package::where('is_active', true)->orderBy('name')->get();
        return view('events.create', compact('clients', 'packages'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id'   => 'required|exists:clients,client_id',
            'package_id'  => 'required|exists:packages,package_id',
            'event_type'  => 'required|string|max:50',
            'actual_date' => 'nullable|date',
            'location'    => 'nullable|string|max:255',
            'status'      => 'nullable|string|max:50',
            'notes'       => 'nullable|string',
        ]);

        Event::create($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil dibuat.');
    }

    public function edit(Event $event)
    {
        $clients = Client::orderBy('name')->get();
        $packages = Package::where('is_active', true)->orderBy('name')->get();
        return view('events.edit', compact('event', 'clients', 'packages'));
    }

    public function update(Request $request, Event $event)
    {
        $data = $request->validate([
            'client_id'   => 'required|exists:clients,client_id',
            'package_id'  => 'required|exists:packages,package_id',
            'event_type'  => 'required|string|max:50',
            'actual_date' => 'nullable|date',
            'location'    => 'nullable|string|max:255',
            'status'      => 'nullable|string|max:50',
            'notes'       => 'nullable|string',
        ]);

        $event->update($data);

        return redirect()->route('events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        return redirect()->route('events.index')->with('success', 'Event dihapus.');
    }
}
