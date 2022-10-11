<?php

namespace App\Constants;

/**
 * Class EventConstant
 * @package App\Constants
 */
class EventConstant
{
    //  Basic Firearm Safety Course (Get MA  LTC Gun License)
	const BASIC_FIREARM_SAFETY_COURSE = 1;

    //	The Multi-License Firearm Course (BEST)--39 State Carry License----MA,RI.FL,ME,NH,CT
    const MULTI_LICENSE_FIREARM_COURSE = 2;

    // Brookline Qualification Test
    const BROOKLINE_QUALIFICATION = 3;

    // Private Shooting Lessons
    const PRIVATE_SHOOTING_LESSONS = 4;

    // Intro To Shooting
    const INTRO_TO_SHOOTING = 5;

    // Learn To Shoot 2
	const LEARN_TO_SHOOT_2 = 6;

	// Intro To The AR-15
    const INTRO_TO_AR_15 = 7;

    // Range Memberships
    const RANGE_MEMBERSHIPS = 8;

    // Active Shooter Response Training
    const ACTIVE_SHOOTER_RESPONSE_TRAINING = 9;

    // Self Defense And Fitness
    const SELF_DEFENSE_FITNESS = 10;

    // Law And Mastery Of Self Defense (Online Course)
    const LAW_MASTERY_SELF_DEFENSE = 11;

    // Intro To Force-On-Force 1
    const INTRO_TO_FORCE_ON_FORCE = 12;

    // Boston Tactical
    const BOSTON_TACTICAL = 13;

    // Concealed Carry 2 (Cover And Concealment)
	const CONCEALED_CARRY_2 = 14;

    // Tactical Firearms Training Boston
	const TACTICAL_FIREARMS_TRAINING_BOSTON = 15;

    // Basic Firearms Safety Course Live Fire Shooting
	const BASIC_FIREARMS_SAFETY_LIVE_FIRE = 16;

    // Armed Defense Of The Home 1 (Shoot House)
	const ARMED_DEFENSE_HOME = 17;

    // RI Qualification Test
    const RI_QUALIFICATION_TEST = 18;

    // Concealed Carry 1 (Not A License Class)
    const CONCEALED_CARRY = 19;

    const TITLE = [
        self::BASIC_FIREARM_SAFETY_COURSE => 'Basic Firearm Safety Course (Get MA  LTC Gun License)',
        self::MULTI_LICENSE_FIREARM_COURSE => 'The Multi-License Firearm Course (BEST)--39 State Carry License----MA,RI.FL,ME,NH,CT',
        self::BROOKLINE_QUALIFICATION => 'The Multi-License Firearm Course (BEST)--39 State Carry License----MA,RI.FL,ME,NH,CT',
        self::PRIVATE_SHOOTING_LESSONS => 'Private Shooting Lessons',
        self::INTRO_TO_SHOOTING => 'Intro To Shooting',
        self::LEARN_TO_SHOOT_2 => 'Learn To Shoot 2',
        self::INTRO_TO_AR_15 => 'Intro To The AR-15',
        self::RANGE_MEMBERSHIPS => 'Range Memberships',
        self::ACTIVE_SHOOTER_RESPONSE_TRAINING => 'Active Shooter Response Training',
        self::SELF_DEFENSE_FITNESS => 'Self Defense And Fitness',
        self::LAW_MASTERY_SELF_DEFENSE => 'Law And Mastery Of Self Defense (Online Course)',
        self::INTRO_TO_FORCE_ON_FORCE => 'Intro To Force-On-Force 1',
        self::BOSTON_TACTICAL => 'Boston Tactical',
        self::CONCEALED_CARRY_2 => 'Concealed Carry 2 (Cover And Concealment)',
        self::TACTICAL_FIREARMS_TRAINING_BOSTON => 'Tactical Firearms Training Boston',
        self::BASIC_FIREARMS_SAFETY_LIVE_FIRE => 'Basic Firearms Safety Course Live Fire Shooting',
        self::ARMED_DEFENSE_HOME => 'Armed Defense Of The Home 1 (Shoot House)',
        self::RI_QUALIFICATION_TEST => 'RI Qualification Test',
        self::CONCEALED_CARRY => 'Concealed Carry 1 (Not A License Class)',
    ];
}
