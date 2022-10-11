<?php

return [

    'course_location' => env('COURSE_LOCATION', 'Boston Firearms'),

    'classes' => [
        'featured_events' => [
            'basic' => [
                'id' => 1,
                'template'
            ]
        ],
    ],

    'event' => [
        'basic' => env('EVENT_BASIC', 1),
        'multi' => env('EVENT_MULTI', 2),
    ],
];
