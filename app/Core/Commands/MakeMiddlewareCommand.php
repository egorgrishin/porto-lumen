<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeMiddlewareCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:middleware';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:middleware {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new middleware class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Middleware';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Middleware';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/middleware.stub');
    }
}
