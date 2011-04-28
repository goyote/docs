<h1>PhpStorm</h1>

<p>PhpStorm is my IDE of choice. PhpStorm has more features than its competition, and is constantly being fixed and enhanced thanks to the <a href="http://youtrack.jetbrains.net/issues/WI">close interaction between users and the Java devs</a> behind the software. Having said that, PhpStorm is not perfect. PhpStorm has a lot of problems, and other IDEs do many things better. For instance, for FTP support I still fall back to using Dreamweaver 8, just because it's that good. For PHP debugging, nothing beats DBG + PhpED, it's rock solid and works like a charm. NetBeans has better autocompletion, i.e. it does autocomplete Kohana's empty static classes, PhpStorm does not. And the list goes on. Despite all these shortcomings, I still find myself booting up PhpStorm every time I turn my computer on. The reason being, PhpStorm has great customer support. I've opened several tickets on YouTrack in the past, and most of them have been addressed. I think it's the constant software improvement that keeps me engaged (proof of that is <a href="http://blogs.jetbrains.com/webide/">their blog</a>.)</p>

<p>The following is a list of tips for improving your coding efficiency when using PhpStorm to create ko apps. I'll also be highlighting some of my favorite features, just to make sure you're at least aware of their existence, and try them out when ever you can.</p>

<h2>File Completion</h2>

<p>OMG, I just discovered how to "fix" file completion on any project.</p>

<ol>
	<li>
		<p>In the project window, locate the directory serving as the <code>DocumentRoot</code>.</p>
		<div class="image">
			<img src="/assets/images/tools/phpstorm/file_completion1.png" alt="File Completion">
		</div>
	</li>
	<li>
		<p>Right click it, and select <code>Mark Directory As > Resource Root</code>.</p>
		<div class="image">
			<img src="/assets/images/tools/phpstorm/file_completion2.png" alt="File Completion">
		</div>
	</li>
	<li>
		<p>Done. File completion in images and CSS will now work!</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/file_completion3.png" alt="File Completion"></p>
			<p><img src="/assets/images/tools/phpstorm/file_completion4.png" alt="File Completion"></p>
			<p><img src="/assets/images/tools/phpstorm/file_completion5.png" alt="File Completion"></p>
		</div>
	</li>
</ol>

<h2>Go to File</h2>

<p>TextMate is famous for its useful "Go to File" dialog box, which makes it a breeze to open any file in your project no matter where it's located. You simply type the name of the file that you want to open, and the editor finds it for you. This is a must have feature for any serious IDE, even though some of them don't support it, e.g. PhpED. PhpStorm takes it to another level by letting you search for a class name, file and symbol. File search is <a href="http://www.jetbrains.com/phpstorm/demos/find_files_like_a_pro/find_files_like_a_pro.html">better explained in this video</a>.</p>

<p>To open a file within any project, press <code>Ctrl+Shift+N</code>.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/go_to_file.png" alt="Go to File">
	<p>Quickly locate and open the <code>arr.php</code> file.</p>
</div>

<p>To search for a PHP class, press <code>Ctrl+N</code>.</p>

<p class="image">
	<img src="/assets/images/tools/phpstorm/go_to_class.png" alt="Go to Class">
</p>

<p>To search for a class field, constant or method, press <code>Ctrl+Alt+Shift+N</code>.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/go_to_symbol.png" alt="Go to Symbol">
	<p>Quickly locate and open the <code>HTML::chars</code> method.</p>
</div>

<h2>Duplicate Line</h2>

<p>How do you normally duplicate a line in a text editor? <code>Home</code>, <code>Ctrl+Shift+End</code>, <code>Ctrl+C</code>, <code>Right</code>, <code>Enter</code>, <code>Ctrl+V</code>? In PhpStorm you press <code>Ctrl+D</code>.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/duplicate_line.png" alt="Duplicate Line">
	<p>Press <code>Ctrl+D</code> to duplicate the current line.</p>
</div>

<p>To remove a line press <code>Ctrl+Y</code>.</p>

<h2>Whitespace Characters</h2>

<p>Whitespace characters are important in ko, because it's in the standard to use tabs instead of spaces. Using tabs, allows everyone to set the tab width to something other than 4 spaces if they want. Using spaces just screws everyone. I find it funny when devs are forced to have invisibles on, just because there's no easy way to toggle them on and off. In PhpStorm you just press <code>Ctrl+Shift+F5</code> to toggle. I also like E text editor's approach, where it shows invisibles only when you highlight text, which allows you to <code>Ctrl+A</code> to quickly inspect.</p>

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

<p>I always miss this feature when using TextMate. Have you ever looked at a variable and wondered where exactly is it being used? With PhpStorm you simply place the cursor on top of the variable, class or function and all of its usages are highlighted.</p>

