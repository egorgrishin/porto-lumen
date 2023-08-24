<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeExceptionCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:exception';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:exception {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Exception';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Exceptions';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/exception.stub');
    }
}
