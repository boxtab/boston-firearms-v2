<?php

namespace Database\Seeders;

use App\Constants\EventConstant;
use App\Models\Event;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EventsWaiverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Event::on()->where('id', '=', EventConstant::BASIC_FIREARM_SAFETY_COURSE)
            ->update(['waiver' => 'Basic Firearm Safety Course']);

        Event::on()->where('id', '=', EventConstant::INTRO_TO_SHOOTING)
            ->update(['waiver' => 'Intro to shooting 1']);

        Event::on()->where('id', '=', EventConstant::PRIVATE_SHOOTING_LESSONS)
            ->update(['waiver' => 'Private Shooting Lesson']);

        Event::on()->where('id', '=', EventConstant::MULTI_LICENSE_FIREARM_COURSE)
            ->update(['waiver' => 'Multi License course']);

        Event::on()->where('id', '=', EventConstant::CONCEALED_CARRY_2)
            ->update(['waiver' => 'Conceal carry']);

        Event::on()->where('id', '=', EventConstant::SELF_DEFENSE_FITNESS)
            ->update(['waiver' => 'Self defense and Fitness']);

        Event::on()->where('id', '=', EventConstant::LEARN_TO_SHOOT_2)
            ->update(['waiver' => 'Intro to shooting 2']);

        Event::on()->where('id', '=', EventConstant::SELF_DEFENSE_FITNESS)
            ->update(['waiver' => 'Self Defense-Fitness']);
    }
}
