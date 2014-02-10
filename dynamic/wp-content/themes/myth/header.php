<!doctype html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="/min/?g=myth-css" media="all">
	<!--[if lt IE 9]><script src="<?php t_url(); ?>/js/html5shiv.js"></script><![endif]-->
	<!-- WP/ --><?php wp_head(); ?><!-- /WP -->
	<script>var _gaq=[['_setAccount','UA-38109765-1'],['_trackPageview']];(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.src='//www.google-analytics.com/ga.js';s.parentNode.insertBefore(g,s)}(document,'script'))</script>
</head>
<body <?php body_class( $post->post_name ); ?>>
	<header id="head">
<?php 	if ( is_front_page() ) : ?>
		<h1 id="logo"><img src="<?php t_url(); ?>/img/myth.png" alt="Myth" width="223" height="117"></h1>
<?php 	else : ?>
		<div id="logo"><a href="<?php echo home_url( '/' ); ?>"><img src="<?php t_url(); ?>/img/myth.png" alt="Myth" width="223" height="117"></a></div>
<?php 	endif; ?>
		<?php wp_nav_menu( array(
			'theme_location'  => 'menu',
			'container'       => 'nav', 
			'container_id'    => 'nav',
			'menu_id'         => 'menu',
			'fallback_cb'     => false,
			'depth'           => 1,
		) ); ?>

		<ul id="links">
			<li class="link-item item-store"><a href="<?php the_field( 'store', 'options' ); ?>" target="_blank"><img src="<?php t_url(); ?>/img/myth-store.png" alt="Myth Store" width="140" height="47"></a></li>
			<li class="link-item item-facebook"><a href="<?php the_field( 'facebook', 'options' ); ?>" target="_blank"><img src="<?php t_url(); ?>/img/ico-facebook.png" alt="Facebook" width="29" height="29"></a></li>
			<li class="link-item item-twitter"><a href="<?php the_field( 'twitter', 'options' ); ?>" target="_blank"><img src="<?php t_url(); ?>/img/ico-twitter.png" alt="Twitter" width="29" height="29"></a></li>
			<li class="link-item item-instagram"><a href="<?php the_field( 'instagram', 'options' ); ?>" target="_blank"><img src="<?php t_url(); ?>/img/ico-instagram.png" alt="Instagram" width="29" height="29"></a></li>
			<li class="link-item item-blog"><a href="<?php 
			echo get_permalink( get_option( 'page_for_posts' ) ); 
			?>" target="_blank"><img src="<?php t_url(); ?>/img/blog.png" alt="Blog" width="64" height="24"></a></li>
		</ul>
		<div id="radio"></div>
	</header>
	<hr>
