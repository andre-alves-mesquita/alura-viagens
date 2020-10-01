<?php
/**
 * Short functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Short
 */
 
	define( 'SHORT_THEME_DIR', get_template_directory() . '/' );
	define( 'SHORT_THEME_URI', get_template_directory_uri() . '/' );
	define( 'SHORT_THEME_SETTINGS', 'short-settings' );
	
	$short_theme_path = get_template_directory() . '/inc/mnt/';
	/*-----------------------------------------------------------------------------------*/
	/*	Enqueue scripts and styles.
	/*-----------------------------------------------------------------------------------*/
	require( $short_theme_path .'/enqueue.php');
	/* ----------------------------------------------------------------------------------- */
	/* Customizer */
	/* ----------------------------------------------------------------------------------- */
	
	require( $short_theme_path . '/short-custom-navwalker.php' );
	require( $short_theme_path . '/default_menu_walker.php' );
	require( $short_theme_path . '/font/font.php');
	require( $short_theme_path . 'breadcrumbs/breadcrumbs.php');
	require( $short_theme_path . 'customize/front_page.php');
	require( $short_theme_path . '/customize/plugin_recommend.php');
	require( $short_theme_path . 'customize/class-alpha-color-control/class-alpha-color-control.php');
	require_once trailingslashit( get_template_directory()).'inc/init.php';
	require_once trailingslashit( get_template_directory()).'inc/mnt/customize/customize_partials.php';
	
	
if ( ! function_exists( 'short_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function short_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on short, use a find and replace
	 * to change 'short' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'short', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary menu', 'short' ),
	) );

	//Custom background support
	add_theme_support( 'custom-background' );

    // Set up the woocommerce feature.
    add_theme_support( 'woocommerce');
	
	//Custom logo
	
	add_theme_support( 'custom-logo', array(
		'height'      => 50,
		'width'       => 200,
		'flex-height' => true,
		'unlink-homepage-logo' => true, // Add Here!
	) );
	
	// custom header Support
			$args = array(
			'default-image'		=>  get_template_directory_uri() .'/images/page-title-bg.jpg',
			'width'			=> '1600',
			'height'		=> '600',
			'flex-height'		=> false,
			'flex-width'		=> false,
			'header-text'		=> true,
		);
		add_theme_support( 'custom-header', $args );

	//Added selective refresh for widget
	add_theme_support( 'customize-selective-refresh-widgets' );
	

}
endif;
add_action( 'after_setup_theme', 'short_setup' );


	function short_the_custom_logo() {
	
		if ( function_exists( 'the_custom_logo' ) ) {
			the_custom_logo();
		}

	}

	add_filter('get_custom_logo','short_logo_class');


	function short_logo_class($html)
	{
	$html = str_replace('custom-logo-link', 'navbar-brand', $html);
	return $html;
	}

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function short_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'short_content_width', 640 );
}
add_action( 'after_setup_theme', 'short_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function short_widgets_init() {
	
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar widget area', 'short' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<aside class="mt-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Woocommerce widget area', 'short' ),
		'id'            => 'woo-sidebar',
		'description'   => '',
		'before_widget' => '<aside class="mt-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );


	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget left area', 'short' ),
		'id'            => 'footer_widget_area_left',
		'description'   => '',
		'before_widget' => '<aside class="mt-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget central area', 'short' ),
		'id'            => 'footer_widget_area_center',
		'description'   => '',
		'before_widget' => '<aside class="mt-widget %2$st">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Footer widget right area', 'short' ),
		'id'            => 'footer_widget_area_right',
		'description'   => '',
		'before_widget' => '<aside class="mt-widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );

}
add_action( 'widgets_init', 'short_widgets_init' );

/*-----------------------------------------------------------------------------------*/
/*  customizer-controls
/*-----------------------------------------------------------------------------------*/
/* Custom template tags for this theme. */
require get_template_directory() . '/inc/template-tags.php';

/*-----------------------------------------------------------------------------------*/
/*  customizer-controls
/*-----------------------------------------------------------------------------------*/

function short_enqueue_customizer_controls_styles() {
  wp_register_style( 'short-customizer-controls', get_template_directory_uri() . '/css/customizer-controls.css', NULL, NULL, 'all' );
  wp_enqueue_style( 'short-customizer-controls' );
}
add_action( 'customize_controls_print_styles', 'short_enqueue_customizer_controls_styles' );

/*
 * Load customize pro
*/
require_once( trailingslashit( get_template_directory() ) . 'inc/mnt/customize-pro/class-customize.php' );

if ( ! function_exists( 'wp_body_open' ) ) :
	/**
	 * Fire the wp_body_open action.
	 *
	 * Added for backwards compatibility to support pre 5.2.0 WordPress versions.
	 *
	 * @since Twenty Nineteen 1.4
	 */
	function wp_body_open() {
		/**
		 * Triggered after the opening <body> tag.
		 *
		 * @since Twenty Nineteen 1.4
		 */
		do_action( 'wp_body_open' );
	}
endif;

//enqueues our external font awesome stylesheet
function enqueue_our_required_stylesheets(){
	wp_enqueue_style('short-font-awesome',get_template_directory_uri().'/css/font-awesome.min.css');
}
add_action('admin_enqueue_scripts','enqueue_our_required_stylesheets');

add_filter( 'woocommerce_show_page_title', 'short_hide_shop_page_title' );

function short_hide_shop_page_title( $title ) {
    if ( is_shop() ) $title = false;
    return $title;
}
?>