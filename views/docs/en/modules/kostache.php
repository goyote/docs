<h1>Kostache</h1>

<p>Kostache is a view replacement. You can still use views if you want, but that's highly unlikely since Kostache does the same stuff, plus more. Kostache has three main selling points:</p>

<ol>
	<li><strong>Automatic variable escaping.</strong> Variables get escaped automatically before hitting the DOM. This helps avoid <a href="http://ha.ckers.org/xss.html">XSS</a> attacks, and stories similar to <a href="http://namb.la/popular/tech.html">this one</a>.</li>
	<li><strong>Logic-less templates.</strong> Mustache files (<code>*.mustache</code>) are called templates. You can't execute PHP code in mustache templates. This sounds like the worst idea ever, and you're gonna hate it at first, but soon after you'll find it more convenient to embed view logic one level up.</li>
	<li><strong>View Models.</strong> Instead of spamming the controller with view logic, a view class exists so you can embed the logic there.</li>
</ol>

<p><strong>Cons:</strong></p>

<ol>
	<li>Kostache is slower than views, mainly due to its heavy usage of regular expressions and view logic overhead.</li>
</ol>

<h2>Installation</h2>

<p>You'll want to checkout the github project located at <a href="http://github.com/zombor/kostache">http://github.com/zombor/kostache</a>, by cloning it:</p>

<pre class="brush:php">
cd modules
git clone git://github.com/zombor/KOstache.git kostache
cd kostache
git submodule init
git submodule update
</pre>

<p>Or if your project is already a git repo, add it as a submodule:</p>

<pre class="brush:php">
# From the root of the repo
git submodule add git://github.com/zombor/KOstache.git modules/kostache
git submodule init
git submodule update
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

<p>I know you're dying for a hello world tutorial. Buckle up, here goes.</p>

<p>So far with views, you've been using the handy dandy template controller. Sadly, Kostache doesn't provide one for you; no worries, we'll create one ourselves! You can either create a layout controller, or in my case, simply hijack the controller class. If later down the road you find the need to extend the normal controller class, you may do so by extending <code>Kohana_Controller</code>.</p>

<p>application/classes/controller.php <small>Based on <a href="https://github.com/vendo/core/blob/develop/classes/controller.php">Vendo</a>.</small></p>

<pre class="brush:php">
&lt;?php defined('SYSPATH') or die('No direct script access.');
/**
 * Abstract controller class for automatic templating.
 *
 * @package    Kohana
 * @category   Controller
 * @author     Kohana Team
 * @copyright  (c) 2008-2011 Kohana Team
 * @license    http://kohanaframework.org/license
 */
abstract class Controller extends Kohana_Controller {

	/**
	 * @var  Kostache  page template
	 */
	public $layout;

	/**
	 * @var  bool  auto render template
	 **/
	public $auto_render = TRUE;

	/**
	 * Loads the template [Kostache] object.
	 */
	public function before()
	{
		if ($this->auto_render === TRUE)
		{
			if ($directory = $this->request->directory())
			{
				// We have a directory set in the route
				$directory .= '/';
			}

			$this->layout = Kostache::factory(
				$directory.$this->request->controller().'/'.$this->request->action()
			);
		}

		return parent::before();
	}

	/**
	 * Assigns the template [Kostache] as the request response.
	 */
	public function after()
	{
		if ($this->auto_render === TRUE)
		{
			$this->response->body($this->layout->render());
		}

		return parent::after();
	}

} // Controller
</pre>

<p>Extending the previous controller has the following effects:</p>

<ol>
	<li>It avoids writing redundant crap like <code>$this->response->body(new View_Welcome_Index)</code> in every action, or at the very least manually instantiating the view class.</li>
	<li>Speeds up development <code>===</code> one less thing to worry about.</li>
	<li>Forces intuitive file organization (view/controller/action.php) <code>===</code> win for your peers.</li>
</ol>

<h3>Welcome Controller</h3>

<p>Now, let's move one level up, and create our example controller.</p>

<p>application/classes/controller/welcome.php</p>

<pre class="brush:php">
class Controller_Welcome extends Controller {

	public function action_index() {}

} // Controller_Welcome
</pre>

