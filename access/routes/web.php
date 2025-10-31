<?php

use App\Http\Middleware\HandleInertiaRequests;
use App\Views\Auth\Login\LoginPageView;
use App\Views\Auth\Register\RegisterPageView;
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
        Route::get('/login', LoginPageView::class);
        Route::get('/register', RegisterPageView::class);
    }
);
