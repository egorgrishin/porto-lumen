<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;

class MakeSeederCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:seeder';

    /**
     * The console command description.
     */
    protected $description = 'Create a new seeder class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Seeder';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Data/Seeders';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core = false;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/seeder.stub');
    }
}
