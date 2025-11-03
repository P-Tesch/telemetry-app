<?php

use App\Views\HttpMethod;
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
                $methodName = $method->getName();
                if (Str::startsWith($methodName, "__")) {
                    continue;
                }

                /** @var ReflectionAttribute $attribute */
                $attribute = current($method->getAttributes(HttpMethod::class));

                $methodNameSnake = Str::snake($methodName, "-");
                $className = Str::chopEnd($class->getShortName(), "View");
                $classNameSnake = Str::snake($className, "-");
                Route::{$attribute->getArguments()[0]}("/$classNameSnake/$methodNameSnake", [$class->getName(), $methodName])->name("$className.$methodName");
            }
        }
    }
);
