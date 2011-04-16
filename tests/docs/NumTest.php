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
class Docs_NumTest extends Unittest_TestCase {

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
//		setlocale(LC_ALL, 'en_US.utf-8');
//
//		$this->assertSame('1,200.05', Num::format(1200.05, 2));
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
	
	public function providerRound()
	{
		return array(
			array(4, Num::round(3.999)),
			array(4, Num::round(3.888)),
			array(4, Num::round(3.777)),
			array(4, Num::round(3.666)),
			array(4, Num::round(3.555)),
			array(3, Num::round(3.444)),
			array(3, Num::round(3.333)),
			array(3, Num::round(3.222)),
			array(3, Num::round(3.111)),
			array(3, Num::round(3.000)),
			array(3.555, Num::round(3.555, 4)),
			array(3.555, Num::round(3.555, 3)),
			array(3.56, Num::round(3.555, 2)),
			array(3.6, Num::round(3.555, 1)),
			array(4, Num::round(3.555, 0)),
			array(4, Num::round(3.5, 0, Num::ROUND_HALF_UP)),
			array(3, Num::round(3.5, 0, Num::ROUND_HALF_DOWN)),
			array(4, Num::round(3.6, 0, Num::ROUND_HALF_UP)),
			array(4, Num::round(3.6, 0, Num::ROUND_HALF_DOWN)),
			array(4, Num::round(3.6, 0, Num::ROUND_HALF_EVEN)),
			array(4, Num::round(3.6, 0, Num::ROUND_HALF_ODD)),
			array(0.6, Num::round(.55, 1, Num::ROUND_HALF_EVEN)),
			array(0.5, Num::round(.55, 1, Num::ROUND_HALF_ODD)),
			array(0.4, Num::round(.45, 1, Num::ROUND_HALF_EVEN)),
			array(0.5, Num::round(.45, 1, Num::ROUND_HALF_ODD)),
			array(10, Num::round(9.5, 0, Num::ROUND_HALF_EVEN)),
			array(9, Num::round(9.5, 0, Num::ROUND_HALF_ODD)),
		);
	}

	/**
	 * @dataProvider  providerRound
	 */
	public function testRound($expected, $result)
	{
		$this->assertEquals($expected, $result);
	}

	public function testBytes()
	{
		$bytes = 60004;
		$size = Text::bytes($bytes);
		$this->assertSame('60.00 kB', $size);
	}

	/**
	 * @expectedException  Kohana_Exception
	 */
	public function testBytes2()
	{
		$bytes = Num::bytes('60.00 kB');
	}

} // End Docs_DocsTest