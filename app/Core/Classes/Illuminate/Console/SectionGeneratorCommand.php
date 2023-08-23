<?php

namespace Core\Classes\Illuminate\Console;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Console\Input\InputArgument;

abstract class SectionGeneratorCommand extends GeneratorCommand implements PromptsForMissingInput
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        [$section, $module, $name] = [
            $this->getArgument('section'),
            $this->getArgument('module'),
            $this->getArgument('name'),
        ];

        if (!$this->validateArguments($section, $module, $name)) {
            return;
        }

        $this->createClass($section, $module, $name);
        $this->components->info(sprintf('%s created successfully.', $this->type));
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
            $module_directory = "$section_directory/$module",
            $class_directory = "$module_directory/$this->directory",
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
            $this->buildClass($section, $module, $name)
        );
    }

    /**
     * Returns the absolute path to the file
     */
    private function getAbsolutePathToClass(string $section, string $module, string $name): string
    {
        return base_path("app/Sections/$section/$module/$this->directory/$name.php");
    }

    /**
     * Build the class with the given name.
     */
    private function buildClass(string $section, string $module, string $name): string
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
        return str_replace('/', '\\', "Sections\\$section\\$module\\$this->directory");
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
