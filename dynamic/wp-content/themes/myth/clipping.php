<?php 
/*
Template name: Clipping
*/
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
		<article id="content" class="hentry">
			<h1 class="entry-title">Clipping</h1>
			<div class="entry-content">
				<ul class="clipping-list">
<?php 				$images = get_field( 'images' );
					foreach( $images as $img ) : ?>
					<li class="clipping-item"><a href="<?php 
					echo $img['sizes']['large']; ?>" title="<?php 
					echo $img['alt']; ?>" class="fancybox"><img src="<?php 
					echo $img['sizes']['clipping']; ?>" alt="<?php 
					echo $img['alt']; ?>" width="240" height="180"></a></li>
<?php 				endforeach; ?>
				</ul>
			</div>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>