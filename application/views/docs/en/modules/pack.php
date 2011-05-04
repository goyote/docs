<h1>Pack</h1>

<p>Pack has two main features:</p>

<ol>
	<li>
		<p><strong>Better asset management.</strong> With Pack, all assets are defined in one file.</p>
	</li>
	<li>
		<p><strong>Fast page rendering.</strong> Pack concatenates and compresses JavaScript and CSS files.</p>
	</li>
</ol>

<h2>Installation</h2>

<p>Open a terminal, and type the following commands:</p>

<pre class="brush:bash">
cd your_project/modules
git clone git://github.com/goyote/pack.git pack
cd pack
git submodule init
git submodule update
</pre>

<p>If your project is a git repo already, add it as a submodule.</p>

<pre class="brush:bash">
cd your_project
git submodule add git://github.com/goyote/pack.git modules/pack
git submodule init
cd your_project/modules/pack
git submodule init
git submodule update
</pre>

<p>Once you have all the files in place, open the bootstrap file and tweak the <code>Kohana::modules()</code> function call:</p>

<pre class="brush:php">
Kohana::modules(array(
	'pack' => MODPATH.'pack', // Asset packaging
	...
));
</pre>

<h2>Usage</h2>

<p>Create a new config file under <code>application/config/pack.php</code>.</p>

<pre class="brush:php">
/**
 * Pack configuration settings.
 *
 * @link  http://kowut.com/modules/pack#usage
 */
return array(
	/**
	 * Group your CSS files into "packages."
	 */
	'css' => array(
		'package1' => array(
			'assets/css/reset.css',
			'assets/css/print.css',
			'assets/css/global.css',
			'assets/css/theme1.css',
		),
		'package2' => ...
	),
	
	/**
	 * Group your JavaScript files into packages too.
	 */
	'js' => array(
		'package1' => array(
			'assets/js/plugins/jquery.newsticker.js',
			'assets/js/global.js',
			'assets/js/theme1.js',
		),
		'package2' => ...
	),
);
</pre>

<p>Next, create the files defined above. These are placed relative to whatever is specified in <code>$config['root']</code>, which is the <code>DOCROOT</code> by default.</p>

<p>Once the files are in place, you can render a package in the following manner:</p>

<pre class="brush:php">
&lt;html&gt;
	&lt;head&gt;
		...
		&lt;?php echo Pack::css('package1') ?&gt;
	&lt;/head&gt;
	&lt;body&gt;
		...
		&lt;?php echo Pack::js('package1') ?&gt;
	&lt;/body&gt;
&lt;/html&gt;
</pre>

<p>You can also render several packages at once:</p>

<pre class="brush:php">
echo Pack::css(array('package1', 'package2'));
</pre>

<p>That's it, you can start developing your app as you normally would. Once you're ready to push live, all you have to do is hit the URL: <code>example.com/pack</code>. This will build the packages for you.</p>

<p>In development mode (when <code>$config['enabled'] === FALSE</code>,) <code>Pack::css()</code> will render the following string:</p>

<pre class="brush:html">
&lt;link type="text/css" href="/assets/css/reset.css?1304304569" rel="stylesheet" /&gt;
&lt;link type="text/css" href="/assets/css/print.css?1304479742" rel="stylesheet" /&gt;
&lt;link type="text/css" href="/assets/css/global.css?1304396786" rel="stylesheet" /&gt;
&lt;link type="text/css" href="/assets/css/theme1.css?1304479753" rel="stylesheet" /&gt;
</pre>

<p>When in production (when <code>$config['enabled'] === TRUE</code>,) <code>Pack::css()</code> will render:</p>

<pre class="brush:html">
&lt;link type="text/css" href="/assets/build/css/package1.css?1304396941" rel="stylesheet" /&gt;
</pre>
