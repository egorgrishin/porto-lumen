<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\SectionGeneratorCommand;

class MakeExceptionCommand extends SectionGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:exception';

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
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/exception.stub');
    }
}
