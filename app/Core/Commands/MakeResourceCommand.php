<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputOption;

class MakeResourceCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:resource';

    /**
     * The console command description.
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Resource';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Resources';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core = false;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path($this->isCollection()
            ? 'app/Core/Stubs/resource-collection.stub'
            : 'app/Core/Stubs/resource.stub'
        );
    }

    /**
     * Determine if the command is generating a resource collection.
     */
    private function isCollection(): bool
    {
        return $this->option('collection') || Str::endsWith($this->getArgument('name'), 'Collection');
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['collection', 'c', InputOption::VALUE_NONE, 'Create a resource collection'],
        ];
    }
}
