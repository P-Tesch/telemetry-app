<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use PropertyHookType;
use ReflectionClass;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionProperty;
use Str;
use Symfony\Component\Finder\Finder;

class GenerateViewsTS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-views-ts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates Typescript types for app views';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        foreach (Finder::create()->files()->in(app_path("Views"))->name("*View.php") as $file) {
            if ($file->getFilename() === "InertiaView.php") {
                continue;
            }

            preg_match("/(app\/Views\/.*)\.php/", $file->getPathname(), $matches);
            if (!$matches) {
                continue;
            }

            $class = new ReflectionClass(Str::replace("/", "\\", Str::ucfirst(array_pop($matches))));

            /** @var list<ReflectionProperty> $properties */
            $properties = $class->getProperties(ReflectionProperty::IS_PUBLIC);
            new Collection($class->getTraits())->each(fn (ReflectionClass $trait) => array_merge($properties, $trait->getProperties()));
            $tsProperties = [];
            foreach ($properties as $property) {
                /** @var ReflectionNamedType $type */
                $type = $property->getType();

                switch ($type->getName()) {
                    case "string":
                        $tsProperties[$property->getName()] = "string";
                        break;

                    case "int":
                    case "float":
                        $tsProperties[$property->getName()] = "number";
                        break;

                    case "bool":
                        $tsProperties[$property->getName()] = "boolean";
                        break;

                    case "array":
                        $instance = $property->getDeclaringClass()->newInstance(new Request());
                        $value = $property->hasHook(PropertyHookType::Get) ? $property->getHook(PropertyHookType::Get)->invoke($instance) : $property->getValue($instance);
                        $innerProperties = [];
                        foreach ($value as $innerProperty => $innerValue) {
                            $innerProperties[$innerProperty] = gettype($innerValue);
                        }
                        $tsProperties[$property->getName()] = $innerProperties;
                }
            }

            $className = Str::chopEnd($class->getShortName(), "View");
            $contents = "export default interface {$className}Props {";
            foreach ($tsProperties as $key => $type) {
                if (is_array($type)) {
                    $type = $className . ucfirst($key);
                }

                $contents .= "\n\t$key: $type";
            }
            $contents .= "\n}\n\n";

            foreach ($tsProperties as $key => $type) {
                if (!is_array($type)) {
                    continue;
                }

                $contents .= "export interface " . $className . ucfirst($key) . " {";

                foreach ($type as $innerKey => $innerType) {
                    $contents .= "\n\t$innerKey: $innerType";
                }

                $contents .= "\n}\n\n";
            }

            $filename = "{$className}Props.ts";
            unlink(resource_path("js/Props/$filename"));
            file_put_contents(resource_path("js/Props/$filename"), $contents);
        }
    }
}
