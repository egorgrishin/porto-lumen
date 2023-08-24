<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeConsoleCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:command';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:command {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Artisan command';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Console command';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Commands';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/console.stub');
    }
}
