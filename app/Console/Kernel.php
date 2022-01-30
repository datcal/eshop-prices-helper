<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('game:get')->everyMinute();
        $schedule->command('game:price')->everyMinute();
        $schedule->command('check:prices')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        #Artisan::call('mail:send 1 --queue=default');
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
