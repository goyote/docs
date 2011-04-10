<?php defined('SYSPATH') or die('No direct script access.');

class Exception_Handler {

	public static function handle(Exception $e)
	{
		switch (get_class($e))
		{
			case 'HTTP_Exception_404':
				echo Response::factory()
					->status(404)
					->body(new View('404'))
					->send_headers()
					->body();
				return TRUE;
			break;
			default:
				return Kohana_Exception::handler($e);
		}
	}

} // End Exception_Handler