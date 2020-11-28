<?php

return [
    'definitions' => [],
    'singletons' => [
        'app\services\FileService' => [
            'class' => 'app\services\FileService',
            'path' => '@app/files',
        ],
        'app\services\UserESignService' => [
            'class' => 'app\services\UserESignService',
            'pathCA' => '@app/keys/CA',
            'userKeyPath' => '@app/keys/user',
        ],
    ],
];
