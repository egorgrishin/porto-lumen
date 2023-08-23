<?php

namespace Core\Commands;

use Core\Classes\Illuminate\Console\SectionGeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Symfony\Component\Console\Input\InputOption;

class MakeTestCommand extends SectionGeneratorCommand
{
    /**
     * The console command name.
     */
    protected $name = 'make:test';

    /**
     * The console command description.
     */
    protected $description = 'Create a new Eloquent model class';

    /**
     * The type of class being generated.
     */
    protected string $type = 'Test';

    /**
     * Name of the class directory.
     */
    protected string $directory = 'Tests';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->setDirectory();
        parent::handle();
    }

    /**
     * Defines the directory by the type of test
     */
    private function setDirectory(): void
    {
        $this->directory .= ($this->option('unit') ? '/Unit' : '/Feature');
    }

    /**
     * Get the stub file for the generator.
     */
    protected function getStub(): string
    {
        return base_path($this->option('unit')
            ? 'app/Core/Stubs/test.unit.stub'
            : 'app/Core/Stubs/test.stub'
        );
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['unit', 'u', InputOption::VALUE_NONE, 'Create a unit test.'],
        ];
    }
}
