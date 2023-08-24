<?php

namespace Core\Classes\Illuminate\Console;

use Core\Parents\BaseCommand;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

abstract class GeneratorCommand extends BaseCommand implements PromptsForMissingInput
{
    /**
     * The filesystem instance.
     */
    protected Filesystem $files;

    /**
     * The type of class being generated.
     */
    protected string $type;

    /**
     * Name of the class directory.
     */
    protected string $directory;

    /**
     * Reserved names that cannot be used for generation.
     */
    protected array $reservedNames = [
        '__halt_compiler',
        'abstract',
        'and',
        'array',
        'as',
        'break',
        'callable',
        'case',
        'catch',
        'class',
        'clone',
        'const',
        'continue',
        'declare',
        'default',
        'die',
        'do',
        'echo',
        'else',
        'elseif',
        'empty',
        'enddeclare',
        'endfor',
        'endforeach',
        'endif',
        'endswitch',
        'endwhile',
        'enum',
        'eval',
        'exit',
        'extends',
        'false',
        'final',
        'finally',
        'fn',
        'for',
        'foreach',
        'function',
        'global',
        'goto',
        'if',
        'implements',
        'include',
        'include_once',
        'instanceof',
        'insteadof',
        'interface',
        'isset',
        'list',
        'match',
        'namespace',
        'new',
        'or',
        'print',
        'private',
        'protected',
        'public',
        'readonly',
        'require',
        'require_once',
        'return',
        'self',
        'static',
        'switch',
        'throw',
        'trait',
        'true',
        'try',
        'unset',
        'use',
        'var',
        'while',
        'xor',
        'yield',
        '__class__',
        '__dir__',
        '__file__',
        '__function__',
        '__line__',
        '__method__',
        '__namespace__',
        '__trait__',
    ];

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Create a new class creator command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Get the stub file for the generator.
     */
    abstract protected function getStub(): string;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->is_core = $this->is_core ?? $this->options()['core'] ?? false;
        $name = $this->getArgument('name');

        [$section, $module] = $this->is_core ? [null, null] : $this->getSectionAndModuleNames();
        if (!$this->validateArguments($section, $module, $name)) {
            return;
        }

        $this->createClass($section, $module, $name);
        $this->components->info(sprintf('%s created successfully.', $this->type));
    }

    /**
     * Returns the names of the section and module
     */
    private function getSectionAndModuleNames(): array
    {
        return [
            $this->ask('Section name:'),
            $this->ask('Module name:'),
        ];
    }

    /**
     * Checks arguments for correctness
     */
    private function validateArguments(?string $section, ?string $module, string $name): bool
    {
        if ($this->isReservedName($name)) {
            $this->components->error("The name \"$name\" is reserved by PHP.");
            return false;
        }

        $directory = $this->getAbsolutePathToClass($section, $module);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }

        $class = $this->getAbsolutePathToClass($section, $module, $name);
        if (file_exists($class)) {
            $this->components->error("$this->type already exists!");
            return false;
        }

        return true;
    }

    /**
     * Returns the absolute path to the file
     */
    private function getAbsolutePathToClass(?string $section, ?string $module, ?string $name = null): string
    {
        return $this->is_core
            ? base_path("app/Core/$this->directory" . ($name ? "/$name.php" : ''))
            : base_path("app/Sections/$section/$module/$this->directory" . ($name ? "/$name.php" : ''));
    }

    /**
     * Creates a new class file
     */
    private function createClass(?string $section, ?string $module, string $name): void
    {
        file_put_contents(
            $this->getAbsolutePathToClass($section, $module, $name),
            $this->buildClass($section, $module, $name)
        );
    }

    /**
     * Build the class with the given name.
     */
    private function buildClass(?string $section, ?string $module, string $name): string
    {
        $namespace = $this->getClassNamespace($section, $module);
        $stub = file_get_contents($this->getStub());

        return str_replace(['{{ namespace }}', '{{ class }}'], [$namespace, $name], $stub);
    }

    /**
     * Get the full namespace for a given class, without the class name.
     */
    private function getClassNamespace(?string $section, ?string $module): string
    {
        return str_replace('/', '\\', $this->is_core
            ? "Core\\$this->directory"
            : "Sections\\$section\\$module\\$this->directory"
        );
    }

    /**
     * Get the value of a command argument.
     */
    protected function getArgument(string $key): string
    {
        return trim($this->argument($key));
    }

    /**
     * Checks whether the given name is reserved.
     */
    protected function isReservedName(string $name): bool
    {
        return in_array(strtolower($name), $this->reservedNames);
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
