<h1>Arr</h1>

<p><code>Arr</code> (short for "array") is a helper class that consists of a bunch of static methods, that can be treated as additions to the official list of array functions: <a href="http://php.net/manual/en/ref.array.php">http://php.net/manual/en/ref.array.php</a>.</p>

<h2>is_assoc<code>(array $array)</code></h2>

<p><code>is_assoc()</code> states whether an array is associative or not.</p>

<pre class="brush:php">
// Numeric array (a.k.a indexed, sequential)
$numeric = array('foo', 'bar');

// Associative array
$associative = array('foo' => 'foo', 'bar' => 'bar');

// Numeric
Array
(
    [0] => foo
    [1] => bar
)

// Associative
Array
(
    [foo] => foo
    [bar] => bar
)

Arr::is_assoc($numeric); // FALSE
Arr::is_assoc($associative) // TRUE
</pre>

<p><strong class="caution">Caution:</strong> <code>is_assoc()</code>'s current implementation is very weak, in that it only accepts arrays as arguments; anything else will throw a fatal error. This goes against PHP's philosophy, imagine how impractical it would be if <code><a href="http://php.net/is_string">is_string()</a></code> only accepted strings as arguments? Ticket <a href="http://dev.kohanaframework.org/issues/3761">#3761</a>.</p>

<p>In a real world scenario, you might want to check if the variable is an array first:</p>

<pre class="brush:php">
is_array($foo) AND Arr::is_assoc($foo)
</pre>

<p>Or, <em>fix it yourself!</em><sup>&trade;</sup></p>

<pre class="brush:php">
class Arr extends Kohana_Arr {

	/**
	 * Check whether the argument is an associative array or not.
	 *
	 * @param   mixed
	 * @return  boolean
	 */
	public static function is_assoc($array)
	{
		return is_array($array) AND parent::is_assoc($array);
	}

} // End Arr
</pre>

<p>Don't be afraid to extend Kohana. The <abbr title="Cascading Filesystem">CFS</abbr> was built to enable this type of workflow. Sadly in this case, an <code>ErrorException</code> is thrown because we've modified the function signature in an incompatible way, i.e. removed the array requirement.</p>

<h2>is_array<code>($value)</code></h2>

<p><code>is_array()</code> returns <code>TRUE</code> if the supplied argument is either an array or an instance of a class that implements the Traversable interface. In other words: objects with array-like features.</p>

<pre class="brush:php">
$competition = new ArrayObject(array('symfony', 'zend', 'cake'));

if (Arr::is_array($competition))
{
	$competition[] = 'ci';
}

unset($competition);
</pre>

<h2>path<code>($array, $path, $default = NULL, $delimiter = NULL)</code></h2>

<p>As if inspired by JavaScript, <code>path()</code> lets you retrieve values from an existing array using dot notation!</p>

<pre class="brush:js">
// JS
var yo = {
	mama: {
		so: 'fat'
	}
};
document.write(yo.mama.so); // "fat"
</pre>

<pre class="brush:php">
// PHP equivalent
$yo = array(
	'mama' => array(
		'so' => 'fat',
	),
);
echo Arr::path($yo, 'mama.so'); // "fat"

// You can also use a wildcard to replace a directory name
$lang = array(
	'js' => array(
		'libs' => array(
			'awesome' => array(
				'jquery' => array(
					'devs' => array(
						'resig',
					),
				),
				'mootools' => array(
					'devs' => array(
						'walsh',
					),
				),
			),
			'lame' => array(
				'prototype1.6',
			),
		),
	),
);

// Get all the devs working on awesome libs
$devs = Arr::path($lang, 'js.libs.awesome.*.devs');
</pre>

<p><code>$devs</code> will be an array holding the values "resig" and "walsh."</p>

<h2>set_path<code>( & $array, $path, $value, $delimiter = NULL)</code></h2>

<p>Building on top of the previous example, say David Walsh called and said "yo, you forgot to add Valerio."</p>

<pre class="brush:php">
// Add more team members
Arr::set_path($lang, 'js.libs.awesome.mootools.devs', array('walsh', 'valerio'));

</pre>

<p>If a value already exists (e.g. "walsh"), it will be overwritten by the new value (e.g "walsh," "valerio.") On the other hand, if the full path doesn't exist yet, it will be made.</p>