<p>You'll notice lighter controllers when using Kostache.</p>

<h3>View Class</h3>

<p>Every page has a corresponding view class that passes data to it. e.g. to add a testimonials, and client list page to your about us section, you would need to create the following files:</p>

<pre class="brush:php">
// Controller
application/classes/controller/about.php
	- action_testimonials()
	- action_clients()

// Views
application/classes/view/about/testimonials.php
application/classes/view/about/clients.php

// Templates
application/templates/about/testimonials.mustache
application/templates/about/clients.mustache
</pre>

<p>Knowing this pattern, let's create a view class for our hello world example:</p>

<p>application/classes/view/welcome/index.php</p>

<pre class="brush:php">
class View_Welcome_Index extends Kostache_Layout {}
</pre>

<h2>Kostache_Layout</h2>

<p>If you're guessing that the only thing pending is the creation of the <code>application/templates/welcome/index.mustache</code> file, you'd be correct. However, we're going to take a one step back, and talk about the <code>Kostache_Layout</code> class.</p>

<pre class="brush:php">
// There's a slight difference between extending Kostache
class View_Welcome_Index extends Kostache {}

// And extending the Kostache_Layout class
class View_Welcome_Index extends Kostache_Layout {}

// Given the following snippet
echo new View_Welcome_Index;

// If the view class extends Kostache, the following template will be rendered
application/templates/welcome/index.mustache

// However, if the view class extends Kostache_Layout, the contents of
application/templates/welcome/index.mustache
e.g.
Hello world!

// Will be rendered as a partial (the partial having the default name
// of "content") inside the layout template
application/templates/layout.mustache
e.g.
&lt;html&gt;
	&lt;head&gt;&lt;/head&gt;
	&lt;body&gt;
		{{&gt;content}} // "{{&gt;content}}" will dump the content found in application/templates/welcome/index.mustache
	&lt;/body&gt;
&lt;/html&gt;
</pre>

<p>This is pretty cool. The only problem I have with the default <code>layout.mustache</code> template provided by Kostache, is that it's completely useless and serves as a bad example because the <code>content</code> partial is dumped inside a <code>&lt;p&gt;</code> tag! A &lt;div&gt; would've been a better choice. Plus, a good default would make it easier to copy-paste and improve upon, as well as promote best practices.</p>

<p><strong>Why not use the <a href="http://html5boilerplate.com/">html5 boilerplate</a> as the default?</strong> I would only use the HTML though, and nothing else. Remember, we're not looking for a bloated solution, just something useful to get started with. As long as the dev is aware that html5 boilerplate is being used as the basis, he could then proceed to look more into it, and incorporate other pieces that fit into his needs.</p>

<p>application/templates/layout.mustache</p>

<pre class="brush:php">
&lt;!DOCTYPE html&gt;
&lt;!--[if lt IE 7 ]&gt; &lt;html class="no-js ie6" lang="{{lang}}"&gt; &lt;![endif]--&gt;
&lt;!--[if IE 7 ]&gt;    &lt;html class="no-js ie7" lang="{{lang}}"&gt; &lt;![endif]--&gt;
&lt;!--[if IE 8 ]&gt;    &lt;html class="no-js ie8" lang="{{lang}}"&gt; &lt;![endif]--&gt;
&lt;!--[if (gte IE 9)|!(IE)]&gt;&lt;!--&gt; &lt;html class="no-js" lang="{{lang}}"&gt; &lt;!--&lt;![endif]--&gt;
	&lt;head&gt;
		&lt;meta charset="{{charset}}"&gt;
		&lt;title&gt;{{title}}&lt;/title&gt;
	&lt;/head&gt;
	&lt;body&gt;
		&lt;div id="container"&gt;
			{{&gt;content}}	
		&lt;/div&gt;
	&lt;/body&gt;
&lt;/html&gt;
</pre>

<p>To fill up these default values, customize the <code>Kostache_Layout</code> class like so:</p>

<p>application/classes/kostache/layout.php <small>Taken from <a href="https://github.com/shadowhand/shadowhand.me/blob/master/application/classes/view/home.php">shadowhand.me</a></small></p>

