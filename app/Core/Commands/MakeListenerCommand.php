<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\SectionGeneratorCommand;

class MakeListenerCommand extends SectionGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:listener';

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
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/listener.stub');
    }
}
