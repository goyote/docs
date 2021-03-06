<h1>Feed</h1>

<p>Feed (short for "RSS feed") is a handy tool that helps you transform an existing feed into a working PHP array.</p>

<h2>parse<code>($feed, $limit = 0)</code></h2>

<p><code>parse()</code> will transform a <abbr title="Extensible Markup Language">XML</abbr> document - specifically <abbr title="Really Simple Syndication">RSS</abbr> or Atom - into a PHP array. The first argument (<code>$feed</code>) can be any of the following:</p>

<ol>
<li><p>A raw string of XML code.</p>

<pre class="brush:php">
$rss = &lt;&lt;&lt;RSS
&lt;?xml version="1.0" encoding="UTF-8"?&gt;
&lt;rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:feedburner="http://rssnamespace.org/feedburner/ext/1.0" version="2.0"&gt;
	&lt;channel&gt;
		&lt;item&gt;
			&lt;title&gt;Some feed item&lt;/title&gt;
			&lt;link&gt;http://www.example.com/article34&lt;/link&gt;
			&lt;description&gt;This article is really cool!&lt;/description&gt;
			&lt;author&gt;Aart-Jan Boor&lt;/author&gt;
			&lt;pubDate&gt;Sat, 08 Dec 2007 13:28:11 GMT&lt;/pubDate&gt;
		&lt;/item&gt;
		&lt;item&gt;
			&lt;title&gt;Some feed item2&lt;/title&gt;
			&lt;link&gt;http://www.example.com/article546&lt;/link&gt;
			&lt;description&gt;This article is really cool too!&lt;/description&gt;
			&lt;author&gt;Aart-Jan Boor&lt;/author&gt;
			&lt;pubDate&gt;Sat, 08 Dec 2007 12:57:56 GMT&lt;/pubDate&gt;
		&lt;/item&gt;
		&lt;item&gt;
			&lt;title&gt;Some feed item3&lt;/title&gt;
			&lt;link&gt;http://www.example.com/article4523&lt;/link&gt;
			&lt;description&gt;This article is the best!&lt;/description&gt;
			&lt;author&gt;Aart-Jan Boor&lt;/author&gt;
			&lt;pubDate&gt;Sat, 08 Dec 2007 12:39:42 GMT&lt;/pubDate&gt;
		&lt;/item&gt;
	&lt;/channel&gt;
&lt;/rss&gt;
RSS;

$feed = Feed::parse($rss);

// $feed
Array
(
    [0] => Array
        (
            [title] => Some feed item
            [link] => http://www.example.com/article34
            [description] => This article is really cool!
            [author] => Aart-Jan Boor
            [pubDate] => Sat, 08 Dec 2007 13:28:11 GMT
        )

    [1] => Array
        (
            [title] => Some feed item2
            [link] => http://www.example.com/article546
            [description] => This article is really cool too!
            [author] => Aart-Jan Boor
            [pubDate] => Sat, 08 Dec 2007 12:57:56 GMT
        )

    [2] => Array
        (
            [title] => Some feed item3
            [link] => http://www.example.com/article4523
            [description] => This article is the best!
            [author] => Aart-Jan Boor
            [pubDate] => Sat, 08 Dec 2007 12:39:42 GMT
        )
)
</pre>
	</li>
	<li>
		<p>A file located on the same server, i.e. the path to the file.</p>
	</li>

	<li>
		<p>An external feed, e.g. a FeedBurner URL.</p>

<pre class="brush:php">
if (($feed = Cache::instance()->get('feed')) === NULL)
{
	// GitHub atom feed URL
	$url = 'https://github.com/goyote/docs/commits/master.atom';

	// Grab the 10 latest entries
	$entries = Feed::parse($url, 10);

	$feed = array();
	foreach ($entries as $entry)
	{
		$feed[] = array(
			'title' => $entry['title'],
			'href' => (string) $entry['link']['href'],
			'date' => Date::formatted_time($entry['updated'], 'n-d-Y'),
		);
	}

	// Cache the entries for 1 day
	Cache::instance()->set('feed', $feed, Date::DAY);
}

