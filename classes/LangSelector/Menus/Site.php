<?php
/**
 * Language Selector
 * @package lang_selector 
 */

 namespace LangSelector\Menus;

 use LangSelector\LangSelectorOptions;

/**
 * Event callbacks for menus
 *
 * @since 4.0
 *
 * @internal
 */
class Site {

	/**
	 * Alter url on site and footer menu
	 *
	 * @param \Elgg\Hook $hook 'register', 'menu:site' or 'menu:footer'
	 *
	 * @return ElggMenuItem[]
	 */
	public static function register(\Elgg\Hook $hook) {
		$return = $hook->getValue();
			
    	if (!LangSelectorOptions::isLangRewriteURLEnabled()) {
			return $return;
		}

		$default_lang = elgg_get_config('language');
		$current_lang = get_current_language();
		
		$site_url = elgg_get_site_url();
		$new_url_prefix = $site_url.$current_lang."/";
		foreach ($return as $item) {
			$current_url = $item->getHref();
			$new_url = str_replace($site_url,$new_url_prefix,$current_url);
			$item->setHref($new_url);
		}
		
		return $return;
	}
}
