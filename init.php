<?php defined('SYSPATH') or die('No direct script access.');

// Error handler for catching 404s
set_exception_handler(array('Exception_Handler', 'handle'));

Route::set('docs', '(<lang>(/<category>(/<article>)))',
	array(
		'lang' => '\w+',
		'category' => '\w+',
		'article' => '\w+',
	))
	->defaults(array(
		'controller' => 'docs',
		'action' => 'static',
		'category' => 'start_here',
		'article' => 'welcome',
	));
