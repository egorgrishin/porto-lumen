<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class ModelMakeCommand extends GeneratorCommand
{
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
    protected string $type = 'Model';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Models';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/model.stub');
    }
}
