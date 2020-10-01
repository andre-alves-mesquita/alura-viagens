<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package Short
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<a class="skip-link screen-reader-text" href="#content">
<?php _e( 'Skip to content', 'short' ); ?></a>
	<!-- wrapper -->
	<div class="wrapper">
	<!-- Header -->
<header>
<!--Menubar-->
<nav class="navbar navbar-wp">
	<div class="container">
		<div class="navbar-header">
			<?php the_custom_logo(); ?>
            
			<?php  if ( display_header_text() ) : ?>
			<div class="site-branding-text">
				
				
				<h1 class="site-title"> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" style="color: #<?php header_textcolor(); ?>"><?php bloginfo('name'); ?></a></h1>
				<p class="site-description" style="color: #<?php header_textcolor(); ?>"><?php bloginfo('description'); ?></p>
			</div>
			<?php endif; ?>
			 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> 
			 	<span class="sr-only"><?php echo esc_html_e('Toggle navigation','short'); ?></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
          </div>
          <!-- /navbar-toggle --> 
          <!-- Navigation -->
          <div class="collapse navbar-collapse">
			<?php wp_nav_menu( array(
								'theme_location' => 'primary',
								'container'  => 'nav-collapse collapse navbar-inverse-collapse',
								'menu_class' => 'nav navbar-nav navbar-right',
								'fallback_cb' => 'short_fallback_page_menu',
								'walker' => new Short_nav_walker() 
							) ); 
						?>
				
		</div>
</nav>	
</header>