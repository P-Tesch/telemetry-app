<?php

namespace App\Views\Home;

use App\Views\InertiaView;

class HomeView extends InertiaView {
    use HomeText;

    protected string $view { get => "Home"; }
    public string $test = "test";
}
