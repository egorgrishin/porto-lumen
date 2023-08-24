<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeRequestCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:request';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:request {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Request';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Requests';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/request.stub');
    }
}
