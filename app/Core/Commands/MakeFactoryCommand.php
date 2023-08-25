<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeFactoryCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:factory';

    /**
     * The console command description.
     */
    protected $description = 'Create a new model factory';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Factory';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Data/Factories';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core = false;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/factory.stub');
    }
}
