<?php
/**
 * The template for displaying search results pages.
 *
 * @package short
 */

get_header(); ?>
<!--==================== Breadcrumb section ====================-->
<?php get_template_part('index','banner'); ?>
<!--==================== main content section ====================-->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
		  <div class="col-md-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
          <?php 
		global $i;
		if ( have_posts() ) : ?>
		<h2><?php printf( __( "Search Results for: %s", 'short' ), '<span>' . get_search_query() . '</span>' ); ?></h2>
		<?php while ( have_posts() ) : the_post();  
		 get_template_part('content','');
		 endwhile; else : ?>
		<h2><?php esc_html_e( "Nothing Found", 'short' ); ?></h2>
		<div class="">
		<p><?php esc_html_e( "Sorry, but nothing matched your search criteria. Please try again with some different keywords.", 'short' ); ?>
		</p>
		<?php get_search_form(); ?>
		</div><!-- .blog_con_mn -->
		<?php endif; ?>
		</div>
			<div class="col-md-4 col-sm-4 col-xs-12">
			<?php get_sidebar(); ?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
?>