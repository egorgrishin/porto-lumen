<?php

namespace Core\Classes\Illuminate\Console;

use Illuminate\Console\Command;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputArgument;

abstract class GeneratorCommand extends Command implements PromptsForMissingInput
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
            $class_directory = $module_directory . "/$this->directory",
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
     * Checks whether the given name is reserved.
     */
    protected function isReservedName(string $name): bool
    {
        return in_array(strtolower($name), $this->reservedNames);
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
        return "Sections\\$section\\$module\\$this->directory";
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
