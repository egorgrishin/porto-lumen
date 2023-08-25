<?php

namespace Core\Commands;

use Core\Parents\BaseCommand;
use Illuminate\Console\ConfirmableTrait;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\ConnectionResolverInterface as Resolver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class SeedCommand extends BaseCommand
{
    use ConfirmableTrait;

    /**
     * The console command name.
     */
    protected $name = 'db:seed';

    /**
     * The console command description.
     */
    protected $description = 'Seed the database with records';

    /**
     * The connection resolver instance.
     */
    protected Resolver $resolver;

    /**
     * Create a new database seed command instance.
     */
    public function __construct(Resolver $resolver)
    {
        parent::__construct();
        $this->resolver = $resolver;
    }

    /**
     * Execute the console command.
     * @throws BindingResolutionException
     */
    public function handle(): int
    {
        if (!$this->confirmToProceed()) {
            return 1;
        }

        $this->components->info('Seeding database.');
        $previous_connection = $this->resolver->getDefaultConnection();
        $this->resolver->setDefaultConnection($this->getDatabase());

        Model::unguarded(function () {
            $this->getSeeder()->__invoke();
        });

        if ($previous_connection) {
            $this->resolver->setDefaultConnection($previous_connection);
        }

        return 0;
    }

    /**
     * Get a seeder instance from the container.
     * @throws BindingResolutionException
     */
    protected function getSeeder(): Seeder
    {
        $class = $this->input->getArgument('class') ?? $this->input->getOption('class');

        if (!str_contains($class, '\\')) {
            $class = 'Core\\Data\\Seeders\\' . $class;
        }

        if ($class === 'Database\\Seeders\\DatabaseSeeder' && !class_exists($class)) {
            $class = 'DatabaseSeeder';
        }

        return $this->laravel
            ->make($class)
            ->setContainer($this->laravel)
            ->setCommand($this);
    }

    /**
     * Get the name of the database connection to use.
     */
    protected function getDatabase(): string
    {
        $database = $this->input->getOption('database');
        return $database ?: $this->laravel['config']['database.default'];
    }

    /**
     * Get the console command arguments.
     */
    protected function getArguments(): array
    {
        return [
            ['class', InputArgument::OPTIONAL, 'The class name of the root seeder', null],
        ];
    }

    /**
     * Get the console command options.
     */
    protected function getOptions(): array
    {
        return [
            ['class', null, InputOption::VALUE_OPTIONAL, 'The class name of the root seeder', 'Core\\Data\\Seeders\\DatabaseSeeder'],
            ['database', null, InputOption::VALUE_OPTIONAL, 'The database connection to seed'],
            ['force', null, InputOption::VALUE_NONE, 'Force the operation to run when in production'],
        ];
    }
}
