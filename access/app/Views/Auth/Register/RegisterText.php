<?php

namespace App\Views\Auth\Register;

trait RegisterText {
    public array $text { get =>
        [
            "name" => __("Username"),
            "password" => __("Password"),
            "register" => __("Register"),
            "email" => __("E-mail"),
            "confirmation" => __("Confirm password")
        ];
    }
}
