<h1>Text</h1>

<p><code>Text</code> is a helper class that comes in handy when editing or formatting text.</p>

<h2>limit_words<code>($str, $limit = 100, $end_char = NULL)</code></h2>

<p><code>limit_words()</code> helps you limit the amount of words contained inside a string.</p>

<pre class="brush:php">
$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';

// Grab the first 4 words
$preview = Text::limit_words($text, 4);

echo $preview; // "Lorem ipsum dolor sit…"
</pre>

<p>By default the <a href="http://en.wikipedia.org/wiki/Ellipsis">ellipsis</a> (<code>&amp;hellip;</code>) character is appended to the end of the string, but you can override this setting by passing a third param.</p>

<pre class="brush:php">
$preview = Text::limit_words($text, 4, HTML::anchor("#", 'Read More'));

// If the target string is not truncated, no $end_char is appended
echo Text::limit_words('one two three four', 4); // "one two three four"

// Don't append anything to the end of the resulting string
echo Text::limit_words('one two three four', 3, ''); // "one two three"

echo Text::limit_words('one two three four', 2, ' / three four'); // "one two / three four"
</pre>

<h2>limit_chars<code>($str, $limit = 100, $end_char = NULL, $preserve_words = FALSE)</code></h2>

<p>Similar to <code>limit_words()</code>, <code>limit_chars()</code> helps you limit the amount of characters contained inside a string.</p>

<pre class="brush:php">
$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';

echo Text::limit_chars($text, 10); // "Lorem ipsu…"

// Grab the first 10 characters without the ellipsis
$preview = Text::limit_chars($text, 10, FALSE);

echo $preview; // "Lorem ipsu" &lt;- strlen('Lorem ipsu') === 10!

// You can accomplish the same thing with native PHP
echo substr($text, 0, 10); // "Lorem ipsu"
</pre>

<p>You'll notice the last word "ipsum" was abruptly cut off. That's because you specifically requested only 10 characters and nothing more. To avoid having partial words at the end, you can set <code>$preserve_words</code> to <code>TRUE</code>, which has the effect of rounding down one word when applicable.</p>

<pre class="brush:php">
// Get all the words that fit inside 10 chars
$preview = Text::limit_chars($text, 10, FALSE, TRUE);

echo $preview; // "Lorem"
</pre>
	
<p>Treat the 10 character cap as an upper bound that will never be exceeded.</p>

<h2>alternate<code>()</code></h2>

<p><code>alternate()</code> is perfect for generating <a href="http://www.alistapart.com/articles/zebratables/">zebra tables</a>.</p>

<pre class="brush:php">
$consoles = array('xbox', 'ps3', 'cube', 'wii');

&lt;ul&gt;
	&lt;?php foreach($consoles as $console): ?&gt;
		&lt;li class="&lt;?php echo Text::alternate('odd', 'even') ?&gt;"&gt;
			&lt;?php echo $console ?&gt;
		&lt;/li&gt;
	&lt;?php endforeach ?&gt;
&lt;/ul&gt;

// Result
&lt;ul&gt;
	&lt;li class="odd"&gt;xbox&lt;/li&gt;
	&lt;li class="even"&gt;ps3&lt;/li&gt;
	&lt;li class="odd"&gt;cube&lt;/li&gt;
	&lt;li class="even"&gt;wii&lt;/li&gt;
&lt;/ul&gt;
</pre>

<h2>random<code>($type = NULL, $length = 8)</code></h2>

<p>Use <code>random()</code> to generate a random series of characters.</p>

<pre class="brush:php">
// Get ten random numbers
$string = Text::random('numeric', 10); // e.g. "3668140237"
</pre>

<p><code>random()</code> always returns a string. If you need a different data type, feel free to cast.</p>

<pre class="brush:php">
// Get ten random numbers without zeros
$number = (int) Text::random('nozero', 10); // e.g. "8384452932"
</pre>

<p>A Kohana example to generate a token:</p>

<pre class="brush:php">
$token = sha1(uniqid(Text::random('alnum', 32), TRUE));
</pre>

