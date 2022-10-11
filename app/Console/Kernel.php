<?php

namespace App\Console;

use App\Models\Client;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Log;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\NotificationUpcoming::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('notification:upcoming')
            ->dailyAt('8:00');
//            ->everyFiveMinutes();


        /*
        $schedule->call(function() {
            Client::query()->whereHas('appointments', function($query){
                return $query->whereBetween('appointments.start_time', [Carbon::now(), Carbon::now()->addDay()]);
            });
        })->dailyAt('8:00');

        $schedule->call(function() {
            Client::query()->whereHas('appointments', function($query){
                return $query->whereBetween('appointments.start_time', [Carbon::now()->addDay(), Carbon::now()->addDays(2)]);
            });
        })->dailyAt('8:00');
        */
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
