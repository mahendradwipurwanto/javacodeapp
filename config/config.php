<?php
$config = [
    'EMAIL_CLIENT' => '',
    'NAMA_CLIENT' => '',
    'SITE_URL' => 'http://localhost:8080/landa_db/api/',
    'SITE_IMG' => 'http://localhost:8080/landa_db/img/',
    'PATH_IMG' => '../img/',
    // 'TELEGRAM_CHANNEL'  => '-1001489692282',
    // 'TELEGRAM_LOG'      => false,
    'DB' => [
        'db' => [
            'DB_HOST' => 'localhost',
            'DB_USER' => 'root',
            'DB_PASS' => '',
            'DB_NAME' => 'db_landa_toko',
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
            'USER_LOG' => false,
            'LOG_FOLDER' => 'userlog',
        ],
    ],
    'DISPLAY_ERROR' => true, #error php
];

// is_deleted int
// modified_at int
// modified_by 