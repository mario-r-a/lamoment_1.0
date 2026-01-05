<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnersController extends Controller
{
    public function __construct()
    {
        // Semua admin bisa akses index (view only)
        $this->middleware('auth');
        
        // Hanya CEO & CMO yang bisa Create/Update/Delete
        $this->middleware('can:manage-crm')->except(['index']);
    }

    public function index()
    {
        $partners = Partner::orderBy('name')->paginate(20);
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'type'           => 'nullable|string|max:50',
        ]);

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dibuat.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'           => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'phone'          => 'nullable|string|max:50',
            'type'           => 'nullable|string|max:50',
        ]);

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil diperbarui.');
    }

    public function destroy(Partner $partner)
    {
        $partner->delete();
        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner dihapus.');
    }
}
