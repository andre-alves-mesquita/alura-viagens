<?php
/**
 * The template for displaying all WooCommerce pages.
 *
 * @package short-
 */
get_header(); ?>
<!--==================== ti breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!-- #main -->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
			<div class="col-md-<?php echo ( !is_active_sidebar( 'woo-sidebar' ) ? '12' :'8' ); ?> col-xs-12">
				<?php woocommerce_content(); ?>
			</div>
		</div><!-- .container -->
	</div>	
</section><!-- #main -->
<?php get_footer(); ?>