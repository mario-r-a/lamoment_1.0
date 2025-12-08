<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- GATE: USERS MANAGEMENT ---
        // Spreadsheet: CEO, CFO, CMO, COO bisa Read/Update Own. 
        // Tapi cuma CEO yang bisa Create/Delete user lain.
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'CEO';
        });

        // --- GATE: FINANCE (Fund Request) ---
        // Spreadsheet: Fund Request dipegang CEO & CFO. 
        // CMO & COO cuma bisa create/read tapi terbatas (sesuai tabel).
        Gate::define('manage-finance', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO']);
        });

        // --- GATE: CLIENTS & PARTNERS ---
        // Spreadsheet: Clients & Partners dipegang CEO & CMO.
        // CFO & COO biasanya tidak akses create/delete di sini.
        Gate::define('manage-crm', function (User $user) {
            return in_array($user->role, ['CEO', 'CMO']);
        });

        // --- GATE: EVENTS & PACKAGES ---
        // Spreadsheet: Events, Packages, Inventory dipegang CEO, CFO, COO.
        // CMO biasanya Read-only atau terbatas.
        Gate::define('manage-operations', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO', 'COO']);
        });
        
        // --- GATE: REVIEWS & FAQ ---
        // Spreadsheet: Semua Role Admin (CEO, CFO, CMO, COO) bisa akses penuh
        Gate::define('manage-content', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO', 'CMO', 'COO']);
        });
    }
}
