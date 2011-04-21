<h1>Feed</h1>

<p>Feed (short for "RSS feed") helps you generate a feed from a properly structured array. It can also transform an existing feed into a working PHP array. We'll take a look at both next.</p>

<h2>parse<code>($feed, $limit = 0)</code></h2>

<p><code>parse()</code> transforms a <abbr title="Extensible Markup Language">XML</abbr> document - specifically <abbr title="Really Simple Syndication">RSS</abbr> or Atom - into a PHP array. The first argument (<code>$feed</code>) can be any of the following:</p>

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

<h2>create<code>($info, $items, $format = 'rss2', $encoding = 'UTF-8')</code></h2>
