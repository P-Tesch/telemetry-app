<?php

namespace App\Views\Auth\Login;

trait LoginText {
    public array $text { get =>
        [
            "name" => __("Username"),
            "password" => __("Password"),
            "logIn" => __("Log In"),
            "incorrectCredentials" => __("The provided credentials are incorrect.")
        ];
    }
}
