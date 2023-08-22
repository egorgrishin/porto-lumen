<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\CoreGeneratorCommand;

class MakeConsoleCommand extends CoreGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:command';

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
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/console.stub');
    }
}
