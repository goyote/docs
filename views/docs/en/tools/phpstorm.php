<h1>PhpStorm</h1>

<p>PhpStorm is my IDE of choice. PhpStorm has more features than its competition, and is constantly being fixed and enhanced thanks to the <a href="http://youtrack.jetbrains.net/issues/WI">close interaction between users and the Java devs</a> behind the software. Having said that, PhpStorm is not perfect. PhpStorm has a lot of problems, and other IDEs do many things better. For instance, for FTP support I still fall back to using Dreamweaver 8, just because it's that good. For PHP debugging, nothing beats DBG + PhpED, it's rock solid and works like a charm. NetBeans has better autocompletion, i.e. it does autocomplete Kohana's empty static classes, PhpStorm does not. And the list goes on. Despite all these shortcomings, I still find myself booting up PhpStorm every time I turn my computer on. The reason being, PhpStorm has great customer support. I've opened several tickets on YouTrack in the past, and most of them have been addressed. I think it's the constant software improvement that keeps me engaged (proof of that is <a href="http://blogs.jetbrains.com/webide/">their blog</a>.)</p>

<p>The following is a list of tips for improving your coding efficiency when using PhpStorm to create ko apps. I'll also be highlighting some of my favorite features, just to make sure you're at least aware of their existence, and try them out when ever you can.</p>

<h2>git Integration</h2>

<h3>Windows SSH Key</h3>

<p>You need to convert your Private Putty Key to an OpenSSH Private Key</p>
<p>Otherwise PHPStorm will ask you for your git Repo Password</p>

<ol>
    <li>
        <p>Load your Private Putty Key</p>
        <div class="image">
            <p><?php echo HTML::image('assets/images/tools/phpstorm/git_integration_1.png', array('alt' => 'Git Integration')); ?></p>
        </div>
    </li>
    <li>
        <p>Save it as id_rsa within the following Directory: %USERPROFILE%\.ssh</p>
        <div class="image">
            <p><?php echo HTML::image('assets/images/tools/phpstorm/git_integration_2.png', array('alt' => 'Git Integration')); ?></p>
        </div>
    </li>
    <li>
        <p>git Settings</p>
        <div class="image">
            <p><?php echo HTML::image('assets/images/tools/phpstorm/git_integration_3.png', array('alt' => 'Git Integration')); ?></p>
        </div>
    </li>
    <p>Thats how my Git Settings looks like</p>
    <div class="image">
        <p><?php echo HTML::image('assets/images/tools/phpstorm/git_integration_4.png', array('alt' => 'Git Integration')); ?></p>
    </div>
</ol>
<h2>File Completion</h2>

<p>OMG, I just discovered how to "fix" file completion in any project.</p>

<ol>
	<li>
		<p>In the project window, locate the directory serving as the <code>DocumentRoot</code>.</p>
		<div class="image">
			<?php echo HTML::image('assets/images/tools/phpstorm/file_completion1.png', array('alt' => 'File Completion')); ?>
		</div>
	</li>
	<li>
		<p>Right click it, and select <code>Mark Directory As > Resource Root</code>.</p>
		<div class="image">
			<?php echo HTML::image('assets/images/tools/phpstorm/file_completion2.png', array('alt' => 'File Completion')); ?>
		</div>
	</li>
	<li>
		<p>Done. File completion in images and CSS will now work!</p>
		<div class="image">
			<p><?php echo HTML::image('assets/images/tools/phpstorm/file_completion3.png', array('alt' => 'File Completion')); ?></p>
			<p><?php echo HTML::image('assets/images/tools/phpstorm/file_completion4.png', array('alt' => 'File Completion')); ?></p>
			<p><?php echo HTML::image('assets/images/tools/phpstorm/file_completion5.png', array('alt' => 'File Completion')); ?></p>
		</div>
	</li>
</ol>

<h2>Surround With</h2>

<p>TextMate has a uber awesome feature, where you can wrap any piece of text with HTML by pressing <code>Ctrl+Shift+W</code>. I use this a lot.</p>

