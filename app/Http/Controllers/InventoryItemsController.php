<?php

namespace App\Http\Controllers;

use App\Models\InventoryItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InventoryItemsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-operations']);
    }

    public function index()
    {
        $items = InventoryItem::withCount('units')
            ->orderBy('name')
            ->paginate(20);
        return view('admin.inventory-items.index', compact('items'));
    }

    public function create()
    {
        return view('admin.inventory-items.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120', // 5MB
            ]);

            // Prepare data
            $data = [
                'name' => $request->name,
            ];

            // Handle image upload - sesuai requirement kamu
            if ($request->hasFile('picture')) {
                $data['picture'] = $request->file('picture')->store('inventory_item_pictures', 'public');
            }

            InventoryItem::create($data);

            return redirect()->route('admin.inventory-items.index')
                ->with('success', 'Inventory item berhasil dibuat.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors())
                ->with('error', 'Validasi gagal. Periksa input Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat inventory item: ' . $e->getMessage());
        }
    }

    public function edit(InventoryItem $inventoryItem)
    {
        return view('admin.inventory-items.edit', compact('inventoryItem'));
    }

    public function update(Request $request, InventoryItem $inventoryItem)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
                'remove_picture' => 'nullable|boolean',
            ]);

            $data = [
                'name' => $request->name,
            ];

            // Handle remove picture
            if ($request->has('remove_picture') && $request->remove_picture) {
                if ($inventoryItem->picture && Storage::disk('public')->exists($inventoryItem->picture)) {
                    Storage::disk('public')->delete($inventoryItem->picture);
                }
                $data['picture'] = null;
            }
            // Handle new upload (only if not removing)
            elseif ($request->hasFile('picture')) {
                // Delete old image first
                if ($inventoryItem->picture && Storage::disk('public')->exists($inventoryItem->picture)) {
                    Storage::disk('public')->delete($inventoryItem->picture);
                }
                // Upload new image
                $data['picture'] = $request->file('picture')->store('inventory_item_pictures', 'public');
            }

            $inventoryItem->update($data);

            return redirect()->route('admin.inventory-items.index')
                ->with('success', 'Inventory item berhasil diperbarui.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withInput()
                ->withErrors($e->errors())
                ->with('error', 'Validasi gagal. Periksa input Anda.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui inventory item: ' . $e->getMessage());
        }
    }

    public function destroy(InventoryItem $inventoryItem)
    {
        try {
            // Delete image if exists
            if ($inventoryItem->picture && Storage::disk('public')->exists($inventoryItem->picture)) {
                Storage::disk('public')->delete($inventoryItem->picture);
            }

            $inventoryItem->delete();
            return redirect()->route('admin.inventory-items.index')
                ->with('success', 'Inventory item dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus inventory item: ' . $e->getMessage());
        }
    }
}