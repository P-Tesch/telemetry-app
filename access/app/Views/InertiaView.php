<?php

namespace App\Views;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use ReflectionClass;
use ReflectionProperty;

abstract class InertiaView {

    abstract protected string $view { get; }

    final public function __construct(
        protected Request $request
    ) {}

    final public function __invoke(): Response {
        return Inertia::render(
            $this->view,
            collect(new ReflectionClass($this)->getProperties(ReflectionProperty::IS_PUBLIC))
                ->mapWithKeys(fn (ReflectionProperty $property) =>
                    [$property->getName() => $property->getValue($this)]
                )->toArray()
        );
    }
}
