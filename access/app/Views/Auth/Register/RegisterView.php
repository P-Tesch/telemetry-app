<?php

namespace App\Views\Auth\Register;

use App\Views\InertiaView;

class RegisterView extends InertiaView {
    use RegisterText;

    protected string $view { get => "Auth/RegisterPage"; }
}
