<h1>Kostache</h1>

<p>Kostache is a KO3 module that makes it easy to integrate <a href="http://mustache.github.com/">mustache</a> templates into a Kohana project. Kostache has three main selling points:</p>

<ol>
	<li><p><strong>Automatic variable escaping.</strong> Variables in mustache templates are automatically escaped before hitting the DOM; which means you don't have to do it manually with <code>HTML::chars</code> anymore. Escaping user generated content - or output in general - helps avoid <a href="http://ha.ckers.org/xss.html">XSS</a> attacks, and stories similar to <a href="http://namb.la/popular/tech.html">this one</a>.</p></li>
	<li><p><strong>Logic-less templates.</strong> Mustache files (<code>*.mustache</code>) are called "templates." You can't execute any PHP code in templates. This sounds like the worst idea ever, and you're gonna hate it at first, but soon after you'll find it more convenient to embed view logic one level up.</p></li>
	<li>
		<p><strong>View Models.</strong> Probably the most popular feature amongst the three, is the introduction of the View class. Instead of spamming the controller with view logic, a view class exists so you can embed the logic there.</p>
		<p>e.g.</p>
		<p>Before:</p>

<pre class="brush:php">
class Controller_Example extends Controller_Template {

	public function action_index()
	{
		$this->template->title = 'Document title';
	}

} // Controller_Example

echo $title;
</pre>

		<p>After:</p>

<pre class="brush:php">
class Controller_Example extends Controller {

	public function action_index() {}

} // Controller_Example

class View_Example_Index extends Kostache_Layout {

	public $title = 'Document title';

} // View_Example_Index

{{title}}
</pre>
	</li>
</ol>

<p><strong>Cons:</strong></p>

<ol>
	<li>Kostache is slower than views, mainly due to its heavy usage of regular expressions and view logic overhead.</li>
</ol>

<h2>Installation</h2>

<p>To install Kostache, you can clone the github project located at <a href="http://github.com/zombor/kostache">http://github.com/zombor/kostache</a>.</p>

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

<p>If you're lazy, and don't want to fire up a terminal, then you can download the zip file from <a href="http://github.com/zombor/kostache">http://github.com/zombor/kostache</a> and extract the "kostache" folder inside the "modules" directory.</p>

<p>Once you have the files in place, open the bootstrap file and enable the module by modding the <code>Kohana::modules()</code> function call in the following manner:</p>

<pre class="brush:php">
/**
 * Enable modules. Modules are referenced by a relative or absolute path.
 */
Kohana::modules(array(
	'kostache' => MODPATH.'kostache' // Mustache templates
	...
));
</pre>

<h2>Hello World Tutorial!</h2>

<p>Let's start by creating a controller class. You do this as you've always done it. No changes:</p>

<p>application/classes/controller/welcome.php</p>

<pre class="brush:php">
class Controller_Welcome extends Controller {

	public function action_index()
	{
		$this->response->body(new View_Welcome_Index);
	}

} // Controller_Welcome
</pre>

<p>As you can see above, the controller's job is to instantiate and echo the correct view class (we'll expand on this in just a moment.)</p>

<p>Next, we create the view class:</p>

<p>application/classes/view/welcome/index.php</p>

<pre class="brush:php">
class View_Welcome_Index extends Kostache {

	public $planet = 'world';

} // View_Welcome_Index
</pre>

<p>In Kostache, you create one view class for every action (re-read that if you need to.)</p>

<p>e.g. take a look at the following controller:</p>

<pre class="brush:php">
class Controller_About extends Controller {

	public function action_index()
	{
		$this->response->body(new View_About_Index);
	}

	public function action_testimonials()
	{
		$this->response->body(new View_About_Testimonials);
	}

	public function action_clients()
	{
		$this->response->body(new View_About_Clients);
	}

} // Controller_About

// Which is the same thing as:
class Controller_About extends Controller {
	
	public function action_index() {}
	public function action_testimonials() {}
	public function action_clients() {}

	public function after()
	{
		$this->response->body(Kostache::factory(
			$this->request->controller().'/'.$this->request->action()
		));
	}

} // Controller_About
</pre>

<p>Given the above controller, you would then need to create the following view classes:</p>

<pre class="brush:php">
class View_About_Index extends Kostache {}
class View_About_Testimonials extends Kostache {}
class View_About_Clients extends Kostache {}
</pre>

<p>And subsequent mustache templates:</p>

<pre class="brush:php">
application/templates/about/index.mustache
application/templates/about/testimonials.mustache
application/templates/about/clients.mustache
</pre>

<p>But hold on! Let's take a step back. It's important to understand, that how you name your view classes and mustache templates, will depend directly on how you name your controllers and actions. You'll find that Kostache promotes an intuitive file structure :)</p>

<p>Let's go ahead and finish our hello world example!</p>

<p>application/templates/welcome/index.mustache</p>

<pre class="brush:php">
hello {{planet}}
</pre>

<p>Fire up a browser and load <code>http://example.com/welcome.</code> Sweet.</p>

<h2>Layout Controller</h2>

<p>So far with views, you've been using the handy dandy template controller. Sadly, Kostache doesn't provide one for you; no worries, we'll create one ourselves! You can either create a layout controller, or in my case, simply hijack the controller class. If later down the road you find the need to extend the normal controller class, you may do so by extending <code>Kohana_Controller</code>.</p>

<pre class="brush:php">
abstract Controller_Layout extends Controller { ... }
</pre>

