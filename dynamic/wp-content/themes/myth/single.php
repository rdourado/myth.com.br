<?php get_header( 'blog' ); ?>
<?php 		while( have_posts() ) : the_post(); ?>
			<article <?php post_class( 'hentry' ); ?>>
				<header class="entry-header">
					<h2 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
					<time class="entry-date" datetime="2013-02-04"><?php the_time( 'd M' ); ?></time>
				</header>
				<div class="entry-content">
					<?php the_content(); ?>
				</div>
				<footer class="entry-footer">
					<div class="share">
						<strong>Compartilhe</strong>

					</div>
					<div class="comments">
						<strong><a href="<?php echo comments_link(); ?>">Comentários (<?php comments_number( '0', '1', '%' ); ?>)</a></strong>
					</div>
				</footer>
			</article>
<?php 		endwhile; ?>
<?php 		comments_template(); ?>
<?php get_footer( 'blog' ); ?>