<p>Unfortunately, PhpStorm does not provide the same power :( To achieve the same thing in PhpStorm, you have to press <code>Ctrl+Alt+T</code> <strong>- plus -</strong> <code>Enter</code>. Pressing <code>Enter</code> is the annoying extra step.</p>

<div class="image">
    <p><?php echo HTML::image('assets/images/tools/phpstorm/surround_with1.png', array('alt' => 'Surround With')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/surround_with2.png', array('alt' => 'Surround With')); ?></p>
	<p class="desc">Can we skip the above step?</p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/surround_with3.png', array('alt' => 'Surround With')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/surround_with4.png', array('alt' => 'Surround With')); ?></p>
</div>

<p>Another tragedy, is Phpstorm can't mimic TextMate's <code>Ctrl+Shift+Cmd+W</code> functionality, which is the same thing but wrapping several lines simultaneously.</p>

<h2>Go to File</h2>

<p>TextMate is famous for its useful "Go to File" dialog box, which makes it a breeze to open any file in your project no matter where it's located. You simply type the name of the file that you want to open, and the editor finds it for you. This is a must have feature for any serious IDE, even though some of them don't support it, e.g. PhpED. PhpStorm takes it to another level by letting you search for a class name, file and symbol. File search is <a href="http://www.jetbrains.com/phpstorm/demos/find_files_like_a_pro/find_files_like_a_pro.html">better explained in this video</a>.</p>

<p>To open a file within any project, press <code>Ctrl+Shift+N</code>.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/go_to_file.png', array('alt' => 'Go to File')); ?></p>
	<p>Quickly locate and open the <code>arr.php</code> file.</p>
</div>

<p>To search for a PHP class, press <code>Ctrl+N</code>.</p>

<p class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/go_to_class.png', array('alt' => 'Go to Class')); ?></p>
</p>

<p>To search for a class field, constant or method, press <code>Ctrl+Alt+Shift+N</code>.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/go_to_symbol.png', array('alt' => 'Go to Symbol')); ?></p>
	<p>Quickly locate and open the <code>HTML::chars</code> method.</p>
</div>

<h2>Duplicate Line</h2>

<p>How do you normally duplicate a line in a text editor? <code>Home</code>, <code>Ctrl+Shift+End</code>, <code>Ctrl+C</code>, <code>Right</code>, <code>Enter</code>, <code>Ctrl+V</code>? In PhpStorm you press <code>Ctrl+D</code>.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/duplicate_line.png', array('alt' => 'Duplicate Line')); ?></p>
	<p>Press <code>Ctrl+D</code> to duplicate the current line.</p>
</div>

<p>To remove a line press <code>Ctrl+Y</code>.</p>

<h2>Whitespace Characters</h2>

<p>Whitespace characters are important in ko, because it's in the standard to use tabs instead of spaces. Using tabs, allows everyone to set the tab width to something other than 4 spaces if they want. Using spaces just screws everyone. I find it funny when devs are forced to have invisibles on, just because there's no easy way to toggle them on and off. In PhpStorm you just press <code>Ctrl+Shift+F5</code> to toggle. I also like E text editor's approach, where it shows invisibles only when you highlight text, which allows you to <code>Ctrl+A</code> to quickly inspect.</p>

<div class="image">
    <p><?php echo HTML::image('assets/images/tools/phpstorm/whitespace_characters.png', array('alt' => 'Whitespace Characters')); ?></p>
	<p>Arrows are tabs, dots are spaces.</p>
</div>

<h2>Spelling</h2>

<p>Having a spell checker baked inside the IDE means you don't have to go back and forth between MS Word and the IDE anymore. PhpStorm allows you to detect and fix typos on the spot, by pressing <code>Alt+Enter</code> with the cursor on top of the word, and selecting the correct replacement.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/spelling.png', array('alt' => 'Spelling')); ?></p>
	<p>Put the cursor on top of the typo, and press <code>Alt+Enter</code>.</p>
</div>

<h2>Highlight Usages</h2>

<p>I always miss this feature when using TextMate. Have you ever looked at a variable and wondered where exactly is it being used? With PhpStorm you simply place the cursor on top of the variable, class or function and all of its usages are highlighted.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/highlight_usages.png', array('alt' => 'Highlight Usages')); ?></p>
	<p>You can clearly see where <code>$value</code> is being used.</p>
</div>

