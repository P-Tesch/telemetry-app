<?php

namespace App\Views\Auth\Login;

use App\Views\HttpMethod;
use App\Views\InertiaView;
use Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Redirect;

class LoginView extends InertiaView {
    use LoginText;

    protected string $view { get => "Auth/Login"; }

    #[HttpMethod(HttpMethod::POST)]
    public function login(Request $request): RedirectResponse {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            return Redirect::away("/home");
        }
        throw ValidationException::withMessages([
            'name' => [$this->text["incorrectCredentials"]],
        ]);
    }

    #[HttpMethod(HttpMethod::POST)]
    public function logout(): RedirectResponse {
        Auth::logout();

        return Redirect::away("/");
    }
}
