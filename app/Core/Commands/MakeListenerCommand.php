<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeListenerCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:listener';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:listener {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Listener';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Listeners';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/listener.stub');
    }
}
