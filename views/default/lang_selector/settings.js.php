<?php
/**
 * Language Selector
 * @package lang_selector 
 */

use LangSelector\LangSelectorOptions;

$settings = [
    'url_rewrite' => LangSelectorOptions::isLangRewriteURLEnabled(),
    'allowed_languages' => lang_selector_get_allowed_translations("string"),
];

?>

define(<?php echo json_encode($settings); ?>);
