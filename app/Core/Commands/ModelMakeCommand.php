<?php

namespace Core\Commands;

use Illuminate\Console\Concerns\CreatesMatchingTest;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class ModelMakeCommand extends GeneratorCommand
{
    use CreatesMatchingTest;

    /**
     * The console command name.
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected $type = 'Model';

    /**
     * Execute the console command.
     */
    public function handle(): ?bool
    {
        [$section, $module, $name] = [
            $this->getArgument('section'),
            $this->getArgument('module'),
            $this->getArgument('name'),
        ];

        if (!$this->validateArguments($section, $module, $name)) {
            return false;
        }

        $this->createClass($section, $module, $name);
        $this->components->info(sprintf('%s created successfully.', $this->type));
        return null;
    }

    /**
     * Get the value of a command argument.
     */
    private function getArgument(string $key): string
    {
        return trim($this->argument($key));
    }

    /**
     * Checks arguments for correctness
     */
    private function validateArguments(string $section, string $module, string $name): bool
    {
        if ($this->isReservedName($name)) {
            $this->components->error("The name \"$name\" is reserved by PHP.");
            return false;
        }

        foreach ([
            $section_directory = base_path("app/Sections/$section"),
            $module_directory = $section_directory . "/$module",
            $class_directory = $module_directory . '/Models',
        ] as $directory) {
            if (!file_exists($directory)) {
                $this->components->error("Directory \"$directory\" does not exist.");
                return false;
            }
        }

        $class = $class_directory . "/$name.php";
        if (file_exists($class)) {
            $this->components->error("$this->type already exists!");
            return false;
        }

        return true;
    }

    /**
     * Creates a new class file
     */
    private function createClass(string $section, string $module, string $name): void
    {
        file_put_contents(
            $this->getAbsolutePathToClass($section, $module, $name),
            $this->buildController($section, $module, $name)
        );
    }

    /**
     * Returns the absolute path to the file
     */
    private function getAbsolutePathToClass(string $section, string $module, string $name): string
    {
        return base_path("app/Sections/$section/$module/Models/$name.php");
    }

    /**
     * Build the class with the given name.
     */
    private function buildController(string $section, string $module, string $name): string
    {
        $namespace = $this->getClassNamespace($section, $module);
        $stub = file_get_contents($this->getStub());

        return str_replace(['{{ namespace }}', '{{ class }}'], [$namespace, $name], $stub);
    }

    /**
     * Get the full namespace for a given class, without the class name.
     */
    private function getClassNamespace(string $section, string $module): string
    {
        return "Sections\\$section\\$module\\Models";
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/model.stub');
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the ' . strtolower($this->type)],
            ['section', InputArgument::REQUIRED, 'The name of the section'],
            ['module', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name'    => "$this->type name:",
            'section' => 'Section name:',
            'module'  => 'Module name:',
        ];
    }
}
