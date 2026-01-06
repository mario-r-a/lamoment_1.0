<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
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
        // Trust Railway proxy for HTTPS
        if (config('app.env') === 'production') {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // UNTUK PAGINATION
        Paginator::useBootstrapFive();

        // --- GATE: USERS MANAGEMENT ---
        // CEO, CFO, CMO, COO bisa Read/Update Own. 
        // Namun hanya CEO yang bisa Create/Delete user lain.
        Gate::define('manage-users', function (User $user) {
            return $user->role === 'CEO';
        });

        // --- GATE: FINANCE (Fund Request) ---
        // Fund Request dipegang CEO & CFO.
        // CMO & COO hanya bisa create/read, tidak bisa delete atau approve.
        // Semua admin bisa akses fund requests
        Gate::define('access-fund-requests', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO', 'CMO', 'COO']);
        });

        // Hanya CEO & CFO yang bisa approve/reject/delete
        Gate::define('manage-fund-requests', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO']);
        });

        // --- GATE: CLIENTS & PARTNERS ---
        // Clients & Partners dipegang CEO & CMO.
        // CFO & COO biasanya tidak akses create/delete di sini.
        Gate::define('manage-crm', function (User $user) {
            return in_array($user->role, ['CEO', 'CMO']);
        });

        // --- GATE: EVENTS & PACKAGES ---
        // Events, Packages, Inventory dipegang CEO, CFO, COO.
        // CMO biasanya Read-only atau terbatas.
        Gate::define('manage-operations', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO', 'COO']);
        });
        
        // --- GATE: REVIEWS & FAQ ---
        // Semua Role Admin (CEO, CFO, CMO, COO) bisa akses penuh
        Gate::define('manage-content', function (User $user) {
            return in_array($user->role, ['CEO', 'CFO', 'CMO', 'COO']);
        });
    }
}
