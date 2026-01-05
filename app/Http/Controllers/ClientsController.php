<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientsController extends Controller
{
    public function __construct()
    {
        // Semua admin HARUS login untuk akses controller ini
        $this->middleware('auth');
        
        // Hanya CEO & CMO yang bisa Create/Update/Delete
        // TAPI Index harus dikecualikan agar bisa diakses semua admin
        $this->middleware('can:manage-crm')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $clients = Client::orderBy('client_id', 'asc')->paginate(20);
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
            'status' => 'required|string|in:belum deal,perlu remind dp,perlu remind lunas,perlu mengingat tanggal hari-h,selesai acara',
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
            'status' => 'required|string|in:belum deal,perlu remind dp,perlu remind lunas,perlu mengingat tanggal hari-h,selesai acara',
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
