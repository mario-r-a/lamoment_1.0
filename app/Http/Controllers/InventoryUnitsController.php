<?php

namespace App\Http\Controllers;

use App\Models\InventoryUnit;
use App\Models\InventoryItem;
use Illuminate\Http\Request;

class InventoryUnitsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-operations']);
    }

    public function index()
    {
        $units = InventoryUnit::with('item')
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.inventory-units.index', compact('units'));
    }

    public function create()
    {
        $items = InventoryItem::orderBy('name')->get();
        return view('admin.inventory-units.create', compact('items'));
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'inventory_item_id' => 'required|exists:inventory_items,inventory_item_id',
                'condition' => 'nullable|string|max:50',
                'purchase_date' => 'nullable|date',
                'purchase_price' => 'nullable|numeric|min:0',
                'lifespan_months' => 'nullable|integer|min:0',
                'status' => 'nullable|string|max:50',
            ]);

            InventoryUnit::create($data);

            return redirect()->route('admin.inventory-units.index')
                ->with('success', 'Inventory unit berhasil dibuat.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal membuat inventory unit: ' . $e->getMessage());
        }
    }

    public function edit(InventoryUnit $inventoryUnit)
    {
        $items = InventoryItem::orderBy('name')->get();
        return view('admin.inventory-units.edit', compact('inventoryUnit', 'items'));
    }

    public function update(Request $request, InventoryUnit $inventoryUnit)
    {
        try {
            $data = $request->validate([
                'inventory_item_id' => 'required|exists:inventory_items,inventory_item_id',
                'condition' => 'nullable|string|max:50',
                'purchase_date' => 'nullable|date',
                'purchase_price' => 'nullable|numeric|min:0',
                'lifespan_months' => 'nullable|integer|min:0',
                'status' => 'nullable|string|max:50',
            ]);

            $inventoryUnit->update($data);

            return redirect()->route('admin.inventory-units.index')
                ->with('success', 'Inventory unit berhasil diperbarui.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Gagal memperbarui inventory unit: ' . $e->getMessage());
        }
    }

    public function destroy(InventoryUnit $inventoryUnit)
    {
        try {
            $inventoryUnit->delete();
            return redirect()->route('admin.inventory-units.index')
                ->with('success', 'Inventory unit dihapus.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menghapus inventory unit: ' . $e->getMessage());
        }
    }
}