<?php


namespace App\Constants;


class QuizConstants {

    const QUIZ_TYPE_DEFAULT = 'default';
    const QUIZ_TYPE_MULTI_STATE = 'ml';

    const QUIZ_TYPES = [
        self::QUIZ_TYPE_DEFAULT,
        self::QUIZ_TYPE_MULTI_STATE
    ];

    const QUIZ_QUESTION_SESSION_INITIAL = [
        'quizReady' => false,
        'answers' => [],
        'canSchedule'=> false,
        'currentStep' => 0
    ];
}
