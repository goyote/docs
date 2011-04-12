<!DOCTYPE html>
<html lang="<?php echo I18n::$lang ?>">
	<head>
		<meta charset="<?php echo Kohana::$charset ?>">
		<title><?php echo $article ?> | <?php echo $category ?> | Kohana Docs</title>
		<link rel="stylesheet" href="/assets/css/global.css">
		<link rel="stylesheet" type="text/css" href="/assets/css/goyoPHPDark.css">
		<link rel="canonical" href="<?php echo Route::url('docs', array(
			'lang' => I18n::$lang,
			'category' => $url['category'],
			'article' => $url['article'],
		)) ?>">
	</head>
	<body>
		<div id="container">
			<div>
				<div id="header">
					<select id="language">
						<?php foreach ($languages as $lang): ?>
							<option value="<?php echo Route::url('docs', array(
								'lang' => $lang['lang'],
								'category' => $url['category'],
								'article' => $url['article']
							)) ?>"><?php echo $lang['name'] ?></option>
						<?php endforeach ?>
					</select>
					<a href="/" id="logo"><img src="/assets/images/kowut.png" alt="Kohana Docs"></a>
					<ul id="nav">
						<?php foreach ($navigation as $text => $array): ?>
							<li>
								<?php echo HTML::anchor(I18n::$lang.$array['href'], __($text)) ?>
								<?php if (isset($array['links'])): ?>
									<ul>
										<?php foreach ($array['links'] as $hotspot => $href): ?>
											<li><?php echo HTML::anchor(I18n::$lang.$href, __($hotspot)) ?></li>
										<?php endforeach ?>
									</ul>
								<?php endif ?>
							</li>
						<?php endforeach ?>
					</ul>
				</div>
				<div id="content" class="clearfix">
					<div id="main">
						<div>
							<?php if ($resources !== NULL): ?>
								<dl class="references">
									<dt><?php echo __('External Resources') ?></dt>
									<?php foreach ($resources as $resource => $href): ?>
										<dd><?php echo HTML::anchor($href, '&rarr; '.__($resource)) ?></dd>
									<?php endforeach ?>
								</dl>
							<?php endif ?>

							<?php echo $content ?>
						</div>
					</div>
					<div id="sidebar">
						<div class="box">
							<h3><?php echo __('Table of Contents') ?></h3>
							<div class="content" id="toc"></div>
						</div>
					</div>
				</div>
			</div>
			<div id="footer">
			</div>
			<a href="#top" id="top-link">Top of Page</a>
		</div>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.toplink.js"></script>
		<script type="text/javascript" src="/assets/js/jquery.scrollTo-1.4.2.js"></script>
		<script type="text/javascript" src="/assets/js/shCoreAll.js"></script>
		<script type="text/javascript" src="/assets/js/global.js"></script>
	</body>
</html>