<p>Or:</p>

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
	 * @var  array  mappings to allow underscores in actions
	 */
	public $view_map;

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
				$directory .= '/';
			}

			// Look for a mapping, otherwise use the action
			$action = Arr::get(
				$this->view_map,
				$action = $this->request->action(),
				$action
			);

			$this->layout = Kostache::factory(
				$directory.$this->request->controller().'/'.$action
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

<h3>Advantages</h3>

<p>Extending the previous controller has the following effects:</p>

<ol>
	<li>
		<p>It avoids writing redundant stuff like <code>$this->response->body(new View_Welcome_Index)</code> in every action, or at the very least manually instantiating the view class.</p>
		<p>e.g. by extending this controller instead of the normal controller, we could then rewrite our hello world example, in the following manner:</p>

<pre class="brush:php">
class Controller_Welcome extends Controller {

	public function action_index() {}

} // Controller_Welcome
</pre>
		<p>In general, you'll notice lighter controllers when using Kostache.</p>
	</li>
	<li><p>Forces intuitive file organization (view/controller/action.php) <code>===</code> win for your peers.</p></li>
	<li>
		<p>A <code>$layout</code> object will become available in the action, which gives you access to the entire Kostache api.</p>
		<pre class="brush:php">
		class Controller_Welcome extends Controller {

			public function action_index()
			{
				// Override the value "world"
				$this->layout->planet = 'people';
			}

		} // Controller_Welcome

		hello {{planet}} // "hello people"
		</pre>

		<div class="image">
			<p><img src="/assets/images/modules/kostache/layout_object.png" alt="Layout Object"></p>
		</div>
	</li>
	<li>
		<p>Underscores in action names are now a reality!</p>
		<p>e.g. say you wanted to use <code>action_client_list()</code> instead of <code>action_clients()</code>:</p>
		<pre class="brush:php">
		class Controller_About extends Controller {

			/**
			 * The following mapping would have the effect of loading
			 * "View_About_Clients" instead of "View_About_Client_List".
			 */
			public $view_map = array(
				'client_list' => 'clients'
			);

			public function action_client_list() {}

		} // Controller_About

		// Subsequently
		class View_About_Clients extends Kostache {}
		application/templates/about/clients.mustache
		</pre>
	</li>
</ol>

<h2>Kostache_Layout</h2>

<p>There's a slight difference between extending <code>Kostache</code>:</p>

<pre class="brush:php">
class View_Welcome_Index extends Kostache {}
</pre>

<p>And extending the <code>Kostache_Layout</code> class:</p>

<pre class="brush:php">
class View_Welcome_Index extends Kostache_Layout {}
</pre>

<p>Given the following snippet:</p>

<pre class="brush:php">
echo new View_Welcome_Index;
</pre>

<p>If the view class extends <code>Kostache</code>, the following template will be rendered:</p>

<pre class="brush:php">
application/templates/welcome/index.mustache
</pre>

<p>However, if the view class extends <code>Kostache_Layout</code>, the contents of:</p>

<pre class="brush:php">
application/templates/welcome/index.mustache
e.g.
hello {{planet}}
</pre>

<p>Will be rendered as a partial (the partial having the default name of "content") inside the layout template:</p>

<pre class="brush:php">
application/templates/layout.mustache
e.g.
&lt;html&gt;
	&lt;head&gt;&lt;/head&gt;
	&lt;body&gt;
		{{&gt;content}} // "{{&gt;content}}" will dump the content found in application/templates/welcome/index.mustache
	&lt;/body&gt;
&lt;/html&gt;
</pre>

<h2>Partials</h2>

<p>You can think of partials as PHP includes. Partials allow you to include one template within another. You define them in the view class:</p>

<pre class="brush:php">
protected $_partials = array(
	'header' => 'header',         // Loads templates/header.mustache
	'footer' => 'footer/default', // Loads templates/footer/default.mustache
);
</pre>

<p>Then, you can dump the partial anywhere in your template by using the <code>{{>partial}}</code> syntax.</p>

<h2>Variable Scope</h2>

<p>Templates and partials have access to the same view data.</p>

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
</pre>

<p>Given the above, <code>$title</code> is accessible as <code>{{title}}</code> in all of the following templates:</p>

<pre class="brush:php">
// Template (application/templates/layout.mustache)
&lt;p&gt;{{title}}&lt;/p&gt;
&lt;p&gt;{{&gt;content}}&lt;/p&gt;
&lt;p&gt;{{&gt;widget}}&lt;/p&gt;

// Partial (application/templates/welcome/index.mustache)
{{title}}

// Partial (application/templates/widget.mustache)
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


<h2>layout.mustache</h2>

<p>The only problem I have with the default <code>layout.mustache</code> template provided by Kostache, is that it's completely useless and serves as a bad example because the <code>content</code> partial is dumped inside a <code>&lt;p&gt;</code> tag! A <code>&lt;div&gt;</code> would've been a better choice. Plus, a good default would make it easier to copy-paste and improve upon, as well as promote best practices.</p>

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

<h2>Passing Values to the Template</h2>

<p>Here's a few examples of how you can pass data from the view to the template.</p>

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
public $title = '<b>foo</b>';

// Escaped
{{title}} // "&amp;lt;b&amp;gt;world&amp;lt;/b&amp;gt;"

// Unescaped
{{{title}}} // "&lt;b&gt;world&lt;/b&gt;"
{{&title}} // "&lt;b&gt;world&lt;/b&gt;"
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