<pre class="brush:php">
abstract class Kostache_Layout extends Kohana_Kostache_Layout {

	/**
	 * @var  string  character set of input and output
	 */
	public $charset;

	/**
	 * @var  string  target language: en-us, es-es, zh-cn, etc
	 */
	public $lang;

	/**
	 * @var  bool  are we in production?
	 */
	public $production;

	/**
	 * Renders the template using the current view.
	 *
	 * @return  string
	 */
	public function render()
	{
		$this->charset = Kohana::$charset;
		$this->lang = I18n::$lang;
		$this->production = Kohana::$environment <= Kohana::STAGING;
		return parent::render();
	}

} // Kostache_Layout
</pre>

<h2>Hello World Conclusion</h2>

<p>Let's complete the hello world tutorial.</p>
<p>application/templates/welcome/index.mustache</p>

<pre class="brush:php">
hello world
</pre>

<p>Fire up a browser and load <code>example.com/welcome</code></p>

<h2>Variable Scope</h2>

<p>Templates and partials have access to the same data.</p>

<p>e.g.</p>

<pre class="brush:php">
class Controller_Welcome extends Controller {

	public function action_index() {}

} // Controller_Welcome

class View_Welcome_Index extends Kostache_Layout {

	protected $_partials = array(
		'widget' => 'widget',
	);

	/**
	 * @var  string  document title of page
	 */
	public $title = 'luls';

} // View_Welcome_Index

Given the above, $title is accessible as {{title}} in
all of the following templates:

// Template (application/templates/layout.mustache)
&lt;p&gt;{{title}}&lt;/p&gt;
&lt;p&gt;{{&gt;content}}&lt;/p&gt;
&lt;p&gt;{{&gt;widget}}&lt;/p&gt;

// Partial (application/templates/widget.mustache)
{{title}}

// Partial (application/templates/welcome/index.mustache)
{{title}}
	
// Result
&lt;p&gt;luls&lt;/p&gt;
&lt;p&gt;luls&lt;/p&gt;
&lt;p&gt;luls&lt;/p&gt;
</pre>

<h2>Precedence</h2>

<p>If a class field and method share the same name, the method takes priority.</p>

<pre class="brush:php">
class View_Welcome_Index extends Kostache_Layout {

	public $title = 'field';

	public function title()
	{
		return 'method';
	}

} // View_Welcome_Index

{{title}} // "method"
</pre>

<p>This enables interesting logic:</p>

<pre class="brush:php">
class View_About_Clients extends Kostache_Layout {

	public $title = 'Partnerships and Client List';

} // View_About_Clients

abstract class Kostache_Layout extends Kohana_Kostache_Layout {

	public $website = ' — WebApp';

	public function title()
	{
		return $this->title.$this->website;
	}

} // View_About_Clients

{{title}} // "Partnerships and Client List — WebApp"
</pre>

<h2>Visibility</h2>

<p>If you want to hide a class field or method from being available in the mustache template, give it a visibility of <code>private</code> or <code>protected</code>.</p>

<pre class="brush:php">
class View {

	public function visible()
	{
		return 'visible';
	}

	protected function not_visible()
	{
		return 'not_visible';
	}

}

{{visible}} // "visible"
{{not_visible}} // ""
</pre>

<h2>Passing Values to the Template</h2>

<pre class="brush:php">
public $title = 'foo';

{{title}} // "foo"
</pre>

<pre class="brush:php">
public function title()
{
	return 'foo';
}

{{title}} // "foo"
</pre>

<pre class="brush:php">
public $title = 'foo';

// "Title: foo"
{{#title}}
	Title: {{title}}
{{/title}}
</pre>

<pre class="brush:php">
public $title = NULL;
// Or
protected $title = 'foo';

// "" <- nothing
{{#title}}
	Title: {{title}}
{{/title}}
</pre>

<pre class="brush:php">
public function colors()
{
	return array(
		array('color' => 'red'),
		array('color' => 'blue'),
		array('color' => 'yellow'),
	);
}

// "red blue yellow"
{{#colors}}
	{{color}}
{{/colors}}

// ErrorException [ Warning ]: htmlentities() expects parameter 1 to be string, array given
{{colors}}
</pre>