<h2>Refactor</h2>

<p>Another must-have feature that's missing in mate is the ability to rename a variable safely on the fly. To do so in PhpStorm, simply place the cursor on top of the word, and press <code>Shift+F6</code> to rename!</p>

<div class="image">
    <p><?php echo HTML::image('assets/images/tools/phpstorm/refactor1.png', array('alt' => 'Refactor 1')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/refactor2.png', array('alt' => 'Refactor 2')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/refactor3.png', array('alt' => 'Refactor 3')); ?></p>
	<p>Renamed all instances of <code>$value</code> to <code>$new_value</code>.</p>
</div>

<h2>Code Completion</h2>

<p>Autocompletion is what distinguishes a mere text editor from its daddy the IDE. Autompletion is great for those long, hard to remember method names. Some IDEs like PhpED only automplete method names. PhpStorm on the other hand, autocompletes EVERYTHING. Variables, constants, classes, keywords, you name it. Not only that; it also has the same support for other languages too, like HTML, JavaScript and CSS.</p>

<div class="image">
    <p><?php echo HTML::image('assets/images/tools/phpstorm/code_completion1.png', array('alt' => 'Code Completion 1')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/code_completion2.png', array('alt' => 'Code Completion 2')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/code_completion3.png', array('alt' => 'Code Completion 3')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/code_completion4.png', array('alt' => 'Code Completion 4')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/code_completion5.png', array('alt' => 'Code Completion 5')); ?></p>
</div>

<h2>Complete Current Statement</h2>

<p><em>Complete current statement</em> allows you to terminate a statement no matter where your cursor position is. Most of the time you'll use it to add a semicolon to the end of the line.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/complete_statement1.png', array('alt' => 'Code Statement 1')); ?></p>
	<p>To terminate the above statement, press <code>Ctrl+Shift+Enter</code>.</p>
	<p><?php echo HTML::image('assets/images/tools/phpstorm/complete_statement2.png', array('alt' => 'Code Statement 2')); ?></p>
	<p>PhpStorm will also close any unclosed parenthesis.</p>
</div>

<h2>Start New Line</h2>

<p>Say you have your cursor on a statement, and you want to start writing on the next line. Normally you would press <code>End</code>, <code>Enter</code>. In PhpStorm if the current statement is already complete and you press <code>Ctrl+Shift+Enter</code>, the editor will start a new line for you and place your cursor at the start of it. This functionality is equivalent to pressing <code>o</code> in vim.</p>

<h2>Convert Indents to Tabs</h2>

<p>As said earlier, you should use tabs instead of spaces. The easiest way to comply with this rule is to have PhpStorm automatically handle this for you. In the <code>Code Style > General</code> settings enable the usage of the tab character by clicking on the "Use tab character" option.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/use_tab_character.png', array('alt' => 'Use Tab Character')); ?></p>
</div>

<p>Sometimes those pesky spaces can creep into a project, e.g. when copy-pasting code from the web. In such a case, simply press <code>Ctrl+A</code> + <code>Edit > Convert Indents to Tabs</code>. Done.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/convert_indents_to_tabs.png', array('alt' => 'Convert Indents to Tabs')); ?></p>
</div>

<h2>Validation</h2>

<p>Validation is like a dude standing behind you while you code, just waiting for you to make a mistake so he can call you out. Without validation in the IDE, you can spend hours debugging your code, scratching your head wondering what when wrong, when it turns out you forgot to place a semicolon at the end of a statement, or you mistyped a variable, or wrote something stupid like "<code>else (...)</code> {" <- true story :S</p>

<div class="image">
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation1.png', array('alt' => 'Code Validation 1')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation2.png', array('alt' => 'Code Validation 2')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation3.png', array('alt' => 'Code Validation 3')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation4.png', array('alt' => 'Code Validation 4')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation5.png', array('alt' => 'Code Validation 5')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation6.png', array('alt' => 'Code Validation 6')); ?></p>
    <p><?php echo HTML::image('assets/images/tools/phpstorm/validation7.png', array('alt' => 'Code Validation 7')); ?></p>
</div>

<h2>Column Mode</h2>

<p>Column mode comes in handy when you want to edit several lines, simultaneously.</p>

