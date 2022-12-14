<?php

namespace App\Console;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //Commands\BonoCartera::class,
        //Commands\startPayRentabilidad::class,
        //Commands\DeleteOrden::class,
        //Commands\FutswapCanceled::class,
        Commands\SetRanges::class,
        //Commands\AlertMembershipexpiration::class,
        Commands\AlertLicenseexpiration::class,
        Commands\DeleteBinaryPoints::class,
        Commands\BinaryProfit::class,
        Commands\bonosPamm::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$schedule->command('alert:email')->daily();
        //$schedule->command('delete:orden')->everyMinute();
        $schedule->command('set:ranges')->daily();
        $schedule->command('bonos:pamm')->everyMinute();
        $schedule->command('delete:binary:points')->daily();
        $schedule->command('corte:ganancias:binarias')->daily();

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
