<h1>Stop Writing Code Like A Noob</h1>

<p>In short: read the <a href="http://kohanaframework.org/3.1/guide/kohana/conventions">kohana coding guidelines</a>. It&#8217;s not about them being right, but about reaching a consistent pool of source code, where anyone can come in and feel right at home, as if they were tweaking their own source code. Sounds awesome? Well first off, go read the <a href="http://kohanaframework.org/3.1/guide/kohana/conventions">guidelines</a>. Step two, read my additions, defined below. Some of them are rules, some of them are corrections to the crap that I see out there. hf</p>
	
<h2>Brackets</h2>
	
<p>Curlies are placed on their own line; <strong>this isn&#8217;t the Zend framework or JavaScript.</strong></p>

<pre class="brush:php">
// Pro
if ($lol === $wut)
{
	return Conquer::world();
}
else
{
	Fail::instance()->sleep_on_it();
	die();
}

// Noob
if ($total === $noob) {
	return i_suck();
} else {
	return just_kidding();
}
</pre>

<h2>Class Curlies</h2>

<div class="note">
	<p><strong>Update:</strong> This goes against how Kohana is currently written, but for my next project I'll experiment being consistent with the curly placement, as well as deleting the ending class comment, just to see if I like it.</p>
<pre class="brush:php">
class ClassName
{
	public function method()
	{

	}
}
</pre>
</div>

<p>The opening class curly goes on the same line!</p>
	
<pre class="brush:php">
// Win
class Win {

// Fail
class Lol
{
</pre>
	
<p>For that matter, keep the spacing correct:</p>
	
<pre class="brush:php">
// OK
class {

	function()
	{
	}
	<- Please add empty line here, thanks
}

// No
class {

	function()
	{
	}
}
</pre>
	
<h2>Empty Anything</h2>

<p>Anything that's empty should be empty. It's either empty or not empty, don't mess with that.</p>
	
<pre class="brush:php">
// Yes, sir
class Gentleman extends Gentleman_Core {}

// Total clown
class Dork extends Dweebs { }
</pre>
	
<h2>Equality</h2>

<p>Run your checks with the identical operator (<strong><code>===</code></strong>.) If you're not sure what to expect, refactor. After you're done refactoring your life, dismantle your computer.</p>

<pre class="brush:php">
// Robust
if ($profit === TRUE)

// Coward
if ($this == $sucks)
</pre>

<p>Same thing with unit tests.</p>

<pre class="brush:php">

// 1
$this->assertSame

// 0
$this->assertEquals
</pre>

<p>Yep, threw some bit logic in there.</p>

<h2>Keywords</h2>

<p><code>strtolower(PHP keywords)</code></p>

<pre class="brush:php">
// Yes
class Omg {

// No
Class Omg {
</pre>

<h2>Ugly Empty Line</h2>

<pre class="brush:php">
// Proceed
&lt;?php
/**

// Halt
&lt;?php
	&lt;- Don't put a space here
/**
</pre>

<p>You're using kohana, not symfony. Stop using one coding style for every language you write in. You're smarter than that (don't quote me on it.)</p>

<h3>But</h3>

<p>Do add a empty line if a class docblock is missing.</p>

<pre class="brush:php">
// Tasteful
&lt;?php

class Baller extends Baller_Core {}

// Oh no she didn't
&lt;?php
class Tacky extends Tacky_Core {}
</pre>

<h2>DocBlocks</h2>

<p>Bottom line: DocBlocks should be written as sentences, requiring an ending period. Descriptions and single line comments should be written as compact, concise blurbs that get the message across without needing to be written as sentences, so ommit the period. Single line comments are capitalized, descriptions are not.</p>

<pre class="brush:php">
// Correct
/**
 * Get the cookie.

// Incorrect
/**
 * Get the cookie &lt;- Hint: missing dot

// Correct
* @var  Config  config object
* @var  array   preferred order of attributes

// Incorrect
* @var  Config  An instance of the Configuration class.
* @var  array   The preferred order of attributes.
</pre>

<h2>Formatting</h2>

<p>Try to avoid getting sloppy with your formatting, it's annoying.</p>

<pre class="brush:php">
// Thanks
/**
 *
 */

// Stop it
/**
*
*/
</pre>

<p>The latter formatting is not achievable in a decent IDE ;)</p>

<h2>Can't Figure Out How to Title This</h2>

<p>Start with a default of two spaces, use more if needed.</p>

<pre class="brush:php">
// Correct
* @var  string  default delimiter for path()

// Incorrect
* @var string default delimiter for path()

// Correct
* @param   mixed
* @return  boolean

// Incorrect
* @param  mixed
* @return boolean
</pre>

<p>Sometimes it can get ridiculous, so use your best judgement.</p>

<pre class="brush:php">
// Cool
* @param   array  configuration
* @throws  Kohana_Cache_Exception

// Funky?
* @param   array                   configuration
* @throws  Kohana_Cache_Exception
</pre>

<h2>Ending Curly</h2>

<p>Before I forget, the ending curly of a class should document the name of the class it's closing.</p>

<pre class="brush:php">
// Correct
} // Deploy_Core

// Incorrect
} &lt;- nothing? cut it out, rebel
</pre>

<p>Also, please document the correct class name.</p>

<pre class="brush:php">
// Thank you
class Kohana_Arr {
} // Kohana_Arr

// No thank you
class Kohana_Arr {
} // End arr &lt;- lol wrong class name
</pre>

<p><strong>Tip:</strong> <code>Ctrl+Home</code>, look at the class name, then <code>Ctrl+End</code>, write the name that's cached in your memory.</p>

<h2>Class Case</h2>

<p>Stop typing helper classes like you did in ko2. Let it go, move on ;)</p>

