<?php 
$blogID = get_option( 'page_for_posts' );
?><!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" media="screen">
	<!--[if lt IE 9]><script src="<?php t_url(); ?>/js/html5shiv.js"></script><![endif]-->
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
	<script>var _gaq=[['_setAccount','UA-38112779-1'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
</head>
<body <?php body_class( 'blog' ); ?>>
	<header id="head">
<?php 	if ( is_page( $blogID ) ) : ?>
		<h1 id="logo"><img src="<?php 
		bloginfo( 'template_url' ); 
		?>/img/blog-da-mythdinha.png" alt="Blog da Mythdinha by Myth" width="762" height="341"></h1>
<?php 	else : ?>
		<div id="logo"><img src="<?php 
		bloginfo( 'template_url' ); 
		?>/img/blog-da-mythdinha.png" alt="Blog da Mythdinha by Myth" width="762" height="341"></div>
<?php 	endif; ?>
	</header>
	<hr>
	<div id="body">
		<div id="content">
