<?php defined('SYSPATH') or die('No direct script access.');
/**
 * Unit tests for the Docs module.
 *
 * @group      docs
 * @package    Unittest
 * @category   Tests
 * @author     Gregorio Ramirez
 * @copyright  (c) 2011 Gregorio Ramirez
 * @license    http://kohanaphp.com/license
 */
class Docs_TextTest extends Unittest_TestCase {

	public function testOrdinal()
	{
		$this->assertSame('nd', Num::ordinal(22));
		$this->assertSame('th', Num::ordinal(11));
		$this->assertSame('st', Num::ordinal(21));
		$this->assertSame('rd', Num::ordinal(73));
		$this->assertSame('th', Num::ordinal(100000));

		$spot = 3;
		$this->assertSame('I got 3rd place in the tournament', sprintf('I got %d%s place in the tournament', $spot, Num::ordinal($spot)));

		$number = 3;
		$this->assertSame('3rd', $number.Num::ordinal($number));
	}

	function display($paper)
	{
		return __('You owe me :money dollars', array(
			':money' => Num::format($paper, 2, TRUE),
		));
	}
	public function testFormat()
	{
		setlocale(LC_ALL, 'en_US.utf-8');
		echo Num::format(1200.05, 2);
		$this->assertSame('1,200.05', Num::format(1200.05, 2));
//		$this->assertSame('1,200.05', Num::format(1200.05, 2, TRUE));

//		setlocale(LC_ALL, 'es_ES.utf-8');
//		$this->assertSame('1200,05', Num::format(1200.05, 2));
//		$this->assertSame('1.200,05', Num::format(1200.05, 2, TRUE));
//
//		setlocale(LC_ALL, 'pt_PT.utf-8');
//		$this->assertSame('1 200,05', Num::format(1200.05, 2));
//		$this->assertSame('1.200.05', Num::format(1200.05, 2, TRUE));
//
//		setlocale(LC_ALL, 'en_US.utf-8');
//		$this->assertSame('You owe me 1,200.10 dollars', $this->display(1200.10));
//
//		setlocale(LC_ALL, 'es_ES.utf-8');
//		I18n::lang('es-es');
//		$this->assertSame('Me debes 1.200,10 dólares', $this->display(1200.10));
	}

} // End Docs_DocsTest