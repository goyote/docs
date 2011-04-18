<h1>PhpStorm</h1>

<p>PhpStorm is my IDE of choice. PhpStorm has more features than its competition, and is constantly being fixed and enhanced thanks to the <a href="http://youtrack.jetbrains.net/issues/WI">close interaction between users and the Java devs</a> behind the software. Having said that, PhpStorm is not perfect. PhpStorm has a lot of problems, and other IDEs do many things better. For instance, for FTP support I still fall back to using Dreamweaver 8, just because it's that good. For PHP debugging, nothing beats DBG + PhpEd, it's rock solid and works like a charm. NetBeans has better autocompletion, i.e. it does autocomplete Kohana's empty static classes, PhpStorm does not. And the list goes on. Despite all these shortcomings, I still find myself booting up PhpStorm every time I turn my computer on. The reason being, PhpStorm has great customer support. I've opened several tickets on YouTrack in the past, and most of them have been addressed. I think it's the constant software improvement that keeps me engaged (proof of that is <a href="http://blogs.jetbrains.com/webide/">their blog</a>.)</p>

<p>The following is a list of tips for improving your coding efficiency when utilizing PhpStorm to create ko apps. I'll also be highlighting some of my favorite features, just to make sure you're at least aware of their existence, and try them out when ever you can.</p>

<h2>Go to File</h2>

<p>TextMate is famous for its useful "Go to File" dialog box, which makes it a breeze to open any file in your project no matter where it's located. You simply type the name of the file that you want to open, and the editor finds it for you. This is a must have feature for any serous IDE, even though some of them don't support it, e.g. PhpEd. PhpStorm takes it to another level by letting you search for a class name, file and symbol. File search is <a href="http://www.jetbrains.com/phpstorm/demos/find_files_like_a_pro/find_files_like_a_pro.html">better explained in this video</a>.</p>

<p>To open a file within any project, press <code>Ctrl+Shift+N</code>.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/go_to_file.png" alt="Go to File">
	<p>Quickly locating and opening the <code>arr.php</code> file.</p>
</div>

<p>To search for a PHP class, press <code>Ctrl+N</code>.</p>

<p class="image">
	<img src="/assets/images/tools/phpstorm/go_to_class.png" alt="Go to Class">
</p>

<p>To search for a class field or method, press <code>Ctrl+Alt+Shift+N</code>. Sadly it won't find constants :(</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/go_to_symbol.png" alt="Go to Symbol">
	<p>Quickly locating and opening the <code>HTML::chars</code> method.</p>
</div>

<h2>Duplicate Line</h2>

<p>How do you normally duplicate a line in a text editor? <code>command+left</code>, <code>command+shift+right</code>, <code>ctrl+c</code>, <code>right</code>, <code>return</code>, <code>ctrl+v</code>? In PhpStorm you press <code>Ctrl+D</code>.</p>

<p class="image">
	<img src="/assets/images/tools/phpstorm/duplicate_line.png" alt="Duplicate Line">
</p>

<p>To remove a line press <code>Ctrl+Y</code>.</p>

<h2>Whitespace Characters</h2>

<p>Whitespace characters are important in ko, because it's in the standard to use tabs instead of spaces. Using tabs, allows everyone to set the tab width to something other than 4 spaces if they want. Using spaces just screws everyone. I find it funny when devs are forced to have invisibles on, just because there's no easy way to toggle them on and off. In PhpStorm you just press <code>Ctrl+Shift+F5</code> to toggle. I also like E text editor's approach, where it shows invisibles only when you highlight text, which allows you to a <code>Ctrl+A</code> to quickly inspect.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/whitespace_characters.png" alt="Whitespace Characters">
	<p>Arrows are tabs, dots are spaces.</p>
</div>

<h2>Spelling</h2>

<p>Having a spell checker baked inside the IDE means you don't have to go back and forth between MS Word and the IDE anymore. PhpStorm allows you to detect and fix typos on the spot, by pressing <code>Alt+Enter</code> with the cursor on top of the word, and selecting the correct replacement.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/spelling.png" alt="Spelling">
	<p>Put the cursor on top of the typo, and press <code>Alt+Enter</code>.</p>
</div>

<h2>Highlight Usages</h2>

<p>I always miss this feature when using TextMate. Have you ever looked at a variable and wondered where exactly is it being used? With PhpStorm you simply place the cursor on top of the variable, class or function.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/highlight_usages.png" alt="Highlight Usages">
</div>



