<?php

namespace App\Views\LandingPage;

trait LandingPageText {
    public array $text { get =>
        [
            "logIn" => __("Log In"),
            "register" => __("Register"),
        ];
    }
}
