<?php

namespace Core\Commands;

use Core\Parents\BaseCommand;
use Exception;
use Illuminate\Contracts\Console\PromptsForMissingInput;
use Illuminate\Database\Console\Migrations\TableGuesser;
use Illuminate\Database\Migrations\MigrationCreator;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class MakeMigrationCommand extends BaseCommand implements PromptsForMissingInput
{
    /**
     * The console command signature.
     */
    protected $signature = 'make:migration
        {name : The name of the migration}
        {section : The name of the section}
        {module : The name of the module}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new migration file';

    /**
     * The migration creator instance.
     */
    protected MigrationCreator $creator;

    /**
     * Create a new migration install command instance.
     */
    public function __construct(MigrationCreator $creator)
    {
        parent::__construct();
        $this->creator = $creator;
    }

    /**
     * Execute the console command.
     * @throws Exception
     */
    public function handle(): void
    {
        // It's possible for the developer to specify the tables to modify in this
        // schema operation. The developer may also specify if this table needs
        // to be freshly created, so we can create the appropriate migrations.
        $name = Str::snake(trim($this->input->getArgument('name')));

        // Next, we will attempt to guess the table name if this the migration has
        // "create" in the name. This will allow us to provide a convenient way
        // of creating migrations that create new tables for the application.
        [$table, $create] = TableGuesser::guess($name);

        // Now we are ready to write the migration out to disk. Once we've written
        // the migration out, we will dump-autoload for the entire framework to
        // make sure that the migrations are registered by the class loaders.
        $this->writeMigration($name, $table, $create);
    }

    /**
     * Write the migration file to disk.
     * @throws Exception
     */
    protected function writeMigration(string $name, string $table, bool $create): void
    {
        $path = $this->getMigrationPath();
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $this->creator->create(
            $name, $path, $table, $create
        );

        $this->components->info(sprintf('Migration [%s] created successfully.', $file));
    }

    /**
     * Get migration path.
     */
    protected function getMigrationPath(): string
    {
        $section = trim($this->input->getArgument('section'));
        $module = trim($this->input->getArgument('module'));
        $path = $this->laravel->basePath();

        return "$path/app/Sections/$section/$module/Data/Migrations";
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration'],
            ['section', InputArgument::REQUIRED, 'The name of the section'],
            ['module', InputArgument::REQUIRED, 'The name of the module'],
        ];
    }

    /**
     * Prompt for missing input arguments using the returned questions.
     */
    protected function promptForMissingArgumentsUsing(): array
    {
        return [
            'name'    => 'What should the migration be named?',
            'section' => 'Section name:',
            'module'  => 'Module name:',
        ];
    }

}
