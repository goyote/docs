<h1>Troubleshooting</h1>

<p>Yep, it happens.</p>

<p>If this is the first time you install ko, and you've hit some weird, funky error, then chances are it has something to do with <code>mod_rewrite</code>.</p>

<div class="section">

<h2><s>teh checklist</s> FAQ</h2>

<p><s>For lack of a better idea,</s> I'm gonna write this tutorial as a <s>checklist</s> question/answer list:</p>

<ul>
<li>
<p><strong>Directory APPPATH/cache must be writable</strong>. <strong>Directory APPPATH/logs must be writable</strong></p>

<p>In short: these directories are not writable by Apache. Due to file permissions, Apache is not allowed to create or write to any of the files stored inside these directories.</p>

<p>To fix the problem, you need to change the file permissions on these dirs. Start off by running a <code>ls -la</code> inside the <code>application</code> directory within the terminal app.</p>

<pre class="brush:bash">
ls -la application/
drwx------  2 www-data  www-data    68 Dec 30 14:30 cache
drwx------  2 www-data  www-data    68 Dec 30 14:30 logs
</pre>

If you're on a local machine, or are just desperate for a quick fix, then you can get away with making these dirs readable (r), writable (w), and executable (x) by everyone (User, Group and Other.)

<pre class="brush:bash">
cd application/
chmod 0777 logs/ cache/
</pre>

That should take care of the problem. However, if you want to restrict who reads, writes and executes inside these directories, e.g. Apache, then you need to find out what User.Group is Apache running on (for instances, Ubuntu defaults to www-data.www-data) and do a strategy with <code>chmod</code> and <code>chown</code>.

<pre class="brush:bash">
# Make Apache the owner of the application dir
chown -R www-data.www-data application/

# Give Apache full control
cd application/
chmod 0700 logs/ cache/
</pre>

<p>Feel free to choose the strategy that better serves your needs.</p>
</li>
<li>
<p><strong>How do I remove "index.php" from the URL?</strong></p>
	<p>Rename <code>example.htacess</code> to <code>.htaccess</code>, then keep reading this tutorial (or, read the <a href="http://kohanaframework.org/3.1/guide/kohana/tutorials/clean-urls" target="_blank">official documentation!</a> ;))</p>
</li>

<li>
<p><strong>Help! I'm getting a "404 Not Found" error.</strong></p>
	<p>Make sure the <code>RewriteBase</code> directive (within the <code>.htaccess</code> file) contains a relevant value:</p>

<pre class="brush:bash">
example.com/index.php
RewriteBase /

example.com/kohana/index.php
RewriteBase /kohana/

example.com/demos/example1/index.php
RewriteBase /demos/example1/
</pre>

	<p>If you've changed the <code>RewriteBase</code> directive above, make sure you also reflect this change in the <code>Kohana::init</code> function located within the <code>bootstrap.php</code> file:</p>

<pre class="brush:php">
Kohana::init(array(
	'base_url' => '/',
	// Or
	'base_url' => '/kohana/',
	// Or
	'base_url' => '/demos/example1/',
));
</pre>

	<div class="note">
		<div>
			<p><strong>Straight from the source:</strong> base_url &mdash; The base URL for your application. This should be the *relative* path from your DOCROOT to your `index.php` file, in other words, if Kohana is in a subfolder, set this to the subfolder name, otherwise leave it as the default.  **The leading slash is required**, trailing slash is optional.</p>
		</div>
	</div>
</li>

<li>
<p><strong>How do I remove "index.php" from auto-generated links?</strong></p>
	<p>If you have pretty or clean URLs enabled, make sure you set the <code>index_file</code> to <code>FALSE</code>, otherwise when you redirect with <code>Request::instance()->redirect()</code>, <code>index.php</code> will show up in the address bar (not so pretty anymore is it? ;))</p>

<pre class="brush:php">
Kohana::init(array(
	'index_file' => FALSE,
));
</pre>
</li>

<li><p>Make sure you have mod_rewrite enabled.</p></li>

<li>
	<p>Make sure you have <code>AllowOverride</code>  set to <code>All</code> within your vhost or within the Apache <code>httpd.conf</code> file.</p>

<pre class="brush:bash">
# This enables your htaccess rules to be read
AllowOverride All
</pre>
</li>

<li>
<p><strong>Clean (pretty) URLs aren't working on my shared hosting account!</strong></p>
	<p>If you're having problems on DreamHost or some other shared hosting, try editing the <code>.htaccess</code> file:</p>

<pre class="brush:bash">
# Change:
RewriteRule .* index.php/$0 [PT]

# To:

# Option 1
RewriteRule .* index.php?/$0 [PT,L,QSA]

# Option 2
RewriteRule .* index.php?kohana_uri=$0 [PT,L,QSA]

# Option 3
RewriteRule ^(.*)$ /index.php/$1 [L]

# If you're on shared hosting and have found luck using some
# other rewrite rule, please leave a comment: hosting/rule
</pre>
</li>


</ul>

<p>Got a problem? or a fix? Please leave a comment!</p>

</div>