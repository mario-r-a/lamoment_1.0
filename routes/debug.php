<?php

use Illuminate\Support\Facades\Route;

// Temporary debug route - REMOVE IN PRODUCTION
Route::get('/debug-css', function () {
    $stylePath = public_path('css/style.css');
    $styleUrl = asset('css/style.css');
    
    $cssFiles = [
        'style.css' => public_path('css/style.css'),
        'base/variables.css' => public_path('css/base/variables.css'),
        'base/fonts.css' => public_path('css/base/fonts.css'),
        'components/navbar.css' => public_path('css/components/navbar.css'),
    ];
    
    $results = [];
    foreach ($cssFiles as $name => $path) {
        $results[$name] = [
            'exists' => file_exists($path),
            'size' => file_exists($path) ? filesize($path) : 0,
            'readable' => file_exists($path) && is_readable($path),
            'url' => asset('css/' . $name),
        ];
    }
    
    return response()->json([
        'status' => 'OK',
        'asset_url_function' => $styleUrl,
        'public_path' => public_path(),
        'css_files' => $results,
        'app_url' => config('app.url'),
        'view_test' => view('layouts.mainlayout')->render() ? 'Rendered successfully' : 'Render failed',
    ]);
});
