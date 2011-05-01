$(function() {
	SyntaxHighlighter.defaults['gutter'] = false;
	SyntaxHighlighter.defaults['auto-links'] = true;
	SyntaxHighlighter.all();

	$('a').each(function(index, element) {
		 if (element.host !== window.location.host) {
			element.target = '_blank';
		 }
	});

	var li = [];
	$('#main h2').each(function(i, element) {
		var heading = $.trim($(element).text().replace(/\(.*?\)/, ''));
		var href = heading.replace(/[()]+/g, '').replace(/\s+/g, '_').toLowerCase();
		element.id = href;
		li.push('<li><a href="#'+href+'">'+heading+'</a></li>');
	});

	if (li.length) {
		$('<ul>', {
			  html: li.join(' ')
		  }).appendTo('#toc');
	}
	else {
		$('#toc').parent().hide();
	}

	if (location.hash) {
		location = location.hash;
	}

	$('#language').bind('change', function() {
		var href= $(this).val();
		window.location.href = href;
	}).val(window.location.pathname);

	//set the link
	$('#top-link').topLink({
		min: 400,
		fadeSpeed: 500
	});
	//smoothscroll
	$('#top-link').click(function(e) {
		e.preventDefault();
		$.scrollTo(0,300);
	});

	$('.syntaxhighlighter').live('mouseenter', function() {
		$(this).css('overflow', 'visible');
	})
	.live('mouseleave', function() {
		$(this).css('overflow', 'auto');
	});
});
