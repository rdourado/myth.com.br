<?php 
/*
Template name: Lojas
*/
$data = array();
foreach( get_field( 'stores' ) as $store ) {
	$state = $store['state'];
	$arr = array(
		'slug' 	  => sanitize_title( "{$state}-" . $store['name'] ),
		'name' 	  => $store['name'],
		'phone'   => $store['phone'],
		'address' => $store['address']
	);
	$data[$state] ? $data[$state][] = $arr : $data[$state] = array( $arr );
}
ksort( $data );
?>
<?php is_ajax() ? ob_start() : get_header(); ?>
	<div id="body">
		<article id="content" class="hentry">
			<h1 class="entry-title">Lojas</h1>
			<div class="entry-content">
				<div id="storesform">
					<p class="field">
						<label for="states">Escolha o estado:</label>
						<select name="states" id="states" class="field-select">
<?php 						foreach( $data as $state => $stores ) : ?>
							<option value="<?php 
							echo $state; ?>"><?php 
							echo $state; ?></option>
<?php 						endforeach; ?>
						</select>
					</p>
					<p class="field">
						<label for="places">Escolha a loja:</label>
						<select name="places" id="places" class="field-select">
<?php 						foreach( $data as $state => $stores ) : ?>
							<optgroup label="<?php echo $state; ?>">
<?php 							foreach( $stores as $j => $store ) : ?>
								<option value="<?php 
								echo $store['slug']; ?>"><?php 
								echo $store['name']; ?></option>
<?php 							endforeach; ?>
							</optgroup>
<?php 						endforeach; ?>
						</select>
					</p>
				</div>
<?php 			foreach( $data as $state => $stores ) : ?>
				<h2 class="state"><?php echo $state; ?></h2>
				<ul class="stores">
<?php 				foreach( $stores as $j => $store ) : ?>
					<li id="<?php echo $store['slug']; ?>">
						<h3 class="store-name"><?php 
						echo $store['name']; ?></h3>
						<p><?php 
						$address = $store['address'];
						$address = str_replace( '[', '<span>', $address );
						$address = str_replace( ']', '</span>', $address );
						echo $address; ?><br />Tel: <?php 
						echo $store['phone']; ?></p>
					</li>
<?php 				endforeach; ?>
				</ul>
<?php 			endforeach; ?>
				<div id="map_canvas"></div>
				<a href="<?php the_field( 'instagram', 'options' ); ?>" target="_blank" id="instagram"><img src="<?php t_url(); ?>/img/myth-instagram.png" alt="Siga a Myth no Instagram" width="268" height="76"></a>
			</div>
		</article>
	</div>
<?php is_ajax() ? json_content() : get_footer(); ?>