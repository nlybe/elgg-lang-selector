<?php
/**
 * Language Selector
 * @package lang_selector 
 * 
 * Events for the language selector
 */

/**
 * Extends the header with the language selector
 * 
 * @return void
 */
function lang_selector_pagesetup() {
    if (elgg_get_plugin_setting("show_in_header", "lang_selector") == "yes") {
        elgg_extend_view("page/elements/header", "lang_selector/default");
    }
}