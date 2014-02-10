<?php 
/*
Template name: Coleção
*/
$pageID = get_page_by_path( 'colecao' );
$pageID = $pageID->ID;
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
		<article id="content" class="hentry">
			<h1 class="entry-title">Coleção</h1>
			<ul class="shortcuts">
				<li class="item item-1"><a href="#lookbook">Lookbook</a></li>
				<li class="item item-2"><a href="#campanha">Campanha</a></li>
				<li class="item item-3"><a href="#release">Release</a></li>
				<li class="item item-4"><a href="#making-of">Making of</a></li>
			</ul>
			<div class="entry-content">
				<div id="lookbook">
					<div id="slider-code">
						<a class="buttons prev" href="#"></a>
						<div class="viewport">
							<ul class="lookbook-list overview">
<?php 							$looks = get_field( 'looks', $pageID );
								foreach( $looks as $look ) : ?>
								<li class="look-item collection-item">
									<a href="<?php 
									echo $look['url']; ?>" class="fancybox-look<?php 
									if ( get_the_ID() == $look['id'] ) echo ' active'; ?>"><?php 
									echo wp_get_attachment_image( $look['id'], 'lookbook' ); 
									?><span></span></a>
									<div class="info">
										<b>Referências</b> 
										<em><?php 
											echo '<span>' . str_replace( "\n", '</span><span>', $look['description'] ) . '</span>'; 
										?></em>
										<a href="<?php 
										echo 'http://www.facebook.com/sharer.php?u=' . urlencode( get_attachment_link( $look['id'] ) ) . '&amp;t=Myth'; 
										?>" target="_blank"><img src="<?php t_url(); ?>/img/share-fb.png" alt="Facebook" class="ignore" width="29" height="29"></a>
									</div>
								</li>
<?php 							endforeach; ?>
							</ul>
						</div>
						<a class="buttons next" href="#"></a>
					</div>
				</div>
				<div id="campanha">
					<ul class="collection-list slider">
<?php 					$images = get_field( 'images', $pageID );
						foreach( $images as $image ) : ?>
						<li class="collection-item"><?php 
						echo wp_get_attachment_image( $image['id'], 'collection' ); ?></li>
<?php 					endforeach; ?>
					</ul>
				</div>
				<div id="release">
					<h2 class="entry-title">Release</h2>
					<div class="frame">
						<h3 class="subtitle"><?php the_field( 'release_title', $pageID ); ?></h3>
						<?php the_field( 'release_text', $pageID ); ?>
					</div>
				</div>
				<div id="making-of">
					<h2 class="entry-title">Making of</h2>
					<?php the_field( 'making_of', $pageID ); ?>
				</div>
			</div>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>