<?php

namespace App\Views\LandingPage;

use App\Views\InertiaView;

class LandingPageView extends InertiaView {
    use LandingPageText;

    protected string $view {get => "LandingPage";}

    public string $message = "TESTE";
}
