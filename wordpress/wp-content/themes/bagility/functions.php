<?php
/**
 * Theme functions and definitions
 *
 * @package Bagility
 */

if ( ! function_exists( 'bagility_theme_css' ) ) :

	/**
	 * Load assets.
	 *
	 * @since 1.0.
	 */
	function bagility_theme_css() {

	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style( 'style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'bagility-child-style', get_stylesheet_uri(), array( 'bagility-parent-style' ) );
	wp_enqueue_style( 'bagility-default-css', get_stylesheet_directory_uri()."/css/colors/default.css" );
	wp_dequeue_style( 'default',get_template_directory_uri() .'/css/colors/default.css');
	wp_enqueue_style( 'bagility-menu',get_stylesheet_directory_uri() .'/css/bagility-menu.css');
	wp_dequeue_style( 'short-menu',get_template_directory_uri() .'/css/short-menu.css');
	}

endif;

add_action( 'wp_enqueue_scripts', 'bagility_theme_css', 99 );


function bagility_theme_setup(){
	require( get_stylesheet_directory() . '/inc/mnt/customize/slider.php' );
	require( get_stylesheet_directory() . '/inc/mnt/customize/header-banner.php' );
	load_theme_textdomain( 'bagility', get_template_directory() . '/languages' );
}
add_action('after_setup_theme','bagility_theme_setup');


function bagility_theme_banner()
{
	$bagility_banner_enabled = get_theme_mod('bagility_banner_enabled','on');
	if($bagility_banner_enabled !='off'){
	get_template_part('sections/home','slider');
	} 
}
?>