<div class="image">
	<p><?php echo HTML::image('assets/images/tools/phpstorm/column_mode1.png', array('alt' => 'Column Mode 1')); ?></p>
	<p><?php echo HTML::image('assets/images/tools/phpstorm/column_mode2.png', array('alt' => 'Column Mode 2')); ?></p>
	<p>Press <code>Shift+Alt+Insert</code> to toggle on and off!</p>
</div>

<h2>GitHub</h2>

<p>PhpStorm let's you checkout a project straight from the IDE! To do so, first you have to enter your login credentials in the settings tab:</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/github1.png" alt="GitHub"></p>
	<p class="desc">Once you've entered your user credentials, press "test" to make sure everything is correct.</p>
	<p><img src="/assets/images/tools/phpstorm/github2.png" alt="GitHub"></p>
	<p><img src="/assets/images/tools/phpstorm/github3.png" alt="GitHub"></p>
	<p>You can protect your passwords with a Master password.</p>
</div>

<p>Next, in the main menu, select <code>Version Control > Checkout from Version Control > GitHub</code>.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/github4.png" alt="GitHub"></p>
</div>

<p>And select the repository that you want to checkout.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/github5.png" alt="GitHub"></p>
	<p><img src="/assets/images/tools/phpstorm/github6.png" alt="GitHub"></p>
	<p>Finally, enter your passphrase.</p>
</div>

<h2>git</h2>

<h3>Enable Version Control Integration</h3>

<p>If you have a git project already started on your computer, you can enable version control integration, which will allow you to use git inside the IDE. To do so, select <code>Version Control > Enable Version Control Integration</code>.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/git1.png" alt="git"></p>
	<p><img src="/assets/images/tools/phpstorm/git2.png" alt="git"></p>
	<p><img src="/assets/images/tools/phpstorm/git3.png" alt="git"></p>
	<p>As you can see my git repos are not at the root of the project.</p>
</div>

<p>When the repo is not at the root, you loose a lot of functionality, like "show the latest changes." I'm currently not sure if this is a bug or a misconfiguration.</p>

<div class="image">
	<p><img src="/assets/images/tools/phpstorm/git10.png" alt="git"></p>
</div>
	
<p>Now that PhpStorm knows about git, you can do a couple of cool things:</p>

<ol>
	<li>
		<p><strong>Inspect the History.</strong> Right click a directory, and from the context menu select <code>Git > Show History</code>.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git4.png" alt="git"></p>
		</div>
		<p>To get some juice out of it, select the commit that you want to inspect. Right click it, and select <code>Show All Affected Paths</code>.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git7.png" alt="git"></p>
		</div>
		<p>It will show you all of the files modified in that particular commit.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git8.png" alt="git"></p>
		</div>
		<p>Right click a file that's interesting, and select <code>Show Diff</code> to further inspect the changes.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git9.png" alt="git"></p>
		</div>
	</li>
	<li>
		<p><strong>Annotate.</strong> Annotate allows you to look at the blame on each line of a file. To bring it up, right click the file tab and select <code>Git > Annotate</code>.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git5.png" alt="git"></p>
		</div>
	</li>
	<li>
		<p><strong>Diff.</strong> To quickly inspect the changes done to a file, select <code>Git > Compare with Latest Repository Version</code>:</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git6.png" alt="git"></p>
		</div>
	</li>
</ol>


<h3>Windows SSH Key</h3>

<p>You need to convert your Private Putty Key to an OpenSSH Private Key, otherwise PhpStorm will ask you for your git repo password.</p>

<ol>
	<li>
		<p>Load your Private Putty Key.</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git_integration_1.png" alt="Git Integration"></p>
		</div>
	</li>
	<li>
		<p>Save it as id_rsa within the following Directory: %USERPROFILE%\.ssh</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git_integration_2.png" alt="Git Integration"></p>
		</div>
	</li>
	<li>
		<p>git Settings</p>
		<div class="image">
			<p><img src="/assets/images/tools/phpstorm/git_integration_3.png" alt="Git Integration"></p>
			<p><img src="/assets/images/tools/phpstorm/git_integration_4.png" alt="Git Integration"></p>
		</div>
	</li>
</ol>
