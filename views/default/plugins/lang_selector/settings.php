<?php
/**
 * Language Selector
 * @package lang_selector 
 */


$plugin_id = elgg_get_plugin_from_id('lang_selector');

echo elgg_view_field([
    '#type' => 'checkbox',
    'name' => 'params[show_in_header]',
    'switch' => true,
    'value' => 'yes',
    'checked' => ($plugin_id->show_in_header === 'yes'),  
    '#label' => elgg_echo('lang_selector:admin:settings:show_in_header'),
]);

echo elgg_view_field([
    '#type' => 'checkbox',
    'name' => 'params[autodetect]',
    'switch' => true,
    'value' => 'yes',
    'checked' => ($plugin_id->autodetect === 'yes'),  
    '#label' => elgg_echo('lang_selector:admin:settings:autodetect'),
]);

echo elgg_view_field([
    '#type' => 'checkbox',
    'name' => 'params[show_images]',
    'switch' => true,
    'value' => 'yes',
    'checked' => ($plugin_id->show_images === 'yes'),  
    '#label' => elgg_echo('lang_selector:admin:settings:show_images'),
]);

echo elgg_view_field([
    '#type' => 'checkbox',
    'name' => 'params[url_rewrite]',
    'default' => 'no',
    'switch' => true,
    'value' => 'yes',
    'checked' => ($plugin_id->url_rewrite === 'yes'),  
    '#label' => elgg_echo('lang_selector:settings:url_rewrite'),
    '#help' => elgg_echo('lang_selector:settings:url_rewrite:help'),
]);
