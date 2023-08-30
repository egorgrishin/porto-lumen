<?php

namespace Core\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Filesystem\Filesystem;

class MigrationTableCommand extends Command
{
    /**
     * The console command name
     */
    protected $name = 'queue:table';

    /**
     * The console command description.
     */
    protected $description = 'Create a migration for the queue jobs database table';

    /**
     * The filesystem instance.
     */
    protected Filesystem $files;

    /**
     * Create a new queue job table command instance.
     */
    public function __construct(Filesystem $files)
    {
        parent::__construct();
        $this->files = $files;
    }

    /**
     * Execute the console command.
     * @throws FileNotFoundException
     */
    public function handle(): void
    {
        $table = $this->laravel['config']['queue.connections.database.table'];

        $this->replaceMigration(
            $this->createBaseMigration($table), $table
        );

        $this->components->info('Migration created successfully.');
    }

    /**
     * Create a base migration file for the table.
     */
    protected function createBaseMigration(string $table = 'jobs'): string
    {
        return $this->laravel['migration.creator']->create(
            'create_' . $table . '_table', $this->laravel->databasePath('Migrations')
        );
    }

    /**
     * Replace the generated migration with the job table stub.
     * @throws FileNotFoundException
     */
    protected function replaceMigration(string $path, string $table): void
    {
        $stub = str_replace(
            '{{table}}',
            $table,
            $this->files->get(base_path('app/Core/Stubs/jobs.stub')),
        );

        $this->files->put($path, $stub);
    }
}
