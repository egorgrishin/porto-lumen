<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\SectionGeneratorCommand;

class MakeControllerCommand extends SectionGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:controller';

    /**
     * The console command description.
     */
    protected $description = 'Create a new controller class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Controller';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Controllers';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/controller.stub');
    }
}
