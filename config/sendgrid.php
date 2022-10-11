<?php

return [
    'api_key' => env('SENDGRID_API_KEY'),
    'email_from' => env('SENDGRID_EMAIL_FROM'),
    'email_admin' => env('SENDGRID_EMAIL_ADMIN'),
    'admin_template_id' => env('SENDGRID_ADMIN_TEMPLATE_ID'),
    'client_template_id' => env('SENDGRID_CLIENT_TEMPLATE_ID'),
    'upcoming_template_id' => env('SENDGRID_UPCOMING_TEMPLATE_ID'),
];
