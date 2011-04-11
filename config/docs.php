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
			),
		),
		'Helpers' => array(
			'href' => '/helpers/arr',
			'links' => array(
				'Arr' => '/helpers/arr',
				'Cookie' => '/helpers/cookie',
				'Num' => '/helpers/num',
				'Text' => '/helpers/text',
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
		),
		'helpers' => array(
			'cookie' => array(
				'Official Documentation' => 'http://kohanaframework.org/guide/kohana/cookies',
				'Unofficial Wiki' => 'http://kerkness.ca/wiki/doku.php?id=sessions_and_cookies',
				'KO2 Docs' => 'http://docs.kohanaphp.com/helpers/cookie',
				'PHP.net Reference' => 'http://php.net/manual/en/function.setcookie.php',
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
	),
);
