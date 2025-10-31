<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Views\LandingPage\LandingPageView;
use Illuminate\Support\Facades\Route;

Route::group(
    attributes: [
        'middleware' => [
            HandleInertiaRequests::class,
        ]
    ],
    routes: static function (): void {
        Route::get('/', LandingPageView::class);
    }
);
