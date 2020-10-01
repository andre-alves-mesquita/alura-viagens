<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package Bagility
 */

get_header(); 
bagility_theme_banner();
?>
<!--==================== main content section ====================-->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
		  <div class="col-<?php echo ( !is_active_sidebar( 'sidebar-1' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
			  <?php 
				  while(have_posts()){ the_post();
				  get_template_part('content','');
				  } ?>
			  <div class="pagination">
					<?php //Previous / next page navigation
					the_posts_pagination( array(
					'prev_text'          => '<i class="fa fa-arrow-left"></i>',
					'next_text'          => '<i class="fa fa-arrow-right"></i>',
					) ); ?>
			  </div>
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