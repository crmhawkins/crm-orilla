<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Models\Reserva;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderMail;
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
        $schedule->call(function () {
            $reservations = Reserva::whereDate('fecha', now()->addDay())->get(); // Asumiendo que tienes un modelo Reservation

            foreach ($reservations as $reservation) {
                Mail::to($reservation->email_cliente)->send(new ReservationReminderMail($reservation));
            }
        })->everyMinute();
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