<p>Generate a quick test email:</p>

<pre class="brush:php">
$email = $user.'_'.Text::random('alpha', 10).'@example.com';

echo $email; // e.g. "goyote_BXEDEvhRwf@example.com"
</pre>

<h2>reduce_slashes<code>($str)</code></h2>

<p><code>reduce_slashes()</code> removes duplicate forward slashes from a string.</p>

<pre class="brush:php">
$str = Text::reduce_slashes('foo//bar/baz'); // "foo/bar/baz"
</pre>

<h2>censor<code>($str, $badwords, $replacement = '#', $replace_partial_words = TRUE)</code></h2>

<p><code>censor()</code> helps you censor user generated content that might contain substantial amounts of smack talk.</p>

<pre class="brush:php">
// Get user comment
$comment = Arr::get($_POST, 'comment'); // "I'd piss that"

if ($comment !== NULL)
{
	// Censor smack talk
	$comment = Text::censor($comment, array(
		'piss',
	));
}

echo $comment; // "I'd #### that"
</pre>

<p>By default every character in the badword will be replaced by a "#" (pound character.) You can override this default, by passing a third param.</p>

<pre class="brush:php">
echo Text::censor($comment, array('piss'), '.'); // "I'd .... that"
</pre>

<p>Or, you can completely turn off badwords by passing an empty string.</p>

<pre class="brush:php">
echo Text::censor($comment, array('piss'), ''); // "I'd  that"

// Spread the love
echo Text::censor($comment, array('piss'), '- I love you.'); // "I'd - I love you. that"
</pre>

<p>Another cool trick is to replace all badwords with one static word. This makes it harder to decipher a badword because it's length is no longer correct.</p>

<pre class="brush:php">
// Default all badwords to "##"
echo Text::censor($comment, $this->_config['badwords'], '##'); // "I'd ## that"
</pre>

<p>By default, badwords nested within words will be censored:</p>

<pre class="brush:php">
echo Text::censor('class', array('ass')); // "cl###"
</pre>

<p>To turn this off, and just have the badword alone be censored, pass <code>FALSE</code> as the fourth param.</p>

<pre class="brush:php">
echo Text::censor('class', array('ass'), '#', FALSE); // "class"
</pre>

<h2>similar<code>(array $words)</code></h2>

