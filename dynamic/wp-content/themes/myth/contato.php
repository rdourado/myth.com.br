<?php 
/*
Template name: Contato
*/
$ok = isset( $_GET['ok'] ) ? $_GET['ok'] : array();
$errors = isset( $_GET['errors'] ) ? $_GET['errors'] : array();
if ( !empty( $errors ) )
	$errors = explode( ',', $errors );
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
<?php 	while( have_posts() ) : the_post(); ?>
		<article id="content" class="hentry">
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<div class="entry-content">
				<?php the_content(); ?>
				<?php insert_cform( '2' ); ?>
				<p>
					<a href="<?php echo get_permalink( 117 ); ?>" class="lcase button ajax">Trabalhe Conosco</a>
					&nbsp;&nbsp;
					<a href="<?php echo get_permalink( 118 ); ?>" class="lcase button ajax">Cadastre-se</a>
				</p>
			</div>
		</article>
<?php 	endwhile; ?>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>