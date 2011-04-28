<h1>URL</h1>

<p>The <code>URL</code> class is self explanatory: it helps you build URLs.</p>

<p>Before you move any further make sure you have the correct <code>RewriteBase</code> and "base_url" settings defined in your project.</p>

<pre class="brush:php">
// Apache conf, or htaccess file
example.com/index.php
RewriteBase /

example.com/kohana/index.php
RewriteBase /kohana/

example.com/demos/example1/index.php
RewriteBase /demos/example1/

// Make the equivalent tweak in the bootstrap file
Kohana::init(array(
	'base_url' => '/',

	// Or
	'base_url' => '/kohana/',

	// Or
	'base_url' => '/demos/example1/',
));
</pre>

<p>And make sure you turn off the "index_file" setting if you're not using "index.php" in the URL.</p>

<pre class="brush:php">
Kohana::init(array(
	...
	'index_file' => FALSE,
	...
));
</pre>
	
<h2>base<code>($protocol = NULL, $index = FALSE)</code></h2>

<p><code>base()</code> retrieves the base URL of your app.</p>

<pre class="brush:php">
// Given these settings
example.com/index.php
RewriteBase /
'base_url' => '/'

// Grab the base URL of the website
echo URL::base(); // "/"
echo URL::base(TRUE); // "http://example.com/"
</pre>

<p>Second example:</p>

<pre class="brush:php">
// Given these settings
example.com/demos/example1/index.php
RewriteBase /demos/example1/
'base_url' => '/demos/example1/'

// Grab the base URL of the website
echo URL::base(); // "/demos/example1/"
echo URL::base(TRUE); // "http://example.com/demos/example1/"
</pre>

<h3>Usage examples:</h3>

<pre class="brush:php">
&lt;base href="&lt;?php echo URL::base(TRUE) ?&gt;" /&gt;
</pre>

<pre class="brush:php">
&lt;?xml version="1.0" ?&gt;
&lt;rss version="2.0"&gt;
	&lt;channel&gt;
		&lt;title&gt;Example Channel&lt;/title&gt;
		&lt;link&gt;&lt;?php echo URL::base(TRUE) ?&gt;&lt;/link&gt;
</pre>
	
<h2>site<code>($uri = '', $protocol = NULL, $index = TRUE)</code></h2>

<p><code>site()</code> comes in handy when you already have a URL path, e.g. "controller/action" and you want to prepend the base URL to it. In other words: <code>URL::base()</code> + <code>$your_path</code>.</p>

<pre class="brush:php">
// Given these settings
example.com/demos/example1/index.php
RewriteBase /demos/example1/
'base_url' => '/demos/example1/'

// When no arguments are supplied, site() is just a proxy to base(), i.e. URL::base() + ""
echo URL::base(); // "/demos/example1/"
echo URL::site(); // "/demos/example1/"

// When a path is given, it works like: URL::base() + $path
echo URL::site('controller/action'); // "/demos/example1/controller/action"
echo URL::site('controller/action', TRUE); // "http://example.com/demos/example1/controller/action"
</pre>

<p>Behind the scenes <code><a href="http://php.net/rawurlencode">rawurlencode()</a></code> is used on non-ascii characters.</p>

<pre class="brush:php">
echo URL::site("controller/action?lang=español&spaces=one two"); // "/demos/example1/controller/action%3Flang%3Despa%C3%B1ol%26spaces%3Done%20two"
echo URL::site("controller/action?lang=español&spaces=one two", TRUE); // "http://test/demos/example1/controller/action%3Flang%3Despa%C3%B1ol%26spaces%3Done%20two"
</pre>

<h2>query<code>(array $params = NULL, $use_get = TRUE)</code></h2>

<p><code>query()</code> helps you generate a URL query string from an array. You can think of <code>query()</code> as an enhanced <code><a href="http://php.net/http_build_query">http_build_query()</a></code>.</p>

<pre class="brush:php">
echo URL::query(array(
	'foo' => 'foo',
	'bar' => 'bar',
));

// Result
?foo=foo&bar=bar
</pre>

<p><code>query()</code> will urlencode all non-alphanumeric characters except -_</p>

<pre class="brush:php">
echo URL::query(array(
	'lang' => 'español',
	'code' => 'foo bar',
));

// Result
?lang=espa%C3%B1ol&code=foo+bar
</pre>

<p>Any parameter with a NULL value will be left out.</p>

<pre class="brush:php">
$query = array(
	'empty' => '',
	'null' => NULL,
	'zero' => 0,
);

echo URL::query($query); // "?empty=&zero=0"
</pre>

<p>A "?" will be added to the start of the result string, only if applicable.</p>

<pre class="brush:php">
$url = URL::site('controller/action'); // "/controller/action"

echo $url.URL::query(array('foo' => 'foo')); // "/controller/action?foo=foo"
echo $url.URL::query(array('foo' => NULL)); // "/controller/action"

$url .= http_build_query(array('foo' => 'foo'));
echo $url; // "/controller/actionfoo=foo" &lt;- Notice missing "?"
</pre>

<p><strong class="caution">Caution:</strong> Something to watch out for is, any parameter available in <code>$_GET</code> will be appended to the query string.</p>

<pre class="brush:php">
// $_GET: foo=foo

echo URL::query();

// Result
?foo=foo

echo URL::query(array('bar' => 'bar'));

// Result
?foo=foo&bar=bar
</pre>

<p>To turn this off and not merge any GET parameters, pass <code>FALSE</code> as the second param.</p>

<pre class="brush:php">
// $_GET: foo=foo

echo URL::query(array('bar' => 'bar'), FALSE);

// Result
?bar=bar
</pre>

<p>If there's a key name collision, the supplied array will override the values set in <code>$_GET</code>.</p>

<pre class="brush:php">
// $_GET: foo=foo

echo URL::query(array(
	'foo' => 'custom foo',
));

// Result
?foo=custom+foo
</pre>

<h2>title<code>($title, $separator = '-', $ascii_only = FALSE)</code></h2>

<p><code>title()</code> helps you convert any arbitrary string into a URL-safe title. <code><a href="http://php.net/rawurlencode">rawurlencode()</a></code> is not suitable for such a task, because we want the string to be humanly readable.</p>

<p>e.g. you can use it to embed a blog title in the URL, which would help usability and SEO.</p>

<pre class="brush:php">
echo URL::title('Kohana: The Swift PHP Framework'); // "kohana-the-swift-php-framework"
</pre>
