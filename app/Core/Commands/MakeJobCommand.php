<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeJobCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:job';

    /**
     * The name and signature of the console command.
     */
    protected $signature = 'make:job {name} {--core}';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Job';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Jobs';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/job.stub');
    }
}
