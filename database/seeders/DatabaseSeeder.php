<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(SuperAdminSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(InstructorSeeder::class);
        $this->call(PathSignatureSeeder::class);
        $this->call(NotificationEventsSeeder::class);
        $this->call(SetWebhookWaiver::class);
        $this->call(EventsWaiverSeeder::class);
    }
}
