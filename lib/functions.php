<?php
/**
 * Language Selector
 * @package lang_selector 
 *
 * Functions for the language selector
 */

/**
 * Returns the translations that are allowed to be used
 * 
 * @return array
 */
function lang_selector_get_allowed_translations($output = "array") {
	$configured_allowed = elgg_get_plugin_setting("allowed_languages", "lang_selector");

	$allowed = [];
	if (empty($configured_allowed)) {
		$installed_languages = lang_selector_get_installed_translations();
		foreach ($installed_languages as $lang_id => $lang_description) {	
			$allowed[] = $lang_id;
		}
	} 
	else {
		$allowed = string_to_tag_array($configured_allowed);
	}

	if ($output === "string") {
		return implode(",",$allowed);
	}

	return $allowed;
}

/**
 * Sets the language for the logged out user
 *
 * @return void
 */
function lang_selector_set_logged_out_user_language() {
	if (elgg_is_logged_in()) {
		return;
	}
	
	if (!empty($_COOKIE['client_language'])) {
		// switched with language selector
		$new_lang = $_COOKIE['client_language'];
	} else {
		// error_log("1111111");
		$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
		
		if (!empty($browserlang && elgg_get_plugin_setting("autodetect", "lang_selector") == "yes")) {
			$new_lang = $browserlang;
		}
	}
	$current_language = elgg()->translator->getCurrentLanguage();

	if (!empty($new_lang) && ($new_lang !== $current_language)) {
		$allowed = lang_selector_get_allowed_translations();
		if (in_array($new_lang, $allowed)) {
			// set new language
			elgg()->translator->setCurrentLanguage($new_lang);

			// language has been change; reload language keys
			if (elgg_is_active_plugin("translation_editor")) {
				translation_editor_load_translations();
			} else {
				elgg()->translator->reloadAllTranslations();
			}
		}
	}
}


/**
 * Return an array of installed translations as an associative
 * array "two letter code" => "native language name".
 *
 * @param boolean $calculate_completeness Set to true if you want a completeness postfix added to the language text
 *
 * @return array
 */
function lang_selector_get_installed_translations($calculate_completeness = false) {
	// return elgg()->translator->getInstalledTranslations($calculate_completeness);
	return array_flip(elgg()->translator->getAllowedLanguages());
}

/**
 * Return the level of completeness for a given language code (compared to english)
 *
 * @param string $language Language
 *
 * @return int
 */
function lang_selector_get_language_completeness($language) {
	return elgg()->translator->getLanguageCompleteness($language);
}
