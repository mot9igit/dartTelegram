<?php

return [
    'dartTelegramHook' => [
        'file' => 'formit_hook',
        'description' => 'dartTelegram snippet to send message to telegram',
        'properties' => [
            'dtLevel' => [
                'type' => 'textfield',
                'value' => 'INFO',
            ],
            'dtFields' => [
                'type' => 'textfield',
                'value' => '',
            ],
            'formName' => [
                'type' => 'textfield',
                'value' => '',
            ]
        ],
    ],
];