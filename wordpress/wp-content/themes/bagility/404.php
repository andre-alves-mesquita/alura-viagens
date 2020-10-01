<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @package Bagility
 */
get_header();
bagility_theme_banner();
?>
<!--Page Title-->
<section class="mt-breadcrumb">		
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="title text-center">
					<h1><?php echo esc_html_e('404','bagility'); ?></h1>
				</div>   
				<ul class="mt-breadcrumb-nav text-center">
					<li><a href="#"><?php echo esc_html_e('Home','bagility'); ?></a></li>
					<li class="active"><?php echo esc_html_e('404','bagility'); ?></li>
				</ul>
			</div>
		</div>
	</div>	
</section>
<!--/End of Page Title-->
<!--404 Error Page-->
<section id="section" class="error-page">		
	<div class="container">
		<div class="row v-center">
			<div class="col-md-12 col-sm-12 col-xs-12">							
				<div class="error-404 text-center">
					<h1><?php echo esc_html_e('4','bagility'); ?><i class="fa fa-frown-o"></i><?php echo esc_html_e('4','bagility'); ?>
					</h1><h2><?php echo esc_html_e('Oops! Page not found','bagility'); ?></h2>
					<p><?php echo esc_html_e('We are sorry, but the page you are looking for does not exist.','bagility'); ?></p>
					<div class="btn-block text-center">
						<a href="#" class="btn-large btn-dark btn-animation" target="_blank"><?php echo esc_html_e('Go Back','bagility'); ?></a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>		
<!--/End of 404 Error Page-->
<?php
get_footer();