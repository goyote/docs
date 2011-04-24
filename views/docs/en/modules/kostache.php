<h1>Kostache</h1>

<p>Kostache is a view replacement. You can still use views if you want, but that's highly unlikely since Kostache does the same stuff, plus more. Kostache has three main selling points:</p>

<ol>
	<li><strong>Automatic variable escaping.</strong> Variables get escaped automatically before hitting the DOM. This helps avoid <a href="http://ha.ckers.org/xss.html">XSS</a> attacks, and stories similar to <a href="http://namb.la/popular/tech.html">this one</a>.</li>
	<li><strong>Logic-less templates.</strong> Mustache files (<code>*.mustache</code>) are called templates. You can't execute PHP code in mustache templates. This sounds like the worst idea ever, and you're gonna hate it at first, but soon after you'll find it more convenient to embed view logic one level up.</li>
	<li><strong>View Models.</strong> Instead of spamming the controller with view logic, a view class exists so you can embed the logic there.</li>
</ol>

<p><strong>Cons:</strong></p>

<ol>
	<li>Kostache is slower than views, due to its heavy usage of regular expressions and view logic overhead.</li>
</ol>

<h2>Installation</h2>

<p>You'll want to checkout the github project located at <a href="http://github.com/zombor/kostache">http://github.com/zombor/kostache</a>, by cloning it:</p>

<pre class="brush:php">
cd modules
git clone git://github.com/zombor/KOstache.git kostache
</pre>

<p>Or if your project is already a git repo, then add it as a submodule:</p>

<pre class="brush:php">
# From the root of the repo
git submodule add git://github.com/zombor/KOstache.git modules/kostache
</pre>

<p>If you're lazy, and don't want to fire up a terminal, then you can simply download the zip file from <a href="http://github.com/zombor/kostache">http://github.com/zombor/kostache</a> and extract the "kostache" folder inside the "modules" directory.</p>

<p>Once you have the files in place, open the bootstrap file and enable the module by modding the <code>Kohana::modules()</code> function call in the following manner:</p>

<pre class="brush:php">
/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'kostache'      => MODPATH.'kostache'    // Mustache templates
	// 'auth'       => MODPATH.'auth',       // Basic authentication
	// 'cache'      => MODPATH.'cache',      // Caching with multiple backends
	// 'codebench'  => MODPATH.'codebench',  // Benchmarking tool
	// 'database'   => MODPATH.'database',   // Database access
	// 'image'      => MODPATH.'image',      // Image manipulation
	// 'orm'        => MODPATH.'orm',        // Object Relationship Mapping
	// 'unittest'   => MODPATH.'unittest',   // Unit testing
	// 'userguide'  => MODPATH.'userguide',  // User guide and API documentation
));
</pre>

<h2>Hello World!</h2>

<p>I know you're dying for a juicy hello world tutorial; you love those don't you ;) Here goes. So far with views, you've been using the handy dandy template controller. Sadly, Kostache doesn't provide one for you, so we'll create one ourselves!</p>

