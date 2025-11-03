<?php

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Laravel\Prompts\Output\ConsoleOutput;
use PropertyHookType;
use ReflectionClass;
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

            $instance = $class->newInstance(new Request());
            $tsProperties = [];

            foreach ($properties as $property) {
                /** @var ReflectionNamedType $type */
                $type = $property->getType();
                if (!$type) {
                    throw new Exception("Untyped property " . $class->getShortName() . "->" . $property->getName());
                }

                $tsProperties[$property->getName()] = $this->mapPhpTypeToTs(
                    $type,
                    $property,
                    $instance,
                    $class->getShortName()
                );
            }

            $className = Str::chopEnd($class->getShortName(), "View");
            $interfaces = [];
            $contents = $this->generateTsInterfaces($className, $tsProperties, $interfaces);

            $filename = "{$className}Props.ts";
            $filePath = resource_path("js/Props/$filename");
            if (file_exists($filePath)) {
                unlink($filePath);
            }
            file_put_contents($filePath, $contents);
        }

        new ConsoleOutput()->writeln("Types generated for views");
    }

    private function mapPhpTypeToTs(ReflectionNamedType $type, ReflectionProperty $property, object $instance, string $parentName)
    {
        switch ($type->getName()) {
            case "string":
                return "string";

            case "int":
            case "float":
                return "number";

            case "bool":
                return "boolean";

            case "array":
                $value = $property->hasHook(PropertyHookType::Get)
                    ? $property->getHook(PropertyHookType::Get)->invoke($instance)
                    : $property->getValue($instance);

                return $this->inferTsArrayType($value, $parentName . ucfirst($property->getName()));

            default:
                return "any";
        }
    }

    private function inferTsArrayType($value, string $baseName)
    {
        if (!is_array($value)) {
            return gettype($value);
        }

        $tsObject = [];
        foreach ($value as $key => $innerValue) {
            if (is_array($innerValue)) {
                $tsObject[$key] = $this->inferTsArrayType($innerValue, $baseName . ucfirst($key));
                continue;
            }

            $tsObject[$key] = match (gettype($innerValue)) {
                "string" => "string",
                "integer", "float" => "number",
                "boolean" => "boolean",
                default => "any",
            };
        }

        return $tsObject;
    }

    private function generateTsInterfaces(string $name, array $tsProperties, array &$interfaces): string
    {
        $contents = "export default interface {$name}Props {";

        foreach ($tsProperties as $key => $type) {
            if (!is_array($type)) {
                $contents .= "\n\t$key: $type";
                continue;
            }

            $nestedName = $name . ucfirst($key);
            $contents .= "\n\t$key: $nestedName";
            $interfaces[$nestedName] = $type;
        }

        $contents .= "\n}\n\n";

        foreach ($interfaces as $nestedName => $nestedProps) {
            $contents .= "export interface $nestedName {";
            foreach ($nestedProps as $key => $innerType) {
                if (!is_array($innerType)) {
                    $contents .= "\n\t$key: $innerType";
                    continue;
                }

                $childName = $nestedName . ucfirst($key);
                $contents .= "\n\t$key: $childName";
                $interfaces[$childName] = $innerType;
            }
            $contents .= "\n}\n\n";
        }

        return $contents;
    }
}
