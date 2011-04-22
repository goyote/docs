<h1>Installation</h1>

<p>There are two ways to install Kohana. You can install ko through the command-line using git, or you can install ko manually using the good ol' mouse. We'll cover both next.</p>

<div class="section">

<h2>Manual Installation</h2>

<p>If you like watching videos, I've prepared a <a href="http://youtu.be/7p17AM0J-dk?hd=1" target="_blank">video-tut</a> on youtube that should guide you through the whole installation process. However, if you don't like watching videos, then follow these steps:</p>

<ol>
<li>
	<p>Go to <a href="http://kohanaframework.org/" target="_blank">http://kohanaframework.org/</a>.</p>
</li>

<li>
	<p>Download the zip file that contains the framework by clicking on the download link.</p>
</li>

<li>
<p>On your server or personal computer (localhost,) create the following directory structure:</p>
<pre class="brush:bash">
/www/
	website1/
		application/
		htdocs/
		logs/
	website2/
		application/
		htdocs/
		logs/
	kohana/
		3.0.8/
		3.0.9/
		3.1/
	modules/
</pre>

<p>If you like using the terminal, you can achieve the previous structure by typing the following commands:</p>

<pre class="brush: bash">
cd /
mkdir -p www/{website1/{application,htdocs,logs},kohana/{3.0.9,3.1},modules}
tree www

# Or
find www
</pre>

<div class="note">
	<div>
		<p><strong>Note:</strong> On windows, the <code>/www</code> directory would be the equivalent to <code>C:\www</code>.</p>
	</div>
</div>
</li>
<li>
<p>If you downloaded version 3.0.9 of ko, extract the zip files into the <code>/www/kohana/3.0.9</code> directory. Then copy-paste the <code>/www/kohana/3.0.9/application</code> folder into the <code>/www/website1</code> directory, and also copy-paste the <code>/www/kohana/3.0.9/modules</code> directory into the <code>/www</code> directory. Your final directory structure should look like:</p>
<p><img src="http://kohanaftw.com/wordpress/wp-content/uploads/2011/01/www-tree.png" alt="" title="www-tree" width="198" height="667" class="alignnone size-full wp-image-28" /></p>
</li>

<li>
<p>Copy-paste the <code>index.php</code>, <code>install.php</code> and <code>example.htaccess</code> files found inside <code>3.0.9</code> into <code>website1/htdocs</code>. Keep in mind that <code>htdocs</code> will serve as the <code>DocumentRoot</code> for website1.</p>

<p><img src="http://kohanaftw.com/wordpress/wp-content/uploads/2011/01/website1-tree.png" alt="" title="website1-tree" width="175" height="128" class="alignnone size-full wp-image-29" /></p>
</li>

<li>

<p>Rename <code>example.htaccess</code> to <code>.htaccess</code> (assuming Apache's <code>AccessFileName</code> directive is set to <code>.htaccess</code>.)</p>
<pre class="brush:bash">
cd /www/website1/htdocs/
mv example.htaccess .htaccess
</pre>
</li>

<li>
<p>Create the apache access and error log files.</p>

<pre class="brush:bash">
cd /www/website1/logs/
touch error.log access.log
</pre>

<p><img src="http://kohanaftw.com/wordpress/wp-content/uploads/2011/01/logs-tree.png" alt="" title="logs-tree" width="137" height="110" class="alignnone size-full wp-image-30" /></p>
</li>

<li>
	<p>Open <code>website1/htdocs/index.php</code> and update the relative paths stored inside the <code>$application</code>, <code>$modules</code> and <code>$system</code> variables to reflect the new paths needed to reach those respective folders. If you've followed along, the following paths should work:</p>

<pre class="brush:php">
// Inside /www/website1/htdocs/index.php
$application = '../application';
$modules = '../../modules';
$system = '../../kohana/3.0.9/system';
</pre>
</li>

<li>
	<p>Now open your <code>hosts</code> file and create the following redirect rule:</p>

<pre class="brush:bash">
# Tweak "127.0.0.1" to suit your needs
127.0.0.1 website1 www.website1
</pre>

	<div class="note">
		<div>
			<p><strong>Note:</strong> If you're on a mac or linux your <code>hosts</code> file is located here: <code>/etc/hosts</code>. If you're on a windows machine, you can locate the hosts file here: <code>C:\Windows\System32\drivers\etc\hosts</code>.</p>
		</div>
	</div>
</li>

<li>
<p>Now you're gonna need a new virtual host for <em>website1</em>. Locate the virtual hosts section within your apache <code>httpd.conf</code> file, and add the following vhost block (if you're on mac/linux, remove "C:"):</p>

<pre class="brush:bash">
NameVirtualHost *:80

&lt;VirtualHost *:80&gt;
    ServerAdmin lol@gmail.com
    DocumentRoot "C:/www/website1/htdocs"
    ServerName website1
    ServerAlias www.website1

	&lt;Directory "C:/www/website1/htdocs"&gt;
		Options Indexes FollowSymLinks
		AllowOverride All
		Order allow,deny
		Allow from all
	&lt;/Directory&gt;

    ErrorLog "C:/www/website1/logs/error.log"
    CustomLog "C:/www/website1/logs/access.log" combined
&lt;/VirtualHost&gt;
</pre>

<p>Now restart Apache:</p>

<pre class="brush:bash">
# Change to super user
su root
# Or if you're on ubuntu
sudo -s

/etc/init.d/apache2 graceful
# Or
/etc/init.d/apache2 restart
</pre>

<div class="note">
	<div>
		<p><strong>Note:</strong> If you're using XAMPP, you can add a vhost in: <code>C:\xampp\apache\conf\extra\httpd-vhosts.conf</code></p>
	</div>
</div>
</li>

<li>
	<p>Make sure you have the apache rewrite module enabled, like so:</p>
<pre class="brush:bash">
# Somewhere in your apache conf file...
# Make sure the line doesn't start with a "#" (pound or hash) character
LoadModule rewrite_module /usr/lib/apache2/modules/mod_rewrite.so
</pre>
</li>

<li><p>Open your favorite browser, and hit the URL: <code>http://website1</code>.</p></li>

<li>
	<p>You'll arrive at the checkup page. Make sure you have all green lights. If you hit an error, proceed to the <a href="/<?php echo I18n::$lang ?>/start_here/troubleshooting">troubleshooting page</a>.</p>
</li>

<li>
	<p>If all is well, delete the <code>website1/htdocs/install.php</code> file, and reload the page. You should now see the heart warming "hello, world!" message.</p>
</li>

<li><p>Rejoyce.</p></li>
</ol>

<p>Did you encounter an error? No worries, I've prepared a <a href="/<?php echo I18n::$lang ?>/start_here/troubleshooting">troubleshooting page</a>!</p>

</div>

<div class="section">

<h2>Command-line Installation</h2>

<p>The Kohana project is hosted on GitHub, which means you can do a lot of cool stuff, like fork the project, submit patches or clone the ko repo into your personal projects and keep it up to date with ease.</p>

</div>