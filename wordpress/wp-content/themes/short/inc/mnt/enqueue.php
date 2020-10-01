<?php
function short_scripts() {

	wp_enqueue_style('bootstrap-min', get_template_directory_uri() . '/css/bootstrap.min.css');
	
	wp_enqueue_style('short-style', get_stylesheet_uri() );
	
	wp_enqueue_style('short-default', get_template_directory_uri() . '/css/colors/default.css');
	
	wp_enqueue_style('short-font-awesome',get_template_directory_uri().'/css/font-awesome.min.css');
	
	wp_enqueue_style('short-menu',get_template_directory_uri().'/css/short-menu.css');
	
	/* Js script */
	
	wp_enqueue_script('bootstrap-min-js', get_template_directory_uri() . '/js/bootstrap.min.js',array('jquery'));
	
	wp_enqueue_script('jquery.smartmenus', get_template_directory_uri() . '/js/jquery.smartmenus.js' , array('jquery'));

	wp_enqueue_script('jquery.smartmenus-btotstrap', get_template_directory_uri() . '/js/jquery.smartmenus.bootstrap.js' , array('jquery'));	
	

	wp_enqueue_script('short-main-js', get_template_directory_uri() . '/js/main.js' , array('jquery'));

	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action('wp_enqueue_scripts', 'short_scripts');

/**
 	* Added skip link focus
 	*/
	function short_skip_link_focus_fix() {
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
	}
	add_action( 'wp_print_footer_scripts', 'short_skip_link_focus_fix' );


function short_customizer_selective_preview() {
	wp_enqueue_script(
		'short-customizer-preview', get_template_directory_uri() . '/js/customizer.js', array(
			'jquery',
			'customize-preview',
		), 999, true
	);
}

add_action( 'customize_preview_init', 'short_customizer_selective_preview' );
?>