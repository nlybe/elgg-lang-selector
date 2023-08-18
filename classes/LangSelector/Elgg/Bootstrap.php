<?php
/**
 * Language Selector
 * @package lang_selector 
 */

namespace LangSelector\Elgg;

use Elgg\DefaultPluginBootstrap;
use LangSelector\LangSelectorOptions;

class Bootstrap extends DefaultPluginBootstrap {
	
	const HANDLERS = [];	
	
	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->initViews();
	}

	/**
	 * Executed during 'plugin_boot:before', 'system' event
	 *
	 * Allows the plugin to register handlers for 'plugin_boot', 'system' and 'init', 'system' events,
	 * as well as implement boot time logic
	 *
	 * @return void
	 */
	public function boot() {

		lang_selector_set_logged_out_user_language();
		elgg_extend_view("css/elgg", "lang_selector/css/site");

		if (LangSelectorOptions::isLangRewriteURLEnabled())	{ 
			$default_lang = elgg_get_config('language');
			$allowed_langs = lang_selector_get_allowed_translations();
			
			if (is_array($allowed_langs) && count($allowed_langs)>0) {
				foreach ($allowed_langs as $lang) {
					elgg_register_plugin_hook_handler('route:rewrite', $lang, \LangSelector\ConfigureLangRewriteURL::class);
				}
			}
		}
	}

	/**
	 * Init views
	 *
	 * @return void
	 */
	protected function initViews() {

		// register settings js
		elgg_register_simplecache_view('lang_selector/settings.js');
		
	}

}
