<h1>Inflector</h1>

<p>Inflector is a tool that helps you work with the english language.</p>

<h2>singular<code>($str, $count = NULL)</code></h2>

<p><code>singular()</code> helps you transform a plural word into its singular form. An optional context may be used to make it smarter.</p>

<pre class="brush:php">
// Get number of comments
$count = count($comments)

// Get the correct wording based on the amount of comments
echo sprintf(
	'%s %s so far',
	ucfirst(Text::number($count)),
	Inflector::singular('comments', $count)
);

// When $count === 15
Fifteen comments so far

// When $count === 1
One comment so far

// When $count === 0
comments so far // lol turns out Text::number(0) doesn't return "zero"
</pre>

<h2>plural<code>($str, $count = NULL)</code></h2>

<p>Same thing as <code>singular()</code>, the only difference is you pass a singular word to it, instead of a plural one.</p>

<p>The following two statements output the exact same result:</p>

<pre class="brush:php">
$count = 1;
echo Inflector::singular('comments', $count); // "comment"
echo Inflector::plural('comment', $count); // "comment"

$count = 4;
echo Inflector::singular('comments', $count); // "comments"
echo Inflector::plural('comment', $count); // "comments"
</pre>

<h3>Which One to Choose?</h3>

<p>Choose the one that requires less processing.</p>

<p>e.g. if the word is more likely to be expressed in its plural form, e.g. "comments" then use <code>Inflector::singular('comments', $count)</code>. And vice versa, if the singular form is more likely to be used, use <code>Inflector::plural('comment', $count)</code>.</p>

<h2>camelize<code>($str)</code></h2>

<p>Camelizes a phrase.</p>

<pre class="brush:php">
$phrase = 'Ladies and Gentlemen — We Got Him!';

// Seems like it can't handle some characters
echo Inflector::camelize($phrase); // "ladiesAndGentlemen�WeGotHim!"
</pre>

<div class="note">
<p><strong>Note:</strong> the only characters that are stripped are whitespaces and underscores.</p>
</div>

<h2>decamelize<code>($str, $sep = ' ')</code></p></h2>

<p>Inverses the effects of <code>camelize()</code>. Keep in mind, that the original case formatting is lost.</p>

<pre class="brush:php">
// Building on top of the previous example
$phrase = Inflector::camelize($phrase); // "ladiesAndGentlemen�WeGotHim!"

echo Inflector::decamelize($phrase); // ""
</pre>

<h2>humanize<code>($str)</code></h2>

<p><code>humanize()</code> will replace dashes and underscores in a string, with spaces.</p>

<pre class="brush:php">
public function after()
{
	if (empty($this->template->title))
	{
		// Use the route to generate the document title
		$this->template->title = ucwords(
			Inflector::humanize($this->request->action())
		);
	}
	
	$this->template->title .= ' — WebApp';
}
</pre>

