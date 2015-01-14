<?php

return array(
    'multi' => array(
        'admin' => array(
            'driver' => 'eloquent',
            'model' => 'AdminUser'
        ),
        'company' => array(
            'driver' => 'eloquent',
            'model' => 'Company'
        ),
        'user' => array(
            'driver' => 'eloquent',
            'model' => 'User',
        ),
    ),
    'reminder' => array(
        'email' => 'emails.auth.reminder',
        'table' => 'password_reminders',
        'expire' => 60,
    ),
);
