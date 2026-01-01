<?php

namespace App\Http\Controllers;

use App\Services\GoogleRoutesService;
use Illuminate\Http\Request;

class TollController extends Controller
{
    protected $googleRoutes;

    public function __construct(GoogleRoutesService $googleRoutes)
    {
        $this->middleware('auth');
        $this->googleRoutes = $googleRoutes;
    }

    /**
     * Tampilkan form cek tarif tol (GET)
     */
    public function index()
    {
        return view('admin.toll.index');
    }

    /**
     * Proses cek tarif tol (POST)
     */
    public function calculate(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'origin' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
        ], [
            'origin.required' => 'Alamat asal harus diisi.',
            'destination.required' => 'Alamat tujuan harus diisi.',
        ]);

        // Panggil service
        $result = $this->googleRoutes->getTollPrice(
            $validated['origin'],
            $validated['destination']
        );

        // Return JSON atau redirect
        if ($request->expectsJson()) {
            return response()->json($result);
        }

        return redirect()->back()->with('toll_result', $result);
    }
}