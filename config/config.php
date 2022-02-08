<?php
$config = [
    'EMAIL_CLIENT' => '',
    'NAMA_CLIENT' => '',
    'SITE_URL' => 'https://javacode.ngodingin.com/api/',
    'SITE_IMG' => 'https://javacode.ngodingin.com/img/',
    'PATH_IMG' => '../img/',
    // 'TELEGRAM_CHANNEL' => '-725536947',
    // 'TELEGRAM_LOG' => true,
    'DB' => [
        'db' => [
            'DB_HOST' => 'localhost',
            'DB_USER' => 'javacodeapp_cafe',
            'DB_PASS' => 'GMIqz?VM~W}d',
            'DB_NAME' => 'javacodeapp',
            'DB_CHARSET' => 'utf8',
            'CREATED_USER' => 'created_by',
            'CREATED_TIME' => 'created_at',
            'CREATED_TYPE' => 'int',
            'MODIFIED_USER' => 'modified_by',
            'MODIFIED_TIME' => 'modified_at',
            'MODIFIED_TYPE' => 'int',
            'DISPLAY_ERRORS' => true, #error db
            'USER_ID' => isset($_SESSION['user']['id_user']) ? $_SESSION['user']['id_user'] : 0,
            'USER_NAMA' => isset($_SESSION['user']['nama']) ? $_SESSION['user']['nama'] : 'User belum disetting',
            'USER_LOG' => true,
            'LOG_FOLDER' => 'userlog',
        ],
    ],
    'DISPLAY_ERROR' => true, #error php
];