<div class="image">
	<img src="/assets/images/tools/phpstorm/highlight_usages.png" alt="Highlight Usages">
	<p>You can clearly see where <code>$value</code> is being used.</p>
</div>

<h2>Refactor</h2>

<p>Another must-have feature that's missing in mate is the ability to rename a variable safely on the fly. To do so in PhpStorm, simply place the cursor on top of the word, and press <code>Shift+F6</code> to rename!</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/refactor1.png" alt="Refactor 1"></p>
	<p><img src="/assets/images/tools/phpstorm/refactor2.png" alt="Refactor 2"></p>
	<p><img src="/assets/images/tools/phpstorm/refactor3.png" alt="Refactor 3"></p>
	<p>Renamed all instances of <code>$value</code> to <code>$new_value</code>.</p>
</div>

<h2>Code Completion</h2>

<p>Autocompletion is what distinguishes a mere text editor from its daddy the IDE. Autompletion is great for those long, hard to remember method names. Some IDEs like PhpED only automplete method names. PhpStorm on the other hand, autocompletes EVERYTHING. Variables, constants, classes, keywords, you name it. Not only that; it also has the same support for other languages too, like HTML, JavaScript and CSS.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/code_completion1.png" alt="Code Completion 1"></p>
	<p><img src="/assets/images/tools/phpstorm/code_completion2.png" alt="Code Completion 2"></p>
	<p><img src="/assets/images/tools/phpstorm/code_completion3.png" alt="Code Completion 3"></p>
	<p><img src="/assets/images/tools/phpstorm/code_completion4.png" alt="Code Completion 4"></p>
	<p><img src="/assets/images/tools/phpstorm/code_completion5.png" alt="Code Completion 5"></p>
</div>

<h2>Complete Current Statement</h2>

<p><em>Complete current statement</em> allows you to terminate a statement no matter where your cursor position is. Most of the time you'll use it to add a semicolon to the end of the line.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/complete_statement1.png" alt="Complete Statement 1"></p>
	<p>To terminate the above statement, press <code>Ctrl+Shift+Enter</code>.</p>
	<p><img src="/assets/images/tools/phpstorm/complete_statement2.png" alt="Complete Statement 2"></p>
	<p>PhpStorm will also close any unclosed parenthesis.</p>
</div>

<h2>Start New Line</h2>

<p>Say you have your cursor on a statement, and you want to start writing on the next line. Normally you would press <code>End</code>, <code>Enter</code>. In PhpStorm if the current statement is already complete and you press <code>Ctrl+Shift+Enter</code>, the editor will start a new line for you and place your cursor at the start of it. This functionality is equivalent to pressing <code>o</code> in vim.</p>

<h2>Convert Indents to Tabs</h2>

<p>As said earlier, you should use tabs instead of spaces. The easiest way to comply with this rule is to have PhpStorm automatically handle this for you. In the <code>Code Style > General</code> settings enable the usage of the tab character by clicking on the "Use tab character" option.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/use_tab_character.png" alt="Use Tab Character"></p>
</div>

<p>Sometimes those pesky spaces can creep into a project, e.g. when copy-pasting code from the web. In such a case, simply press <code>Ctrl+A</code> + <code>Edit > Convert Indents to Tabs</code>. Done.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/convert_indents_to_tabs.png" alt="Convert Indents to Tabs"></p>
</div>

<h2>Validation</h2>

<p>Validation is like a dude standing behind you while you code, just waiting for you to make a mistake so he can call you out. Without validation in the IDE, you can spend hours debugging your code, scratching your head wondering what when wrong, when it turns out you forgot to place a semicolon at the end of a statement, or you mistyped a variable, or wrote something stupid like "<code>else (...)</code> {" <- true story :S</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/validation1.png" alt="Code Completion 1"></p>
	<p><img src="/assets/images/tools/phpstorm/validation2.png" alt="Code Completion 2"></p>
	<p><img src="/assets/images/tools/phpstorm/validation3.png" alt="Code Completion 3"></p>
	<p><img src="/assets/images/tools/phpstorm/validation4.png" alt="Code Completion 4"></p>
	<p><img src="/assets/images/tools/phpstorm/validation5.png" alt="Code Completion 5"></p>
	<p><img src="/assets/images/tools/phpstorm/validation6.png" alt="Code Completion 6"></p>
	<p><img src="/assets/images/tools/phpstorm/validation7.png" alt="Code Completion 7"></p>
</div>

<h2>Column Mode</h2>

<p>Column mode comes in handy when you want to edit several lines, simultaneously.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/column_mode1.png" alt="Column Mode 1"></p>
	<p><img src="/assets/images/tools/phpstorm/column_mode2.png" alt="Column Mode 2"></p>
	<p>Press <code>Shift+Alt+Insert</code> to toggle on and off!</p>
</div>

