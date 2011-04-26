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
