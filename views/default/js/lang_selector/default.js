/**
 * @module lang_selector/default
 */
define(function (require) {
    var elgg = require('elgg');
    var $ = require('jquery');

	$( function() {
		$(".language-selector-toggle").click(function(e){
			var $elem = $(this);
			if ($elem.is('.elgg-state-selected')) {
				// do not change current language
				return false;
			}

			$elem.siblings().addBack().removeClass('elgg-state-selected');
			$elem.addClass('elgg-state-selected');
			if (!elgg.is_logged_in()) {
				// get plugin settings
				var ls_settings = require("lang_selector/settings");
				var url_rewrite = ls_settings['url_rewrite'];
				var allowed_languages = ls_settings['allowed_languages'];
				let url_forward = document.location.href;
				let new_lang = $elem.data('language');

				e.preventDefault();
				elgg.session.cookie('client_language', new_lang, {expires: 30});

				if (url_rewrite) {
					let url = elgg.parse_url(url_forward);	// ref url
					let path = url.path;
					let path_arr = path.split('/');
					path_arr.shift();						// remove the 1st empty element

					let allowed_languages_arr = allowed_languages.split(',');
					if (allowed_languages_arr.includes(path_arr[0])) {
						path_arr[0] = new_lang;
						let fpath = path_arr.join('/');
						if (url.query) {
							fpath = fpath + "?" + url.query;
						}

						url_forward =elgg.normalize_url(elgg.normalize_url(fpath));
					}
				}

				elgg.forward(url_forward);
			}
		});
	} );
});


