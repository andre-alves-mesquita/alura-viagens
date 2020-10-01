<?php

/**
 * Template Name: About Us
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
			<div class="col-md-12">
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
			</div>
		</div>
	</div>
</section>
<?php get_footer(); ?>