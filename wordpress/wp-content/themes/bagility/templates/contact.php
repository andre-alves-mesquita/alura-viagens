<?php

/**
 * Template Name: Contact page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @package Bagility
 */

get_header();
bagility_theme_banner();
get_template_part('index','banner'); ?>
<!-- About Section -->
<section id="section" class="site-content">
	<div class="container">
		<div class="row">
			<!-- Blog Area -->
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
			</div>
			
			<div class="col-md-4 col-sm-4 col-xs-12">
				<?php get_sidebar(); ?>
			</div>
			
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>