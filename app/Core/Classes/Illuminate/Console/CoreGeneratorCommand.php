<?php

namespace Core\Classes\Illuminate\Console;

use Illuminate\Contracts\Console\PromptsForMissingInput;
use Symfony\Component\Console\Input\InputArgument;

abstract class CoreGeneratorCommand extends GeneratorCommand implements PromptsForMissingInput
{
    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $name = $this->getArgument('name');
        if (!$this->validateArguments($name)) {
            return;
        }

        $this->createClass($name);
        $this->components->info(sprintf('%s created successfully.', $this->type));
    }

    /**
     * Checks arguments for correctness
     */
    private function validateArguments(string $name): bool
    {
        if ($this->isReservedName($name)) {
            $this->components->error("The name \"$name\" is reserved by PHP.");
            return false;
        }

        if (!file_exists($directory = $this->getAbsolutePathToClass())) {
            mkdir($directory, 0777, true);
        }

        if (file_exists($this->getAbsolutePathToClass($name))) {
            $this->components->error("$this->type already exists!");
            return false;
        }

        return true;
    }

    /**
     * Creates a new class file
     */
    private function createClass(string $name): void
    {
        file_put_contents(
            $this->getAbsolutePathToClass($name),
            $this->buildClass($name)
        );
    }

    /**
     * Returns the absolute path to the file
     */
    private function getAbsolutePathToClass(?string $name = null): string
    {
        return base_path("app/Core/$this->directory" . ($name ? "/$name.php" : ''));
    }

    /**
     * Build the class with the given name.
     */
    protected function buildClass(string $name): string
    {
        $namespace = $this->getClassNamespace();
        $stub = file_get_contents($this->getStub());

        return str_replace(['{{ namespace }}', '{{ class }}'], [$namespace, $name], $stub);
    }

    /**
     * Get the full namespace for a given class, without the class name.
     */
    private function getClassNamespace(): string
    {
        return "Core\\$this->directory";
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the ' . strtolower($this->type)],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name' => "$this->type name:",
        ];
    }
}
