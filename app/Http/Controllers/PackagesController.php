<?php

namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PackagesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-operations'])->except(['publicIndex']);
    }

    // ===== PUBLIC =====
    public function publicIndex()
    {
        $packages = Package::where('is_active', true)
            ->with(['items'])
            ->orderBy('name')
            ->get();

        // Pass WhatsApp number & formatted packages to view
        $whatsappNumber = '6282318606525';

        return view('public.packages', compact('packages', 'whatsappNumber'));
    }

    // ===== ADMIN CRUD =====
    public function index()
    {
        $packages = Package::orderBy('package_id', 'asc')->paginate(20);
        return view('admin.packages.index', compact('packages'));
    }

    public function create()
    {
        return view('admin.packages.create');
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'base_price' => 'required|numeric|min:0',
                'is_active' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            ]);

            $data = [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'base_price' => $validated['base_price'],
                'is_active' => $request->has('is_active') ? true : false,
            ];

            // Handle image upload
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('packages', 'public');
            }

            Package::create($data);

            return redirect()->route('admin.packages.index')
                ->with('success', 'Package berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat package: ' . $e->getMessage());
        }
    }

    public function edit(Package $package)
    {
        return view('admin.packages.edit', compact('package'));
    }

    public function update(Request $request, Package $package)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'base_price' => 'required|numeric|min:0',
                'is_active' => 'nullable|boolean',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'remove_image' => 'nullable|boolean',
            ]);

            $data = [
                'name' => $validated['name'],
                'description' => $validated['description'] ?? null,
                'base_price' => $validated['base_price'],
                'is_active' => $request->has('is_active') ? true : false,
            ];

            // Handle remove image
            if ($request->has('remove_image') && $request->remove_image) {
                if ($package->image && Storage::disk('public')->exists($package->image)) {
                    Storage::disk('public')->delete($package->image);
                }
                $data['image'] = null;
            }
            // Handle new upload (only if not removing)
            elseif ($request->hasFile('image')) {
                // Delete old image
                if ($package->image && Storage::disk('public')->exists($package->image)) {
                    Storage::disk('public')->delete($package->image);
                }
                $data['image'] = $request->file('image')->store('packages', 'public');
            }

            $package->update($data);

            return redirect()->route('admin.packages.index')
                ->with('success', 'Package berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui package: ' . $e->getMessage());
        }
    }

    public function destroy(Package $package)
    {
        try {
            // Delete image if exists
            if ($package->image && Storage::disk('public')->exists($package->image)) {
                Storage::disk('public')->delete($package->image);
            }

            $package->delete();
            return redirect()->route('admin.packages.index')
                ->with('success', 'Package dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus package: ' . $e->getMessage());
        }
    }
}