<pre class="brush:php">
$auto = array();

// Add some trucks
Arr::set_path($auto, 'trucks', array('Silverado', 'Tundra', 'Cheyenne'));

Array
(
    [trucks] => Array
        (
            [0] => Silverado
            [1] => Tundra
            [2] => Cheyenne
        )

)
</pre>

<h2>range<code>($step = 10, $max = 100)</code></h2>

<p>The purpose of this method is unknown. As seen in the example below, <code>Arr::range()</code> behaves almost exactly like the native PHP function <code><a href="http://us2.php.net/manual/en/function.range.php">range()</a></code>:</p>

<pre class="brush:php">
Arr::range(8, 35);

Array
(
    [8] => 8
    [16] => 16
    [24] => 24
    [32] => 32
)

range(8, 35, 8);

Array
(
    [0] => 8
    [1] => 16
    [2] => 24
    [3] => 32
)
</pre>

<p>I'm probably missing the point, but I went ahead and refactored the function:</p>

<pre class="brush:php">
// Old (current)
public static function range($step = 10, $max = 100)
{
	if ($step &lt; 1)
		return array();

	$array = array();
	for ($i = $step; $i &lt;= $max; $i += $step)
	{
		$array[$i] = $i;
	}

	return $array;
}

// New (my version)
public static function range($step = 10, $max = 100)
{
	$range = range($step, $max, $step);

	return array_combine($range, $range);
}
</pre>

<p>The latter produces the exact same output. However, it doesn't pass the unit tests, because for some reason, sometimes you'll want the stepping to be bigger than the max number?</p>

<h2>get<code>($array, $key, $default = NULL)</code></h2>

<p><code>get()</code> is a dead-simple method that's engineered to prevent hair loss. It allows you to avoid the dreaded "Undefined index" notice warning.</p>

<pre class="brush:php">
// Report all PHP errors (including E_NOTICE)
error_reporting(E_ALL);

$dumb = array();
echo $dumb['whoami'];
</pre>
	<?php

?>
<p>The previous code snippet causes your code to barf and display the following message <code>"<strong>Notice</strong>: Undefined index: whoami&hellip;"</code></p>

<p>Sure you can suppress notices with <code>error_reporting(E_ALL ^ E_NOTICE)</code>, but <code>get()</code> is a wiser choice because it allows you to define a default value in case the index doesn't exist.</p>

<pre class="brush:php">
$template = array(
	'background' => 'blue',
	'font' => 'arial',
	// 'color' => 'blue',
);

// If no color defined, use red as the default
$color = Arr::get($template, 'color', 'red');
</pre>

<p>Essentially, <code>Arr::get()</code> is a shortcut for doing redundant stuff like:</p>

<pre class="brush:php">
$email = isset($_POST['email']) ? $_POST['email'] : NULL;

// Better?
$email = Arr:get($_POST, 'email');
</pre>

<p>Naturally, you'll want to use this with form submissions (<code>$_GET</code>, <code>$_POST</code>, etc,) because in such a process you never know what to expect as people can simply disable JavaScript and send you bogus.</p>

<pre class="brush:php">
if (($email = Arr::get($_POST, 'email')) === NULL)
{
	die('Nice going, you forgot your email');
}
else
{
	echo sprintf('Thanks, an email has been sent to %s', HTML::chars($email));
}
</pre>

<h2>extract<code>($array, array $keys, $default = NULL)</code></h2>

<p><code>extract()</code> is like <code>get()</code>, but on 'roids. Instead of retrieving only one index, it can retrieve an unlimited amount! Use <code>extract()</code> to get only the data that you want from an array, and nothing else.</p>

<pre class="brush:php">
$sammich = array(
	'roast_beef' => array('roast beef', 'beef broth', 'onion', 'garlic'),
	'torta' => array('jamon', 'queso', 'mayonesa', 'aguacate', 'jalapeño', 'ruffles'),
	'turkey' => array('turkey', 'mustard'),
);

if (Hungry::is_hungry($dude))
{
	$woman = new Woman(Woman::MOM);
	Hungry::make_sandwich($woman, Arr::extract($sammich, array('roast_beef', 'torta')));

	// Will need a nap after this
	sleep(3600);
}
else
{
	Hungry::make_salad(self);
}
</pre>

