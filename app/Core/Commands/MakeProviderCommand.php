<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeProviderCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:provider';

    /**
     * The console command description.
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Provider';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Providers';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core = true;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/provider.stub');
    }
}
