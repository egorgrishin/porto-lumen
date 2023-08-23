<?php

namespace Core\Kernels;

use Core\Commands\MakeConsoleCommand;
use Core\Commands\MakeControllerCommand;
use Core\Commands\MakeEventCommand;
use Core\Commands\MakeExceptionCommand;
use Core\Commands\MakeJobCommand;
use Core\Commands\MakeListenerCommand;
use Core\Commands\MakeModelCommand;
use Core\Commands\MakeObserverCommand;
use Core\Commands\MakeProviderCommand;
use Core\Commands\MakeResourceCommand;
use Core\Commands\MakeTestCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application
     */
    protected $commands = [
        MakeControllerCommand::class,
        MakeEventCommand::class,
        MakeJobCommand::class,
        MakeModelCommand::class,
        MakeListenerCommand::class,
        MakeObserverCommand::class,
        MakeResourceCommand::class,
        MakeProviderCommand::class,
        MakeConsoleCommand::class,
        MakeTestCommand::class,
        MakeExceptionCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
