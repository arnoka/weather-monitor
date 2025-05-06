<?php

namespace App\Console;

use App\Models\Setting;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $value = Setting::first()?->value ?? 0;

        if ($value > 0 && $value < 60) {
            $schedule->command('weather:fetch')->cron("*/$value * * * *");
        } elseif ($value >= 60) {
            $schedule->command('weather:fetch')->hourly();
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }


}
