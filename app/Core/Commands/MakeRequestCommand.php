<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\SectionGeneratorCommand;

class MakeRequestCommand extends SectionGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:request';

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
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/request.stub');
    }
}
