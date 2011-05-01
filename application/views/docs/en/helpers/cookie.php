<h1>Cookie</h1>

<p>There's nothing special about working with browser cookies in PHP. The usage is pretty straight forward: you <strong>set</strong> and <strong>delete</strong> a cookie with <code><a href="http://php.net/setcookie">setcookie()</a></code>, and you <strong>get</strong> a cookie by looking up the cookie name in the <code>$_COOKIE</code> superglobal. Do we really need an abstraction layer? Yes. Three reasons:</p>

<ol>
	<li>The Cookie helper adds a consistent, unified api for dealing with cookies: <code>set()</code>, <code>get()</code> and <code>delete()</code>.</li>
	<li>Project-wide cookie settings are made simple.</li>
	<li>Cookies are signed. The value of the cookie is salted with a hash to prevent malicious tampering. However, it does not obfuscate the value (it doesn't need to, since you're not storing any sensitive data in there.)</li>
</ol>

<h2>Prerequisites</h2>

<h3>Cookie::$salt <span class="normal"><em>defaults to</em> <code>NULL</code></span></h3>

<p>Kohana used to provide a default salt value, but that turned out to be a terrible idea, because:</p>

<ol>
	<li>Kohana is open source.</li>
	<li>People are stupid (forget to change the default salt.)</li>
</ol>

<p>To fix this security problem, the default salt value was removed, and people are now forced to create a new one (by throwing an exception if you don't!)</p>

<p>They're two ways to define a new, unique salt for you project:</p>

<ol>
<li>
<p>Define it in your bootstrap file:</p>

<pre class="brush:php">
// Secret salt added to cookies
Cookie::$salt = 'r4nd0m str1n6';
</pre>
</li>
<li>
<p>Extend the Cookie class:</p>
<pre class="brush:php">
class Cookie extends Kohana_Cookie {

	/**
	 * @var  string  secret salt added to cookies
	 */
	public static $salt = 'r4nd0m str1n6';

} // Cookie
</pre>
</li>
</ol>

<h2>Settings</h2>

<p>Keep in mind that you can override any of the following settings by placing the code snippet in the bootstrap file, or by extending the relevant Kohana_* class (a.k.a <a href="http://kohanaframework.org/guide/kohana/extension">transparent class extension</a>.)</p>

<h3>Cookie::$expiration <span class="normal"><em>defaults to</em> <code>0</code></span></h3>

<p>By default, cookies expire at the end of the browser session (i.e. when <code>Cookie::$expiration === 0</code>.) To extend the lifetime, you need to provide an expiration time in seconds.</p>

<pre class="brush:php">
// The promotion lasts 30 days
Cookie::set('promo', '3876', Date::DAY * 30);
</pre>

<p>You can also set a default expiration time:</p>

<pre class="brush:php">
// All cookies should last 1 week by default
Cookie::$expiration = Date::WEEK;
</pre>

<h3>Cookie::$path <span class="normal"><em>defaults to</em> <code>'/'</code></span></h3>

<p>The path on the server in which the cookie will be available on. If set to <code>'/'</code>, the cookie will be available within the entire domain. If set to <code>'/foo/'</code>, the cookie will only be available within the <code>/foo/</code> directory and all sub-directories such as <code>/foo/bar/</code> of domain.</p>

<h3>Cookie::$domain <span class="normal"><em>defaults to</em> <code>NULL</code></span></h3>

<p>The domain that the cookie is available to. To make the cookie available on all subdomains of example.com (including example.com itself) then you'd set it to '.example.com'. Setting the domain to 'www.example.com' or '.www.example.com' will make the cookie only available in the www subdomain.</p>

<h3>Cookie::$secure <span class="normal"><em>defaults to</em> <code>FALSE</code></span></h3>

<p>Indicates that the cookie should only be transmitted over a secure HTTPS connection from the client. When set to <code>TRUE</code>, the cookie will only be set if a secure connection exists. On the server-side, it's on the programmer to send this kind of cookie only on secure connection.</p>

<h3>Cookie::$httponly <span class="normal"><em>defaults to</em> <code>FALSE</code></span></h3>

<p>When <code>TRUE</code> the cookie will be made accessible only through the HTTP protocol. This means that the cookie won't be accessible by scripting languages, such as JavaScript.</p>

<h2>set<code>($name, $value, $expiration = NULL)</code></h2>

<p><code>Cookie::set()</code> allows you to set a new cookie or update an existing one.</p>
<pre class="brush:php">
// Set the preferred language
Cookie::set('lang', 'es');
</pre>

<p>As mentioned earlier, you can override the default expiration time:</p>
<pre class="brush:php">
// Save the language preference for 1 year
Cookie::set('lang', 'es-mx', Date::YEAR);
</pre>

<h2>get<code>($key, $default = NULL)</code></h2>

<p><code>Cookie::get()</code> allows you to retrieve a cookie value.</p>
<pre class="brush:php">
// Get the preferred language
$lang = Cookie::get('lang');
</pre>

<p>If the cookie doesn't exist, <code>NULL</code> will be returned. To override the default value, pass a second argument:</p>
<pre class="brush:php">
// Use english in case no language is found
$lang = Cookie::get('lang', 'en');
</pre>
<p><strong class="caution">Caution:</strong> Typically, you'll want to pair <code>Cookie::set()</code> and <code>Cookie::get()</code> together. <code>setcookie()</code> and <code>Cookie::get()</code> are not compatible, unless you're manually salting the cookies, at which point, why bother using the <code>Cookie</code> class?</p>

<h2>delete<code>($name)</code></h2>

<p><code>Cookie::delete()</code> deletes a cookie:</p>

<pre class="brush:php">
Cookie::delete('lang');

Cookie::get('lang'); // NULL
</pre>

<p>The cookie becomes immediately unavailable, as oppose to waiting for a browser refresh.</p>
