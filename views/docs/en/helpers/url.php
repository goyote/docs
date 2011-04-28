<h1>URL</h1>

<p>The <code>URL</code> class is self explanatory. It helps you build URLs which can then be used to build HTML links. Before you move any further, make sure you have the correct <code>RewriteBase</code> and "base_url" settings defined in your project.</p>

<pre class="brush:php">
// Apache conf, or htaccess file
example.com/index.php
RewriteBase /

example.com/kohana/index.php
RewriteBase /kohana/

example.com/demos/example1/index.php
RewriteBase /demos/example1/

// Bootstrap file
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

<h2>site<code>($uri = '', $protocol = NULL, $index = TRUE)</code></h2>

<p><code>site()</code> comes in handy when you want to prepend the base URL of the website to a URL path. i.e. <code>URL::base() + $your_path</code>.</p>

<pre class="brush:php">
// Given these settings
example.com/demos/example1/index.php
RewriteBase /demos/example1/
'base_url' => '/demos/example1/'

// With no arguments, site() is just a proxy to base(), i.e. URL::base() + ""
echo URL::base(); // "/demos/example1/"
echo URL::site(); // "/demos/example1/"

// When a path is given, it works like: URL::base() + $path
echo URL:site('controller/action'); // "/demos/example1/controller/action"
echo URL:site('controller/action', TRUE); // "http://example.com/demos/example1/controller/action"
</pre>

<p>Be aware that <code>site()</code> will <code>rawurlencode()</code> non-ascii characters.</p>

<pre class="brush:php">
echo URL::site("controller/action?lang=español&spaces=one two"); // "/demos/example1/controller/action%3Flang%3Despa%C3%B1ol%26spaces%3Done%20two"
</pre>

<h2>query<code>(array $params = NULL, $use_get = TRUE)</code></h2>

<p><code>query()</code> is pretty much a smarter <code><a href="http://php.net/http_build_query">http_build_query()</a></code>.</p>