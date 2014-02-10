<?php 
/*
Template name: Home
*/
$homeID = get_option( 'page_on_front' );
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
		<p id="highlight"><?php 
		$image = get_field( 'highlight', $homeID ); ?><img src="<?php 
		echo $image['sizes']['highlight']; ?>" alt="<?php 
		echo $image['title']; ?>" width="1024" height="825"></p>
		<ul id="features">
<?php 		while( has_sub_field( 'features', $homeID ) ) :
			$image = get_sub_field( 'image' ); ?>
			<li class="feat-item item-<?php echo ++$i; ?>"><a href="<?php 
			the_sub_field( 'link' ); ?>" target="_blank"><img src="<?php 
			echo $image['sizes']['feature']; ?>" alt="<?php 
			echo $image['title']; ?>" width="256" height="277"><span></span></a></li>
<?php 		endwhile; ?>
			<li class="feat-item item-facebook">
				<iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2FMythMyth&amp;width=256&amp;height=277&amp;show_faces=false&amp;colorscheme=light&amp;stream=true&amp;border_color=%23b89c52&amp;header=false&amp;appId=388342154530403" scrolling="no" style="border:none; overflow:hidden; width:256px; height:277px;" allowTransparency="true"></iframe>
			</li>
		</ul>
	</div>
<?php is_ajax() ? json_content() : get_footer( 'index' ); ?>