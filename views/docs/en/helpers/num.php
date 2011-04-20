<h1>Num</h1>

<p><code>Num</code> is to integers, what <code><a href="/<?php echo I18n::$lang ?>/helpers/text">Text</a></code> is to strings. <code>Num</code> has a couple of methods for formatting numbers in a human readable fashion. Despite its small size, documentation for it is scarce on the web.</p>

<h2>ordinal<code>($number)</code></h2>

<p>Returns the english ordinal suffix (th, st, nd, etc) of a number.</p>

<pre class="brush:php">
// Using the concatenation operator to join a
// function call and an integer won't work!
echo 22.Num::odinal(22);
	
// Result:
Parse error: syntax error, unexpected T_STRING, expecting ',' or ';'

// The workaround is to pass multiple parameters to echo
echo 22, Num::ordinal(22); // "22nd"
echo 11, Num::ordinal(11); // "11th"
echo 21, Num::ordinal(21); // "21st"
echo 73, Num::ordinal(73); // "73rd"
echo Num::ordinal(100000); // "th"

$spot = 3;

// Displays "I got 3rd place in the tournament"
echo sprintf('I got %d%s place in the tournament', $spot, Num::ordinal($spot));
</pre>

<p>The current implementation is a bit annoying because instead of having just one function call, you have to do a manual concatenation to get the result you expect.</p>

<pre class="brush:php">
$number = 3;

// Weak sauce
echo $number.Num::ordinal($number);

// Better?
echo Num::ordinal($number);
</pre>

<p>Don't get me wrong, I'm not naive. The current implementation behaves like that, because it can only build a string with digits e.g. "3rd" and not a full text version like "third." So returning just the suffix is more flexible.</p>
<p><strong>Braveheart challenge:</strong> Come up with a better solution that does the following:</p>

<pre class="brush:php">
echo Num::ordinal(3); // "3rd"
echo Num::ordinal(3, TRUE); // "third"
</pre>

<h2>format<code>($number, $places, $monetary = FALSE)</code></h2>

<p>Locale-aware number and monetary formatting.</p>

<pre class="brush:php">
// In English, "1,200.05"
// In Spanish, "1200,05"
// In Portuguese, "1 200,05"
echo Num::format(1200.05, 2);

// In English, "1,200.05"
// In Spanish, "1.200,05"
// In Portuguese, "1.200.05"
echo Num::format(1200.05, 2, TRUE);

function display($paper)
{
	return __('You owe me :money dollars', array(
		':money' => Num::format($paper, 2, TRUE),
	));
}

setlocale(LC_ALL, 'en_US.utf-8');

echo display(1200.10); // "You owe me 1,200.10 dollars"

// Locale adjustment is needed by Num::format()
setlocale(LC_ALL, 'es_ES.utf-8');

// Language adjustment is needed by __()
I18n::lang('es-es');

echo display(1200.10); // "Me debes 1.200,10 dólares"
</pre>

<p>Notice the different number formatting in each instance.</p>

<h2>round<code>($value, $precision = 0, $mode = self::ROUND_HALF_UP, $native = true)</code></h2>

<p>The purpose of <code>Num::round()</code> is to round floats up or down. If you have PHP 5.3, feel free to use the native method <code><a href="http://php.net/round">round()</a></code> instead, it does the same thing.</p>

<pre class="brush:php">
// By default, floats are rounded starting from 5 (ROUND_HALF_UP)
// and transformed into integers ($precision = 0)
echo Num::round(3.999); // "4"
echo Num::round(3.888); // "4"
echo Num::round(3.777); // "4"
echo Num::round(3.666); // "4"
echo Num::round(3.555); // "4" &lt;- ROUND_HALF_UP
echo Num::round(3.444); // "3"
echo Num::round(3.333); // "3"
echo Num::round(3.222); // "3"
echo Num::round(3.111); // "3"
echo Num::round(3.000); // "3"

