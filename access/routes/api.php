<?php

use App\Views\Auth\Login\LoginPageView;
use App\Views\Auth\Register\RegisterPageView;
use App\Views\HttpMethod;
use App\Views\LandingPage\LandingPageView;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Finder\Finder;

Route::group(
    attributes: [
        'middleware' => []
    ],
    routes: static function (): void {
        foreach (Finder::create()->files()->in(app_path("Views"))->name("*View.php") as $file) {
            if ($file->getFilename() === "InertiaView.php") {
                continue;
            }

            preg_match("/(app\/Views\/.*)\.php/", $file->getPathname(), $matches);
            if (!$matches) {
                continue;
            }

            $class = new ReflectionClass(Str::replace("/", "\\", Str::ucfirst(array_pop($matches))));

            /** @var list<ReflectionMethod> $methods */
            $methods = $class->getMethods(ReflectionMethod::IS_PUBLIC);
            foreach ($methods as $method) {
                if (Str::startsWith($method->getName(), "__")) {
                    continue;
                }

                /** @var ReflectionAttribute $attribute */
                $attribute = current($method->getAttributes(HttpMethod::class));

                Route::{$attribute->getArguments()[0]};
            }
        }
        die;
    }
);
