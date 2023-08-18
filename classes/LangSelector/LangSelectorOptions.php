<?php
/**
 * Language Selector
 * @package lang_selector 
 */

namespace LangSelector; 

class LangSelectorOptions {

    const PLUGIN_ID = 'lang_selector';    // current plugin ID

    /**
     * Check language routing is enabled
     * 
     * @return boolean
     */
    Public Static function isLangRewriteURLEnabled(): bool {
        $get_param = trim(elgg_get_plugin_setting('url_rewrite', self::PLUGIN_ID));
        if ($get_param === 'yes') {
            return true;
        }
            
        return false;
    } 

    /**
     * Check language routing is enabled
     * 
     * @return boolean
     */
    Public Static function alterLangURL($refURL = null, $new_lang_id = null): string {
        $new_lang_id = $new_lang_id? $new_lang_id : elgg_get_config('language');

        if ($refURL) {
            $path_arr = explode("/", parse_url($refURL, PHP_URL_PATH));
            array_shift($path_arr);         # remove the 1st empty element

            $old_lang_id = $path_arr[0];
            $allowed_langs = lang_selector_get_allowed_translations();
            if (in_array($old_lang_id, $allowed_langs, true)) {   # need to confirm that the 1st element in path is a lang_id
                $path_arr[0] = $new_lang_id;    # replace lang in path
                $path = implode("/",$path_arr);
                $url_query = parse_url($refURL, PHP_URL_QUERY)? "?".parse_url($refURL, PHP_URL_QUERY) : "";
    
                return $path.$url_query;
            }
        }

        return "";
    }     
}