<pre class="brush:php">
// Yay
HTML::chars($str)
Arr::get($arr, $key)

// Nay
html::chars($str)
arr::get($arr, $key)
</pre>

<h2>Single Statement Tags</h2>

<p>Omit the semicolon where possible (single statements.)</p>

<pre class="brush:php">
// Princess Leia
&lt;?php echo $foo ?&gt;
&lt;?php endif ?&gt;

// Chewbacca
&lt;?php echo $foo; ?&gt;
&lt;?php endif; ?&gt;
</pre>

<h2>Short Tags</h2>

<p>Writing open source? Avoid short tags.</p>

<pre class="brush:php">
// Traditional, works everywhere
&lt;?php echo $foo ?&gt;

// Ninja, doesn't work everywhere
&lt;?= $foo ?&gt;
</pre>

<h2>PHP for Templating</h2>

<p>When templating with PHP, use the alternative syntax.</p>

<pre class="brush:php">
// Readable
&lt;?php if ($show): ?&gt;
	&lt;div id=&quot;show&quot; /&gt;
&lt;?php endif ?&gt;

// Fuggly
&lt;?php if ($show) { ?&gt;
	&lt;div id=&quot;show&quot; /&gt;
&lt;?php } ?&gt;
</pre>

<h2>Arrays</h2>

<p>Obviously arrays can be single-line or multi-line. If you go multi-line, the opening parenthesis goes on the same line.</p>

<pre class="brush:php">
// M60 machine gun
array(

)

// Dart
array
(

)
</pre>

<h3>Single Dimension</h3>

<p>The closing parenthesis of a multi-line single dimension array is placed on its own line, indented to the same level as the assignment or statement.</p>

<pre class="brush:php">
// Right
Kohana::init(array(

));

// facepalm
Kohana::modules(array(

	));
</pre>

<h3>Multidimensional</h3>

<p>The nested array is indented one tab to the right, following the single dimension rules.</p>

<pre class="brush:php">

// Correct
array(
    'arr' => array(

    ),
    'arr' => array(

    ),
)

array(
    'arr' => array(...),
    'arr' => array(...),
)
</pre>

<h3>Arrays as Function Arguments</h3>

<pre class="brush:php">
// Correct
do(array(

))

// Incorrect
do(array(

    ))
</pre>

<p>Single line syntax is also valid.</p>

<pre class="brush:php">
// Correct
do(array(...))

// Alternative for wrapping long lines
do($bar, 'this is a very long line',
    array(...));
</pre>

<h3>Commas</h3>

<p>Single-line arrays don't end with a comma. Multi-line do.</p>

<pre class="brush:php">

// Yes
array($a, $b)

// No
array($a, $b,)

// Yes
array(
	array(

    ),
    array(

    ),
)

// NO!
array(
	array(

    ),
    array(

    ) &lt;- Hint: missing comma
)
</pre>

<p>The latter makes it easier to maintain an array manually.</p>

<h2>SnippetDocs</h2>

<p>Please add a code snippet to all your public apis. Feel free to ignore my suggestion for private members or just to spite people.</p>

<pre class="brush:php">
// Got it!
/**
 * Set a CSS package.
 *
 *     Pack::css_package('package1');
 *
 *     // Render the package
 *     &lt;?php echo Pack::css() ?&gt;
 *
 * @param  string
 */
public static function css_package($package)

// How do I use this crap?
/**
 * Set a CSS package.
 *
 * @param  string
 */
public static function css_package($package)
</pre>

<h2>NULL Parameter</h2>

<p><code>NULL</code> isn't the only falsy value. Zero and an empty string are also falsy.</p>

<pre class="brush:php">
// Correct
function bar($foo = NULL)
{
	if ($foo !== NULL)

// Incorrect
function bar($foo = NULL)
{
	if ($foo)
</pre>

<p>Not a rule, but a reminder to be specific about your intentions.</p>

<h2>Long Lines</h2>

<p>I recently saw this cool tip for wrapping long lines in a readable manner.</p>

<pre class="brush:php">
// Readable
$this->request->redirect(
	this->request->uri(array('foo' => 'bar'))
);

// Uhlala
$this->request->redirect(
	this->request->uri(array(
		'foo' => 'bar',
	))
);

// yuck
$this->request->redirect(this->request->uri(array('foo' => 'bar')));
</pre>

<h2>Routes</h2>

<pre class="brush:php">
Route::set('docs', '(&lt;lang&gt;(/&lt;category&gt;(/&lt;article&gt;)))', 
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
</pre>

<h2>TRUE or FALSE</h2>

<p>Comparison operators return a boolean value, you don't need a ternary operator to return the same thing, unless you want to be dead obvious about your intentions.</p>

<pre class="brush:php">
// Sufficient
'packaging' => Kohana::$environment !== Kohana::DEVELOPMENT,

// Redundant
'packaging' => (Kohana::$environment != 'development') ? TRUE : FALSE,
</pre>
	