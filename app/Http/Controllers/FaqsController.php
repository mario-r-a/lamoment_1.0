<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:manage-content'])->except(['publicIndex']);
    }

    public function publicIndex()
    {
        return view('faqs');
    }

    public function index()
    {
        $faqs = Faq::with('category')->orderBy('position')->paginate(20);
        return view('faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('faqs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,faq_category_id',
            'question'        => 'required|string|max:255',
            'answer'          => 'required|string',
            'position'        => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        Faq::create($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil dibuat.');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('faqs.edit', compact('faq', 'categories'));
    }

    public function update(Request $request, Faq $faq)
    {
        $data = $request->validate([
            'faq_category_id' => 'required|exists:faq_categories,faq_category_id',
            'question'        => 'required|string|max:255',
            'answer'          => 'required|string',
            'position'        => 'nullable|integer',
            'is_active'       => 'nullable|boolean',
        ]);

        $data['is_active'] = $data['is_active'] ?? true;

        $faq->update($data);

        return redirect()->route('faqs.index')->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faqs.index')->with('success', 'FAQ dihapus.');
    }
}