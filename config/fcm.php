<?php

return [
    'driver' => env('FCM_PROTOCOL', 'http'),
    'log_enabled' => false,

    'http' => [
        'server_key' => env('FCM_SERVER_KEY', 'AAAAzPzatto:APA91bH1Rb8e4Wocp7PZmP7swNoSLRwJ2a5ENIEL3BldwE4w_n8M3mhYER4xBMsmidX_bkaMSvz4Ik5_qgdNLfkWuPXAu-HEo3gQy2Vkn-igQk54jaOrDC0uh_LXho0XLQFemtseoD8m'),
        'sender_id' => env('FCM_SENDER_ID', '880415520474'),
        'server_send_url' => 'https://fcm.googleapis.com/fcm/send',
        'server_group_url' => 'https://android.googleapis.com/gcm/notification',
        'timeout' => 30.0, // in second
    ],
];
