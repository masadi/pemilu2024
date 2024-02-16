<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Console\Commands\SedotWilayah;
use App\Console\Commands\SedotKpu;
use App\Models\Wilayah;

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
        $schedule->command('sedot:wilayah')->hourly();
        $schedule->command('sedot:kpu 11')->hourly();
        $schedule->command('sedot:kpu 12')->hourly();
        $schedule->command('sedot:kpu 13')->hourly();
        $schedule->command('sedot:kpu 14')->hourly();
        $schedule->command('sedot:kpu 15')->hourly();
        $schedule->command('sedot:kpu 16')->hourly();
        $schedule->command('sedot:kpu 17')->hourly();
        $schedule->command('sedot:kpu 18')->hourly();
        $schedule->command('sedot:kpu 19')->hourly();
        $schedule->command('sedot:kpu 21')->hourly();
        $schedule->command('sedot:kpu 31')->hourly();
        $schedule->command('sedot:kpu 32')->hourly();
        $schedule->command('sedot:kpu 33')->hourly();
        $schedule->command('sedot:kpu 34')->hourly();
        $schedule->command('sedot:kpu 35')->hourly();
        $schedule->command('sedot:kpu 36')->hourly();
        $schedule->command('sedot:kpu 51')->hourly();
        $schedule->command('sedot:kpu 52')->hourly();
        $schedule->command('sedot:kpu 53')->hourly();
        $schedule->command('sedot:kpu 61')->hourly();
        $schedule->command('sedot:kpu 62')->hourly();
        $schedule->command('sedot:kpu 63')->hourly();
        $schedule->command('sedot:kpu 64')->hourly();
        $schedule->command('sedot:kpu 65')->hourly();
        $schedule->command('sedot:kpu 71')->hourly();
        $schedule->command('sedot:kpu 72')->hourly();
        $schedule->command('sedot:kpu 73')->hourly();
        $schedule->command('sedot:kpu 74')->hourly();
        $schedule->command('sedot:kpu 75')->hourly();
        $schedule->command('sedot:kpu 76')->hourly();
        $schedule->command('sedot:kpu 81')->hourly();
        $schedule->command('sedot:kpu 82')->hourly();
        $schedule->command('sedot:kpu 91')->hourly();
        $schedule->command('sedot:kpu 92')->hourly();
        $schedule->command('sedot:kpu 93')->hourly();
        $schedule->command('sedot:kpu 94')->hourly();
        $schedule->command('sedot:kpu 95')->hourly();
        $schedule->command('sedot:kpu 96')->hourly();
        $schedule->command('sedot:kpu 99')->hourly();
        // $schedule->command('inspire')->hourly();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