$view->feed = $feed;

&lt;ul class="updates"&gt;
	&lt;?php foreach ($feed as $entry): ?&gt;
		&lt;li&gt;
			&lt;span class="date"&gt;[&lt;?php echo HTML::chars($entry['date']) ?&gt;]&lt;/span&gt;
			&lt;?php echo HTML::anchor(HTML::chars($entry['href']), HTML::chars($entry['title'])) ?&gt;
		&lt;/li&gt;
	&lt;?php endforeach ?&gt;
&lt;/ul&gt;
</pre>
	</li>
</ol>
	
<h2>create<code>($info, $items, $format = 'rss2', $encoding = 'UTF-8')</code></h2>

<p>Honestly, <code>create()</code> seems too cumbersome for my taste. I would much rather treat the XML as I currently treat HTML, and place the RSS code in a view. Maintenance just seems easier that way. Plus, you would then have the option to build an atom feed, as currently <code>create()</code> only supports RSS 2.0.</p>

<p>There are many ways to tackle this problem, and it all depends on your needs. I'm going to go with the simplest route, and assume that you want a static RSS feed served from the URL: <code>example.com/rss</code>.</p>

<pre class="brush:php">
class Controller_RSS extends Controller {

	public function action_index()
	{
		// Get the data from its natural source
		$data = ...

		$this->_create_feed($data);
	}

	/**
	 * Creates a RSS or Atom feed based on the source data.
	 *
	 * @param  array
	 */
	protected function _create_feed(array $data)
	{
		$format = strtolower(Arr::get($_GET, 'format', 'rss'));

		// RSS needs xml mime type for autodiscovery
		$mime = File::mime_by_ext(($format === 'rss') ? 'xml' : $format);
		$this->response->headers('content-type', $mime.'; charset='.Kohana::$charset);

		// Will throw error if format is not RSS or Atom
		$view = new View('feed/'.$format, array('data' => $data));
	
		$this->response->body($view->render());
	}

} // Controller_RSS
</pre>

<p>The RSS view <code>views/feed/rss.php</code>:</p>

<pre class="brush:php">
&lt;?php echo '&lt;?xml version="1.0" encoding="'.Kohana::$charset.'"?'.'&gt;'; ?&gt;

&lt;rss version="2.0"
	xmlns:content="http://purl.org/rss/1.0/modules/content/"
	xmlns:wfw="http://wellformedweb.org/CommentAPI/"
	xmlns:dc="http://purl.org/dc/elements/1.1/"
	xmlns:atom="http://www.w3.org/2005/Atom"
	xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
	xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
&gt;

&lt;channel&gt;
	&lt;title&gt;RSS Example&lt;/title&gt;
	&lt;description&gt;This is an example of an RSS feed&lt;/description&gt;
	&lt;link&gt;&lt;?php echo rtrim(URL::site(NULL, TRUE), '/') ?&gt;&lt;/link&gt;
	&lt;language&gt;&lt;?php echo I18n::$lang ?&gt;&lt;/language&gt;
	&lt;?php foreach ($data as $item): ?&gt;
		&lt;item&gt;
			&lt;title&gt;&lt;?php echo $item['title'] ?&gt;&lt;/title&gt;
			&lt;description&gt;
				&lt;![CDATA[
					&lt;?php echo $item['description'] ?&gt;
				]]&gt;
			&lt;/description&gt;
			&lt;link&gt;&lt;/link&gt;
			&lt;guid&gt;&lt;/guid&gt;
			&lt;pubDate&gt;&lt;?php echo date(DATE_RSS, $item['created']) ?&gt;&lt;/pubDate&gt;
		&lt;/item&gt;
	&lt;?php foreach ?&gt;
&lt;/channel&gt;

&lt;/rss&gt;
</pre>

<!--<p>The Atom view <code>views/feed/atom.php</code>:</p>-->

<p>Once you're done, I recommend you burn your feeds with <a href="http://www.feedburner.com">FeedBurner</a>. FeedBurner allows you to track how many people subscribe to your feed, offer update notifications through email, analytics, and much more. Plus, it's free.</p>