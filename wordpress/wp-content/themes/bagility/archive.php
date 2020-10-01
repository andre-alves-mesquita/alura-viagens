<?php
/**
 * The template for displaying archive pages.
 *
 * @package Bagility
 */
get_header();
bagility_theme_banner();
 ?>
<!-- Breadcrumb -->
<!--Page Title-->
<section class="mt-breadcrumb">		
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="title text-center">
					<?php the_archive_title( '<h1>', '</h1>' ); ?>
				</div>   
				<ul class="mt-breadcrumb-nav text-center">
					<?php
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
					?>
				</ul>
			</div>
		</div>
	</div>	
</section>
<!--/End of Page Title-->
<!-- /End Breadcrumb -->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
		  <div class="<?php echo ( !is_active_sidebar( 'sidebar_primary' ) ? '12' :'8' ); ?> col-sm-8 col-xs-12">
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
<?php get_footer(); ?>