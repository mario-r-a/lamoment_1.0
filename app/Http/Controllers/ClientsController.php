<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-crm']);
    }

    public function index()
    {
        $clients = Client::orderBy('name')->paginate(20);
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:50',
            'source' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'notes'  => 'nullable|string',
        ]);

        Client::create($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client berhasil dibuat.');
    }

    public function edit(Client $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:50',
            'source' => 'nullable|string|max:100',
            'status' => 'nullable|string|max:50',
            'notes'  => 'nullable|string',
        ]);

        $client->update($data);

        return redirect()->route('admin.clients.index')
            ->with('success', 'Client berhasil diperbarui.');
    }

    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('admin.clients.index')
            ->with('success', 'Client dihapus.');
    }
}
