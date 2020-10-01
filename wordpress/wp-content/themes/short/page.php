<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Short
 */
get_header(); 
?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
		<!-- Blog Area -->
			<?php if( class_exists('woocommerce') && (is_account_page() || is_cart() || is_checkout())) { ?>
			 <div class="col-<?php echo ( !is_active_sidebar( 'woo-sidebar' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
			<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; else : endif; ?>
			<?php } else { ?>
			 <div class="col-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
			<?php if( have_posts()) :  the_post(); ?>		
			<?php the_content(); ?>
			<?php endif; 
				while ( have_posts() ) : the_post();
				// Include the page
				the_content();
				comments_template( '', true ); // show comments
				
				endwhile;
			?>
			<!-- /Blog Area -->			
			</div>
			<!--Sidebar Area-->
			<div class="col-md-4 col-sm-4 col-xs-12">
				<?php 
				 if ( class_exists( 'WooCommerce' ) ) { if( is_account_page() || is_cart() || is_checkout() ) {
							get_sidebar('woo-sidebar'); 
					}
					else{ get_sidebar(); }
				}
				 else { get_sidebar(); }
				
				get_sidebar(); ?>
			</div>
			<?php } ?>
			<!--Sidebar Area-->
			</div>
		</div>
	</div>
</section>
<?php
get_footer();