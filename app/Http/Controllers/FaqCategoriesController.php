<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqCategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-content']);
    }

    public function index()
    {
        $categories = FaqCategory::orderBy('position')->paginate(20);
        return view('admin.faq-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.faq-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'position'    => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);
        // status dropdown: '1' => active, '0' => inactive
        $data['is_active'] = (int) $request->input('is_active', 0) === 1;
        FaqCategory::create($data);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category berhasil dibuat.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('admin.faq-categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'position'    => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);
        // dropdown: 1 = active, 0 = inactive
        $data['is_active'] = (int) $request->input('is_active', 0) === 1;
        $faqCategory->update($data);

        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category berhasil diperbarui.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();
        return redirect()->route('admin.faq-categories.index')
            ->with('success', 'FAQ Category dihapus.');
    }
}
