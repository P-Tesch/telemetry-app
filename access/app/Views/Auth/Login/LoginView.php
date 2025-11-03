<?php

namespace App\Views\Auth\Login;

use App\Views\InertiaView;

class LoginView extends InertiaView {
    use LoginText;

    protected string $view { get => "Auth/LoginPage"; }
}
