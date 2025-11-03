<?php

namespace App\Views\Auth\Register;

use App\Models\User;
use App\Views\HttpMethod;
use App\Views\InertiaView;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Redirect;

class RegisterView extends InertiaView {
    use RegisterText;

    protected string $view { get => "Auth/RegisterPage"; }

    #[HttpMethod(HttpMethod::POST)]
    public function register(Request $request): RedirectResponse {
        $request->validate([
            "name" => "required",
            "email" => "required|email",
            "password" => "required"
        ]);

        User::create($request->only("name", "email", "password"));

        return Redirect::away("/login");
    }
}
