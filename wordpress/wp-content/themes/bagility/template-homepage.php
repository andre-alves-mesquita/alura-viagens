<?php 
/**
 // Template Name: Homepage
 */
get_header();
	get_template_part('sections/home', 'slider');
	do_action( 'sbp_short_homepage_sections', false );
get_footer();
?>