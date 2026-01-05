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

    // ===== PUBLIC =====
    public function publicIndex()
    {
        // Get only active categories with at least one active FAQ
        $categories = FaqCategory::with(['faqs' => function ($q) {
            $q->where('is_active', true)->orderBy('position');
        }])
        ->where('is_active', true)
        ->orderBy('position')
        ->get()
        ->filter(function($category) {
            // Only include categories that have at least one active FAQ
            return $category->faqs->count() > 0;
        });

        return view('public.faqs', compact('categories'));
    }

    // ===== ADMIN CRUD =====
    public function index()
    {
        // Order by category position first, then by FAQ position
        $faqs = Faq::with(['category'])
            ->join('faq_categories', 'faqs.faq_category_id', '=', 'faq_categories.faq_category_id')
            ->select('faqs.*')
            ->orderBy('faq_categories.position')
            ->orderBy('faqs.position')
            ->paginate(20);
            
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.create', compact('categories'));
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

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil dibuat.');
    }

    public function edit(Faq $faq)
    {
        $categories = FaqCategory::orderBy('name')->get();
        return view('admin.faqs.edit', compact('faq', 'categories'));
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

        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ berhasil diperbarui.');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('admin.faqs.index')
            ->with('success', 'FAQ dihapus.');
    }
}