<p>Finds the text that is similar between a set of words.</p>

	<pre class="brush:php">
	$match = Text::similar(array('fred', 'fran', 'free'); // "fr"
	</pre>

<p>Yawn.</p>

<h2>auto_link<code>($text)</code></h2>

<p>Converts text email addresses and anchors into <abbr title="HyperText Markup Language">HTML</abbr> links. Existing links will not be altered.</p>

<pre class="brush:php">
$text = 'Yo, get back to me at joe@example.com, or visit my site http://google.com, thxbye.';

echo Text::auto_link($text); // "Yo, get back to me at &lt;a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#106;&#111;&#101;&#64;ex&#x61;&#109;&#112;&#x6c;e&#x2e;&#99;o&#x6d;"&gt;&#106;&#111;&#101;&#64;ex&#x61;&#109;&#112;&#x6c;e&#x2e;&#99;o&#x6d;&lt;/a&gt;, or visit my site &lt;a href="http://google.com"&gt;http://google.com&lt;/a&gt;, thxbye."
</pre>

<p>Keep in mind that regular expressions are used behind the scene, and regexes are proven to be far from perfect.</p>

<p>Also, you can't simply embed links like "google.com." You need to add a "www" prefix :(</p>

<pre class="brush:php">
$text = 'google.com versus www.google.com';

echo Text::auto_link($text); // "google.com versus &lt;a href="http://www.google.com"&gt;www.google.com&lt;/a&gt;"
</pre>

<p><code>auto_link()</code> is a shortcut for <code>auto_link_emails()</code> + <code>auto_link_urls()</code>.</p>

<h2>auto_link_urls<code>($text)</code></h2>

<p>Converts text anchors into <abbr title="HyperText Markup Language">HTML</abbr> links. Existing links will not be altered.</p>

<pre class="brush:php">
$text = 'google.com vs www.google.com vs http://google.com vs foo@gmail.com';

echo Text::auto_link_urls($text); // "google.com vs &lt;a href="http://www.google.com"&gt;www.google.com&lt;/a&gt; vs &lt;a href="http://google.com"&gt;http://google.com&lt;/a&gt; vs foo@gmail.com"
</pre>

<h2>auto_link_emails<code>($text)</code></h2>

<p>Converts text email addresses into <abbr title="HyperText Markup Language">HTML</abbr> links. Existing links will not be altered.</p>

<pre class="brush:php">
$text = 'google.com vs www.google.com vs http://google.com vs foo@gmail.com';

echo Text::auto_link_emails($text); // "google.com vs www.google.com vs http://google.com vs &lt;a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;&#x66;&#111;&#111;&#64;&#x67;m&#x61;&#x69;&#x6c;&#x2e;&#x63;o&#109;"&gt;&#x66;&#111;&#111;&#64;&#x67;m&#x61;&#x69;&#x6c;&#x2e;&#x63;o&#109;&lt;/a&gt;"
</pre>

<h2>auto_p<code>($str, $br = TRUE)</code></h2>

<p>Automatically applies &lt;p&gt; and &lt;br&gt; markup to text. Basically <a href="http://php.net/nl2br">nl2br</a> on steroids.</p>

<pre class="brush:php">
$text = 'This is the first paragraph
I\'m on the next line still part of the first paragraph.

Notice the empty line above, indicating the start of
a new paragraph.';

echo Text::auto_p($text);

// Result
&lt;p&gt;This is the first paragraph&lt;br /&gt;
I'm on the next line still part of the first paragraph.&lt;/p&gt;

&lt;p&gt;Notice the empty line above, indicating the start of&lt;br /&gt;
a new paragraph.&lt;/p&gt;
</pre>

<p>Pretty sweet for parsing content coming from textareas.</p>

<h2>bytes<code>($bytes, $force_unit = NULL, $format = NULL, $si = TRUE)</code></h2>

<p>Returns human readable sizes.</p>

<pre class="brush:php">
$bytes = disk_total_space(__DIR__);

echo $bytes; // "3858487070,720" <- huh?

echo Text::bytes($bytes); // "3.86 TB"

// Prefer gigabytes?
echo Text::bytes($bytes, 'GB'); // "3858.49 GB"

// Megabytes
echo Text::bytes($bytes, 'MB'); // "3858487.07 MB"

// Get the size of the currently executing file
$bytes = filesize(__FILE__);

echo $bytes; // "54366" um...

echo Text::bytes($bytes); // "54.38 kB"

echo Text::bytes($bytes, NULL, '%.0f (%s)'); // "54 (kB)"
</pre>

<h2>number<code>($number)</code></h2>

<p>Format a number to human-readable text.</p>

<pre class="brush:php">
// Get the size of this file
$bytes = filesize(__FILE__);

// We need the kB in decimal
$size = Text::bytes($bytes, 'kB', '%d'); // "54"

echo sprintf('This file weights %s kilobytes', Text::number($size)); // "This file weights fifty-four kilobytes"

echo Text::number(TRUE); // "one" <- (int) TRUE === 1

// Great example provided by kohanajobs
echo ucfirst(Text::number(ORM::factory('job')->count_all()));
</pre>

<h2>widont<code>($str)</code></h2>

<p>Prevents widows. But then again, you don't know what a <a href="http://lmgtfy.com/?q=copy+widow">widow is</a>.</p>

<pre class="brush:php">
Lorem ipsum dolor sit
amet, consectetur adipiscing
elit // <- widow

$text = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit';

echo Text::widont($text); // "Lorem ipsum dolor sit amet, consectetur adipiscing&amp;nbsp;elit"

// Result
Lorem ipsum dolor sit
amet, consectetur
adipiscing elit // <- better?
</pre>
