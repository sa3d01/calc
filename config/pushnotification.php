<?php
/**
 * @see https://github.com/Edujugon/PushNotification
 */

return [
    'gcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'My_ApiKey',
    ],
    'fcm' => [
        'priority' => 'normal',
        'dry_run' => false,
        'apiKey' => 'AAAAZFO9N5A:APA91bHE5RG-EniUqgZgv3zIIiapopJGLIc_l5G8bs0bja5_hnwnyx0vERYLQGm5rc2i2cVCagh8LrnczvIoWnetmcibE9-uUVt2VLyUGjbJwh8-Owb6DON76NVJGo_eqpbZozC82kvK',
    ],
    'apn' => [
        'certificate' => __DIR__ . '/iosCertificates/apns-dev-cert.pem',
        'passPhrase' => 'secret', //Optional
        'passFile' => __DIR__ . '/iosCertificates/yourKey.pem', //Optional
        'dry_run' => true,
    ],
];