<p>Need a dull example?</p>

<pre class="brush:php">
// $_POST
Array
(
    [first_name] => john
    [last_name] => doe
    [username] => john_doe
    [email] => john@example.com
    [password] => 123456
)

$credentials = Arr::extract($_POST, array('username', 'password'));

// $credentials
Array
(
    [username] => john_doe
    [password] => 123456
)
</pre>

<h2>pluck<code>($array, $key)</code></h2>

<p><code>pluck()</code> is kinda lame to explain, so I'll just give you an example.</p>

<pre class="brush:php">
$employees = array(
	array(
		'id' => 743829,
		'name' => 'George',
		'age' => 24,
	),
	array(
		'id' => 743889,
		'name' => 'Alice',
		'age' => 29,
	),
	array(
		'id' => 69384,
		'name' => 'Tom',
		'age' => 45,
	),
);

// Get the id's of all the employees
$ids = Arr::pluck($employees, 'id');

// $ids
Array
(
    [0] => 743829
    [1] => 743889
    [2] => 69384
)
</pre>

<p><code>pluck()</code> would be more useful if it allowed you to retrieve several items, instead of only one.

<pre class="brush:php">
// Get the name & id's of all the employees
$ids = Arr::pluck($employees, array('id', 'name')); // <- make it happen ;)
</pre>

<h2>unshift<code>( array & $array, $key, $val)</code></h2>

<p><code>Arr::unshift()</code> is identical to <code><a href="http://php.net/manual/en/function.array-unshift.php">array_unshift()</a></code>, but for associative arrays.</p>

<pre class="brush:php">
$array = array(
	'second' => 'second',
	'third' => 'third',
);

array_unshift($array, 'first');

// Result (not what we want)
Array
(
    [0] => first
    [second] => second
    [third] => third
)

// Remove the first item
array_shift($array);

// Add a new item to the start
Arr::unshift($array, 'first', 'first');

// Result
Array
(
    [first] => first
    [second] => second
    [third] => third
)

</pre>

<h2>map<code>($callback, $array)</code></h2>

<p><code>map()</code> is a recursive version of <code><a href="http://php.net/array_map">array_map()</a></code>, it applies the same callback to all elements in an array, <strong>including sub-arrays</strong>.</p>

<pre class="brush:php">
// Data with embedded XSS
$data = array(
	&#x27;first_name&#x27; =&gt; &#x27;&lt;script&gt;alert(\&#x27;lol\&#x27;)&lt;/script&gt;Mary&#x27;,
	&#x27;last_name&#x27; =&gt; &#x27;&lt;b&gt;Bob&lt;/b&gt;&#x27;,
	&#x27;children&#x27; =&gt; array(
		&#x27;&lt;i&gt;bobby&lt;/i&gt;&#x27;,
		&#x27;susan&lt;IMG SRC=&quot;javascript:alert(\&#x27;XSS\&#x27;);&quot;&gt;&#x27;,
	),
);

// The native function is only useful for single dimension arrays
$data = array_map(&#x27;strip_tags&#x27;, $data);

// Result
Warning: strip_tags() expects parameter 1 to be string, array given
</pre>

<p><code>Arr::map()</code>'s recursive approach solves this problem.</p>

<pre class="brush:php">
$data = Arr::map(&#x27;strip_tags&#x27;, $data);

// Result
Array
(
    [first_name] =&gt; alert(&#x27;lol&#x27;)Mary
    [last_name] =&gt; Bob
    [children] =&gt; Array
        (
            [0] =&gt; bobby
            [1] =&gt; susan
        )

)
</pre>

<h2>merge<code>(array $a1, array $a2)</code></h2>

<p><code>merge()</code> helps you merge multiple arrays. In some cases, it behaves similar to the native PHP function <a href="http://php.net/array_merge_recursive">array_merge_recursive().</a> The differences are better seen with an example.</p>

<pre class="brush:php">
$array1 = array(
	'foo' => 'bar'
);
$array2 = array(
	'foo' => array(
		'bar'
	),
);

Arr::merge($array1, $array2);
Array
(
    [foo] => Array
        (
            [0] => bar
        )

)

array_merge_recursive($array1, $array2);
Array
(
    [foo] => Array
        (
            [0] => bar
            [1] => bar
        )

)
</pre>

