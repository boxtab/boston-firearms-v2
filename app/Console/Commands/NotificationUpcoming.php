<?php

namespace App\Console\Commands;

use App\Models\Booking;
use App\Models\Client;
use App\Notifications\UpcomingAppointment;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NotificationUpcoming extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notification:upcoming';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notification of the upcoming start of classes';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $bookings = Booking::on()->whereHas('appointment', function($query) {
            return $query->whereBetween('appointments.start_time', [Carbon::now(), Carbon::now()->addDays(2)]);
        })->get();

        foreach ($bookings as $booking) {
            $client = $booking->client;
            $client->date_time_class = $booking->appointment->date_time_lesson;
            $client->notify(new UpcomingAppointment);
        }

        return 0;
    }
}
