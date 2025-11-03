<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Views\Auth\Login\LoginView;
use App\Views\Auth\Register\RegisterView;
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
        Route::get('/login', LoginView::class);
        Route::get('/register', RegisterView::class);
    }
);
