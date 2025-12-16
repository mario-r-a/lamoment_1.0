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
        return view('faq-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('faq-categories.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'position'    => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        FaqCategory::create($data);

        return redirect()->route('faq-categories.index')->with('success', 'FAQ Category berhasil dibuat.');
    }

    public function edit(FaqCategory $faqCategory)
    {
        return view('faq-categories.edit', compact('faqCategory'));
    }

    public function update(Request $request, FaqCategory $faqCategory)
    {
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'position'    => 'nullable|integer',
            'is_active'   => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $faqCategory->update($data);

        return redirect()->route('faq-categories.index')->with('success', 'FAQ Category berhasil diperbarui.');
    }

    public function destroy(FaqCategory $faqCategory)
    {
        $faqCategory->delete();
        return redirect()->route('faq-categories.index')->with('success', 'FAQ Category dihapus.');
    }
}
