# Language Selector

![Elgg 4.3](https://img.shields.io/badge/Elgg-4.3-orange.svg?style=flat-square)

Provides a language selector view to use in your themes.

If you are using a default theme, there is an admin option to extend the header with the language selector.

Check the admin settings of the plugin for things to configure.

This plugin based on [Language Selector by ColdTrick](https://github.com/ColdTrick/language_selector). The main difference is that the the flags selection is based on "Allowed languages" as have been checked in Site Settings and not in "Minimum language completeness" as in original plugin.

## Features

- display flags for "Allowed languages" as have been checked in Site Settings
- language_selector/default view to use in themes
- handles translation preferences for logged in (user preferences) AND non logged in users (cookies)
- incorporated autodetection of browser language (only for non logged in users)	
- language selector display country codes or flags
- option to add language prefix in URL paramas, e.g. /en/blog

## Notes

* To add a language selector in a custom position, use ``elgg_view('language_selector/default')``
* To display a language selector with a dropdown, use ``elgg_view('language_selector/dropdown')``
* To add a custom language icon or replace an existing one, add an image file (svg, jpg, png, gif) in your plugin under `/views/default/language_selector/flags/$language_code.$ext`.
