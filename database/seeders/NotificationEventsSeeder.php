<?php

namespace Database\Seeders;

use App\Constants\NotificationEventsConstant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationEventsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = DB::table('notification_events')->upsert([

            [
                'id' => NotificationEventsConstant::COMPLETED_QUIZ_FORM,
                'name' => NotificationEventsConstant::NAME[NotificationEventsConstant::COMPLETED_QUIZ_FORM],
                'slug' => NotificationEventsConstant::SLUG[NotificationEventsConstant::COMPLETED_QUIZ_FORM],
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => NotificationEventsConstant::ABANDONED_CHECKOUT,
                'name' => NotificationEventsConstant::NAME[NotificationEventsConstant::ABANDONED_CHECKOUT],
                'slug' => NotificationEventsConstant::SLUG[NotificationEventsConstant::ABANDONED_CHECKOUT],
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => NotificationEventsConstant::COMPLETED_PURCHASE,
                'name' => NotificationEventsConstant::NAME[NotificationEventsConstant::COMPLETED_PURCHASE],
                'slug' => NotificationEventsConstant::SLUG[NotificationEventsConstant::COMPLETED_PURCHASE],
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => NotificationEventsConstant::CHANGED_CLASS,
                'name' => NotificationEventsConstant::NAME[NotificationEventsConstant::CHANGED_CLASS],
                'slug' => NotificationEventsConstant::SLUG[NotificationEventsConstant::CHANGED_CLASS],
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'id' => NotificationEventsConstant::ATTENDED_CLASS,
                'name' => NotificationEventsConstant::NAME[NotificationEventsConstant::ATTENDED_CLASS],
                'slug' => NotificationEventsConstant::SLUG[NotificationEventsConstant::ATTENDED_CLASS],
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ], ['id'], ['name', 'slug', 'created_at', 'updated_at']);

        echo "Rows: $rows\n";
    }
}
