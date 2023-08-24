<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\CoreGeneratorCommand;

class MakeRuleCoreCommand extends CoreGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:rule:core';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Rule';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Rules';

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path('app/Core/Stubs/rule.stub');
    }
}
