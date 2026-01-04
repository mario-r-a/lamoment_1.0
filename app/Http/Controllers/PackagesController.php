<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-operations'])->except(['publicIndex']);
    }

    // ===== PUBLIC =====
    public function publicIndex()
    {
        // Eager-load, handle N+1 case
        $packages = Package::where('is_active', true)
            ->with(['items'])
            ->orderBy('name')
            ->get();

        return view('public.packages', compact('packages'));
    }

    // ===== ADMIN CRUD =====
    public function index()
    {
        $packages = Package::orderBy('name')->paginate(20);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price'  => 'required|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;
        Package::create($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package berhasil dibuat.');
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'base_price'  => 'required|numeric|min:0',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;
        $package->update($data);

        return redirect()->route('admin.packages.index')
            ->with('success', 'Package berhasil diperbarui.');
    }

    public function destroy(Package $package)
    {
        $package->delete();
        return redirect()->route('admin.packages.index')
            ->with('success', 'Package dihapus.');
    }
}