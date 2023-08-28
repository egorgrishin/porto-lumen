<?php

namespace Core\Kernels;

use Core\Commands\MakeActionCommand;
use Core\Commands\MakeDtoCommand;
use Core\Commands\MakeFactoryCommand;
use Core\Commands\MakeMiddlewareCommand;
use Core\Commands\MakeMigrationCommand;
use Core\Commands\MakeSeederCommand;
use Core\Commands\MakeSubActionCommand;
use Core\Commands\MakeCastCommand;
use Core\Commands\MakeConsoleCommand;
use Core\Commands\MakeControllerCommand;
use Core\Commands\MakeEventCommand;
use Core\Commands\MakeExceptionCommand;
use Core\Commands\MakeJobCommand;
use Core\Commands\MakeListenerCommand;
use Core\Commands\MakeModelCommand;
use Core\Commands\MakeObserverCommand;
use Core\Commands\MakeProviderCommand;
use Core\Commands\MakeRequestCommand;
use Core\Commands\MakeResourceCommand;
use Core\Commands\MakeRouteCommand;
use Core\Commands\MakeRuleCommand;
use Core\Commands\MakeScopeCommand;
use Core\Commands\MakeTaskCommand;
use Core\Commands\MakeTestCommand;
use Core\Commands\SeedCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application
     */
    protected $commands = [
        MakeActionCommand::class,
        MakeCastCommand::class,
        MakeConsoleCommand::class,
        MakeControllerCommand::class,
        MakeDtoCommand::class,
        MakeEventCommand::class,
        MakeExceptionCommand::class,
        MakeFactoryCommand::class,
        MakeJobCommand::class,
        MakeListenerCommand::class,
        MakeMiddlewareCommand::class,
        MakeMigrationCommand::class,
        MakeModelCommand::class,
        MakeObserverCommand::class,
        MakeProviderCommand::class,
        MakeRequestCommand::class,
        MakeResourceCommand::class,
        MakeRouteCommand::class,
        MakeRuleCommand::class,
        MakeScopeCommand::class,
        MakeSeederCommand::class,
        MakeSubActionCommand::class,
        MakeTaskCommand::class,
        MakeTestCommand::class,

        SeedCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
