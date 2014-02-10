<?php 

$t_url = get_bloginfo( 'template_url' );

function t_url() {
	global $t_url;
	echo $t_url;
}

/* Setup */

add_action( 'after_setup_theme', 'my_setup' );
add_action( 'widgets_init', 'my_widgets_init' );
add_action( 'template_redirect', 'my_template_redirect' );

function my_setup() {
	register_nav_menu( 'menu', 'Menu' );

	add_image_size( 'highlight', 1024, 825, true );
	add_image_size( 'feature',    256, 277, true );
	add_image_size( 'clipping',   240, 180, true );
	add_image_size( 'collection', 872, 579, false );
	add_image_size( 'acf-thumb',  150, 150, true );
	add_image_size( 'lookbook',   284, 433, true );
}

function my_widgets_init() {
	register_sidebar( array(
		'name' 			=> 'Lateral',
		'before_widget' => "\t\t\t" . '<aside id="%1$s" class="widget %2$s">' . "\n",
		'after_widget' 	=> "\n\t\t\t" . '</aside>',
		'before_title' 	=> "\t\t\t\t" . '<h3 class="widget-title">',
		'after_title' 	=> '</h3>' . "\n",
	) );
}

function my_template_redirect() {
    if( is_search() ) {
        include( get_template_directory() . '/home.php' );
        exit();
    }
}

/* Scripts */

add_action( 'wp_enqueue_scripts', 'my_scripts' );

function my_scripts() {
	//$uri = get_stylesheet_directory_uri();
	//wp_enqueue_script( 'gmaps',  "http://maps.googleapis.com/maps/api/js?key=AIzaSyCfFXaWSu-ulSODlCeNMN2mXbKKe-lDppM&amp;sensor=false", array(), null, true );
	
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js', array(), false, true );
	wp_enqueue_script( 'jquery' );

	/*
	wp_enqueue_script( 'maskedinput', "{$uri}/js/jquery.maskedinput.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'jplayer', "{$uri}/js/jplayer/jquery.jplayer.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'playlist', "{$uri}/js/jplayer/jplayer.playlist.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'fancybox', "{$uri}/js/fancybox/jquery.fancybox-1.3.4.pack.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'tinycarousel', "{$uri}/js/jquery.tinycarousel.min.js", array( 'jquery' ), null, true );
	wp_enqueue_script( 'interface', "{$uri}/js/interface.js", array( 'jquery', 'jquery-ui-core' ), null, true );
	*/
	wp_enqueue_script( 'interface', "/min/?g=myth-js", array( 'jquery' ), null, true );
}

/* Ajax */

function is_ajax() {
	/*if ( ! empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' && ! empty( $_GET['ajax'] ) )*/
	if ( ! empty( $_GET['ajax'] ) )
		return true;
	return false;
}

function json_content() {
	$json = ob_get_contents();
	ob_end_clean();

	global $post;
	echo json_encode( array(
		'ID' => $post->ID,
		'slug' => is_front_page() ? 'home' : $post->post_name,
		'post_content' => $json,
	) );
}

/* Admin */

//add_action( 'admin_init', 'remove_editor_capabilities' );
add_action( 'login_enqueue_scripts', 'my_login_logo' );
add_filter( 'login_headerurl', 'my_login_logo_url' );
add_filter( 'login_headertitle', 'my_login_logo_url_title' );
add_filter( 'acf_options_page_title', 'my_acf_options_page_title' );

/*
function remove_editor_capabilities(){
	$role = get_role( 'editor' );
	$role->remove_cap( 'edit_pages' );
	$role->remove_cap( 'edit_others_pages' );
	$role->remove_cap( 'edit_published_pages' );
	$role->remove_cap( 'publish_pages' );
	$role->remove_cap( 'delete_pages' );
	$role->remove_cap( 'delete_others_pages' );
	$role->remove_cap( 'delete_published_pages' );
	$role->remove_cap( 'delete_private_pages' );
	$role->remove_cap( 'edit_private_pages' );
	$role->remove_cap( 'read_private_pages' );
}	
*/
function my_login_logo() { ?>
<style type="text/css">
body.login div#login h1 a {
	background-image: url(<?php echo get_bloginfo( 'template_directory' ) ?>/img/myth.png);
	background-size: auto;
	height: 117px;
	margin-left: auto;
	margin-right: auto;
	width: 223px;
}
.login #nav a,
.login #backtoblog a { color: #ec008c !important }
.login #nav a:hover,
.login #backtoblog a:hover { color: #3a041c !important }
.wp-core-ui .button-primary {
	background: #ec008c;
	border-color: #ec008c;
}
.wp-core-ui .button-primary:hover {
	background: #3a041c;
	border-color: #3a041c;
}

</style>
<?php }

function my_login_logo_url() {
	return get_bloginfo( 'url' );
}
function my_login_logo_url_title() {
	return 'Ir para o início';
}

function my_acf_options_page_title( $title ) {
	return 'Redes Sociais';
}
