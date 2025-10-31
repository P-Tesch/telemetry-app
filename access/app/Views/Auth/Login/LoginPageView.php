<?php

namespace App\Views\Auth\Login;

use App\Views\HttpMethod;
use App\Views\InertiaView;

class LoginPageView extends InertiaView {
    protected string $view { get => "Auth/LoginPage"; }

    #[HttpMethod(HttpMethod::GET)]
    public function login(): void {

    }
}
