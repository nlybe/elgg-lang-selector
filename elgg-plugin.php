<?php
/**
 * Language Selector
 * @package lang_selector 
 */

use LangSelector\Elgg\Bootstrap;

require_once(dirname(__FILE__) . '/lib/events.php');
require_once(dirname(__FILE__) . '/lib/functions.php');

return [
	'plugin' => [
        'name' => 'Language Selector',
		'version' => '5.1',
		'dependencies' => [
			'translation_editor' => [
				'must_be_active' => false,
			],
		],
	],
    'bootstrap' => Bootstrap::class,
	'actions' => [
		'lang_selector/change' => ['access' => 'public'],
	],
	'events' => [
		'ready' => [
			'system' => [
				'lang_selector_pagesetup' => [],
			],
		],
		'register' => [
			'menu:site' => [
				'LangSelector\Menus\Site::register' => [
					'priority' => 99999
				],
			],
			'menu:footer' => [
				'LangSelector\Menus\Site::register' => [
					'priority' => 99999
				],
			],
		],
	],
    'settings' => [
        'show_in_header' => 'yes',
        'autodetect' => 'yes',
        'show_images' => 'yes',
		'url_rewrite' => 'no',
	],
	'view_extensions' => [
		'elgg.css' => [
			'lang_selector/lang_selector.css' => [],
		],
	],
];
