<?php

namespace App\Console;

use Log;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */

    protected $commands = [
        Commands\BackupCron::class,
        Commands\SendSMS::class,
        Commands\DeleteSentMessages::class,
    ];

    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
        Log::info('Cron job is execute at ' . Carbon::now('Asia/Karachi'));
        // $schedule->command('send:sms')->hourly();

        $schedule->command('backup:cron')->everyTwoHours()
                    ->timezone('Asia/Karachi')
                    ->emailOutputTo('zaffar@ajwagardens-cms.com')
                    ->emailOutputOnFailure('zaffar@ajwagardens-cms.com');

        $schedule->command('send:sms')->everyMinute()
                    ->timezone('Asia/Karachi');

        $schedule->command('delete:sms')->dailyAt("00:00")
                    ->timezone('Asia/Karachi');                  

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
