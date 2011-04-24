<?php defined('SYSPATH') or die('No direct script access.');

return array(
	/**
	 * Language settings / multilingual support.
	 */
	'language' => array(

		/**
		 * Default the docs to the language of your choice.
		 */
		'default' => 'en',

		/**
		 * Add your language below, then translate the docs! Don't forget to share ;)
		 */
		'supported' => array(
			'en' => array(
				'lang' => 'en',
				'name' => 'English',
				'locale' => 'en_US.utf-8',
			),
//			'es' => array(
//				'lang' => 'es',
//				'name' => 'Español',
//				'locale' => 'es_MX.utf-8',
//			),
		),
	),

	/**
	 * Main navigation for the site. The correct language will be added automatically.
	 */
	'navigation' => array(
		'Home' => array(
			'href' => '/',
		),
		'Start Here' => array(
			'href' => '/start_here/welcome',
			'links' => array(
				'Welcome' => '/start_here/welcome',
				'Installation' => '/start_here/installation',
				'Troubleshooting' => '/start_here/troubleshooting',
				'Coding Standards' => '/start_here/coding_standards',
			),
		),
		'Helpers' => array(
			'href' => '/helpers/arr',
			'links' => array(
				'Arr' => '/helpers/arr',
				'Cookie' => '/helpers/cookie',
				'Feed' => '/helpers/feed',
				'Num' => '/helpers/num',
				'Text' => '/helpers/text',
			),
		),
		'Tools' => array(
			'href' => '/tools/phpstorm',
			'links' => array(
				'PhpStorm' => '/tools/phpstorm',
			),
		),
	),

	/**
	 * External resources relevant to the article.
	 */
	'resources' => array(
		'start_here' => array(
			'welcome' => array(
				'Official Documentation' => 'http://kohanaframework.org/documentation',
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php',
				'KO2 Docs' => 'http://docs.kohanaphp.com/contents',
			),
			'installation' => array(
				'Official Documentation' => 'http://kohanaframework.org/3.1/guide/kohana/install',
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php#installing_and_configuring_kohana_3',
				'KO2 Docs' => 'http://docs.kohanaphp.com/installation',
			),
		),
		'helpers' => array(
			'arr' => array(
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php?id=working_with_arrays_in_kohana',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/arr',
				'API Browser' => 'http://kohanaframework.org/guide/api/Arr',
				'PHP.net Reference' => 'http://php.net/manual/en/ref.array.php',
			),
			'cookie' => array(
				'Official Documentation' => 'http://kohanaframework.org/guide/kohana/cookies',
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php?id=sessions_and_cookies',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/cookie',
				'PHP.net Reference' => 'http://php.net/manual/en/function.setcookie.php',
			),
			'feed' => array(
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php?id=working_with_atom_and_rss_feeds',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/feed',
				'API Browser' => 'http://kohanaframework.org/3.1/guide/api/Feed',
			),
			'text' => array(
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php#how_to_use_the_text_class',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/text',
				'API Browser' => 'http://kohanaframework.org/guide/api/Text',
			),
			'num' => array(
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php?id=working_with_numbers',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/num',
				'API Browser' => 'http://kohanaframework.org/guide/api/Num',
			),
		),
		'tools' => array(
			'phpstorm' => array(
				'Website' => 'http://www.jetbrains.com/phpstorm/',
				'Blog' => 'http://blogs.jetbrains.com/webide/',
				'YouTrack' => 'http://youtrack.jetbrains.net/issues/WI',
			),
		),
	),
);