// To conserve some digits after the decimal point, specify the precision
echo Num::round(3.555, 4); // "3.555"
echo Num::round(3.555, 3); // "3.555"
echo Num::round(3.555, 2); // "3.56"
echo Num::round(3.555, 1); // "3.6"
echo Num::round(3.555, 0); // "4" &lt;- the default / $precision === 0
</pre>

<p>The <code>$mode</code> argument is what makes this method interesting. It allows you to specify how you want to round your floats. You get 4 modes to choose from:</p>

<ol>
	<li><code>ROUND_HALF_UP</code></li>
	<li><code>ROUND_HALF_DOWN</code></li>
	<li><code>ROUND_HALF_EVEN</code></li>
	<li><code>ROUND_HALF_ODD</code></li>
</ol>

<pre class="brush:php">
echo Num::round(3.5, 0, Num::ROUND_HALF_UP); // "4"
echo Num::round(3.5, 0, Num::ROUND_HALF_DOWN); // "3"
</pre>

<p>You'll notice the whole controversy is whether the <code>5</code> gets rounded up or down, i.e other numbers are unnefected. e.g. <code>6</code> will always round up and <code>4</code> will always round down no matter what the mode is.</p>

<pre class="brush:php">
echo Num::round(3.6, 0, Num::ROUND_HALF_UP); // "4"
echo Num::round(3.6, 0, Num::ROUND_HALF_DOWN); // "4"
echo Num::round(3.6, 0, Num::ROUND_HALF_EVEN); // "4"
echo Num::round(3.6, 0, Num::ROUND_HALF_ODD); // "4"
</pre>

<p><code>ROUND_HALF_ODD</code> will always round to an odd number (3, 7, 9, etc) and <code>ROUND_HALF_EVEN</code> will always round to en even number (2, 4, 6 , etc.)</p>

<pre class="brush:php">
echo Num::round(.55, 1, Num::ROUND_HALF_EVEN); // "0.6"
echo Num::round(.55, 1, Num::ROUND_HALF_ODD); // "0.5"

echo Num::round(.45, 1, Num::ROUND_HALF_EVEN); // "0.4"
echo Num::round(.45, 1, Num::ROUND_HALF_ODD); // "0.5"

echo Num::round(9.5, 0, Num::ROUND_HALF_EVEN); // 10"
echo Num::round(9.5, 0, Num::ROUND_HALF_ODD); // "9"
</pre>

<h2>bytes<code>($size)</code></h2>

<p><code>bytes()</code> does the inverse of <code>Text::bytes()</code> (er better said, one would be tricked into thinking that.) It accepts a human readable file size and returns the equivalent amount in bytes (<a href="http://dev.kohanaframework.org/issues/3363">read how it originated on redmine</a>.)</p>

<pre class="brush:php">
$bytes = filesize(__FILE__); // $bytes === 60004

$size = Text::bytes($bytes); // $size === "60.03 kB"

$bytes = Num::bytes($size); // Throws a Kohana_Exception wtf?
</pre>

<p><code>&lt;lame sauce="fragile"&gt;</code>Turns out <code>Text::bytes()</code> and <code>Num::bytes()</code> are <strong>incompatible</strong><code>&lt;/lame&gt;</code> <code>Num::bytes()</code> won't tolerate any spaces in the string "60.03 kB" even though <code>Text::bytes()</code> encourages it. The fix involves updating <code>Num::bytes()</code>' regular expression to accept "60.03 kB" and "60.03kB" equally:</p>

<pre class="brush:php">
// Weak
$pattern = '/^([0-9]+(?:\.[0-9]+)?)('.$accepted.')?$/Di';

// Badass
$pattern = '/^([0-9]+(?:\.[0-9]+)?)(?:\s)?('.$accepted.')?$/Di';
</pre>

<p>Is that it? Sadly, no.</p>

<ol>
	<li><code>Num::bytes()</code> doesn't understand the unit: <code>kB</code>. If you're unaware, <code>kB</code> is the <strong>official symbol of kilobyte</strong>.</li>
	<li><code>Text::bytes</code> supports both "1000" and "1024" multiples while <code>Num::bytes()</code> only supports "1024."</li>
</ol>
	