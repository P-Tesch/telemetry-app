<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::group(
    attributes: [
        'middleware' => [
            HandleInertiaRequests::class
        ]
    ],
    routes: static function (): void {
        Route::get('/', function () {
            return Inertia::render('LandingPage', [
                'message' => 'Teste'
            ]);
        });
    }
);
