<?php

return [
	'api_url' => [
		'xtype' => 'textfield',
		'value' => 'https://api.telegram.org/bot',
		'area' => 'darttelegram_main',
	],
	'parse_mode' => [
		'xtype' => 'textfield',
		'value' => 'html',
		'area' => 'darttelegram_main',
	],
    'bot_token' => [
        'xtype' => 'textfield',
        'value' => '',
        'area' => 'darttelegram_main',
    ],
	'order_level' => [
		'xtype' => 'textfield',
		'value' => 'INFO',
		'area' => 'darttelegram_main',
	],
	'order_chunk' => [
		'xtype' => 'textfield',
		'value' => 'tpl.dartTelegram.order',
		'area' => 'darttelegram_main',
	]
];