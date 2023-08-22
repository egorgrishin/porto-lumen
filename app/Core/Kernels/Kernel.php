<?php

namespace Core\Kernels;

use Core\Commands\ControllerMakeCommand;
use Core\Commands\ModelMakeCommand;
use Illuminate\Console\Scheduling\Schedule;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application
     */
    protected $commands = [
        ControllerMakeCommand::class,
        ModelMakeCommand::class,
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        //
    }
}
