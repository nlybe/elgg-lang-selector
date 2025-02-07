<?php
/**
 * Language Selector
 * @package lang_selector 
 */

use LangSelector\LangSelectorOptions;

$new_lang_id = get_input("lang_id");
$installed = lang_selector_get_installed_translations();

if (!empty($new_lang_id) && array_key_exists($new_lang_id, $installed)) {
	if ($user = elgg_get_logged_in_user_entity()) {
		
		$user->language = $new_lang_id;
		$user->save();
		
		// let other plugins know we updated the language
		elgg_trigger_event("update", "language", $user);

		if (LangSelectorOptions::isLangRewriteURLEnabled() && isset($_SERVER['HTTP_REFERER']))	{ 
			$newURL = LangSelectorOptions::alterLangURL($_SERVER['HTTP_REFERER'], $new_lang_id);
			if ($newURL) {
				$output = [
					'forward' => $newURL,
				];
				return elgg_ok_response($output, '', $newURL);		
				// forward(elgg_normalize_url($newURL));
			}
		}
	}	
}

return elgg_ok_response('', '', REFERRER);
	