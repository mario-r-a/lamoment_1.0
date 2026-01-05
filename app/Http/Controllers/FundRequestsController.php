<?php

namespace App\Http\Controllers;

use App\Models\FundRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FundRequestsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'can:access-fund-requests']);
    }

    public function index()
    {
        $fundRequests = FundRequest::with(['requestor', 'approver'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);
        return view('admin.fund-requests.index', compact('fundRequests'));
    }

    public function create()
    {
        return view('admin.fund-requests.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'nullable|string|max:120',
            'request_date' => 'required|date',
            'total_estimated' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,needs revision,approved,rejected',
        ]);

        $canManageStatus = Gate::allows('manage-fund-requests');
        
        if (!$canManageStatus) {
            $validated['status'] = 'pending';
        } else {
            $validated['status'] = $validated['status'] ?? 'pending';
        }

        $data = [
            'requestor_id' => Auth::id(),
            'title' => $validated['title'],
            'request_date' => $validated['request_date'],
            'total_estimated' => $validated['total_estimated'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ];

        if ($canManageStatus && in_array($validated['status'], ['approved', 'rejected'])) {
            $data['approver_id'] = Auth::id();
        }

        FundRequest::create($data);

        return redirect()->route('admin.fund-requests.index')
            ->with('success', 'Fund request berhasil dibuat.');
    }

    public function edit(FundRequest $fundRequest)
    {
        $canManageStatus = Gate::allows('manage-fund-requests');
        
        if (!$canManageStatus && $fundRequest->requestor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $canManageFinance = $canManageStatus;
        $approvers = User::whereIn('role', ['CEO', 'CFO'])->orderBy('name')->get();
        
        return view('admin.fund-requests.edit', compact('fundRequest', 'canManageFinance', 'approvers'));
    }

    public function update(Request $request, FundRequest $fundRequest)
    {
        $canManageStatus = Gate::allows('manage-fund-requests');
        
        if (!$canManageStatus && $fundRequest->requestor_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $validated = $request->validate([
            'title' => 'nullable|string|max:120',
            'request_date' => 'required|date',
            'total_estimated' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'status' => 'nullable|string|in:pending,needs revision,approved,rejected',
        ]);

        if (!$canManageStatus) {
            $validated['status'] = $fundRequest->status;
        } else {
            $validated['status'] = $validated['status'] ?? $fundRequest->status;
        }

        $data = [
            'title' => $validated['title'],
            'request_date' => $validated['request_date'],
            'total_estimated' => $validated['total_estimated'],
            'description' => $validated['description'],
            'status' => $validated['status'],
        ];

        if ($canManageStatus && $validated['status'] !== $fundRequest->status) {
            if (in_array($validated['status'], ['approved', 'rejected'])) {
                $data['approver_id'] = Auth::id();
            }
        }

        $fundRequest->update($data);

        return redirect()->route('admin.fund-requests.index')
            ->with('success', 'Fund request berhasil diperbarui.');
    }

    public function destroy(FundRequest $fundRequest)
    {
        // ✅ LOGIC DELETE:
        // 1. CEO & CFO: Bisa delete semua fund requests
        // 2. CMO & COO: Bisa delete milik sendiri HANYA jika status = "pending"
        
        $canManageStatus = Gate::allows('manage-fund-requests');
        
        // Case 1: CEO/CFO - bisa delete semua
        if ($canManageStatus) {
            $fundRequest->delete();
            return redirect()->route('admin.fund-requests.index')
                ->with('success', 'Fund request dihapus.');
        }
        
        // Case 2: CMO/COO - hanya bisa delete milik sendiri jika pending
        if ($fundRequest->requestor_id === Auth::id()) {
            // Cek apakah status masih "pending"
            if ($fundRequest->status === 'pending') {
                $fundRequest->delete();
                return redirect()->route('admin.fund-requests.index')
                    ->with('success', 'Fund request dihapus.');
            } else {
                // Status bukan pending (approved/rejected/needs revision)
                return redirect()->back()
                    ->with('error', 'Anda hanya bisa menghapus fund request dengan status "pending".');
            }
        }
        
        // Case 3: Bukan milik sendiri & bukan CEO/CFO
        abort(403, 'Unauthorized action.');
    }
}