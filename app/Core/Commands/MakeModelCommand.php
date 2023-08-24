<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;

class MakeModelCommand extends GeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:model';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Model';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Models';

    /**
     * Create a class in the core or section
     */
    protected bool $is_core = false;

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path($this->option('pivot')
            ? 'app/Core/Stubs/model.pivot.stub'
            : 'app/Core/Stubs/model.stub'
        );
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['pivot', 'p', InputOption::VALUE_NONE, 'Indicates if the generated model should be a custom intermediate table model'],
        ];
    }
}
