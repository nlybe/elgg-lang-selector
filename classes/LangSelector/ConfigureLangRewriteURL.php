<?php
/**
 * Language Selector
 * @package lang_selector 
 */

namespace LangSelector;

class ConfigureLangRewriteURL {

	/**
	 * Set captcha gatekeeper for actions
	 *
	 * @param Event $event Event
	 *
	 * @return array
	 * @throws \DI\DependencyException
	 * @throws \DI\NotFoundException
	 */
	public function __invoke(\Elgg\Event $event) {
		// $default_lang = elgg_get_config('language');
		// $allowed_langs = lang_selector_get_allowed_translations();
		// $current_lang = elgg_get_current_language();
 
		$return = $event->getValue();	
    	if (!LangSelectorOptions::isLangRewriteURLEnabled()) {
			return $return;
		}

		$default_lang = elgg_get_config('language');
		$allowed_langs = lang_selector_get_allowed_translations();
		$identifier = $return['identifier'];

		if (in_array($identifier, $allowed_langs, true)) {
			if (is_array($return['segments']) && count($return['segments']) > 0) {
				$return['identifier'] = $return['segments'][0];
				array_shift($return['segments']);
			}
			else {
				$return['identifier'] = '';
			}

			// set new language
			elgg()->translator->setCurrentLanguage($identifier);

			// language has been change; reload language keys
			if (elgg_is_active_plugin("translation_editor")) {
				translation_editor_load_translations();
			} else {
				elgg()->translator->reloadAllTranslations();
			}
		}
		
		return $return;
	}
}