<?php

namespace Core\Kernels;

use Core\Commands\MakeControllerCommand;
use Core\Commands\MakeEventCommand;
use Core\Commands\MakeJobCommand;
use Core\Commands\MakeModelCommand;
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
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
