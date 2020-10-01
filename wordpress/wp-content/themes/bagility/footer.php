<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @package Bagility
 */
?>
<!--==================== Bagility-FOOTER AREA ====================-->
<!-- Footer Section -->
<footer id="footer" class="mt-footer">
	<?php if ( is_active_sidebar( 'footer_widget_area_left' ) ||  is_active_sidebar( 'footer_widget_area_center' ) || is_active_sidebar( 'footer_widget_area_right' )  ) { ?>
	<!-- Footer Widgets -->
	<div class="container mt-footer-inner">	
		<div class="row">
			<div class="col-md-4 col-sm-6 col-xs-12">						
				<?php  dynamic_sidebar( 'footer_widget_area_left' ); ?>
			</div>
			
			<div class="col-md-4 col-sm-6 col-xs-12">						
				<?php  dynamic_sidebar( 'footer_widget_area_center' ); ?>
			</div>
			
			<div class="col-md-4 col-sm-6 col-xs-12">						
				<?php  dynamic_sidebar( 'footer_widget_area_right' ); ?>
			</div>
		</div>
	</div>
	<!-- /Footer Widgets -->
	<?php } ?>
						
</footer>
<!-- End of Footer Section -->	
<!-- Footer Copyrights -->
<footer class="mt-copyright-area">
	<div class="container">	
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
			<div class="site-info">
				<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'bagility' ) ); ?>">
					<?php
					/* translators: placeholder replaced with string */
					printf( esc_html__( 'Proudly powered by %s', 'bagility' ), 'WordPress' );
					?>
				</a>
				<span class="sep"> | </span>
				<?php
				/* translators: placeholder replaced with string */
				printf( esc_html__( 'Theme: %1$s by %2$s.', 'bagility' ), 'Bagility', '<a href="' . esc_url( __( 'https://themeansar.com/', 'bagility' ) ) . '" rel="designer">Themeansar</a>' );
				?>
				
				
			</div>
			</div>
		</div>
	</div>
</footer>
<!-- /Footer Copyrights -->
</div>
<!-- /wrapper -->					
<div class="clearfix"></div>
<!-- Scroll To Top -->
<a href="#" class="page-scroll-up"><i class="fa fa-angle-up"></i></a>
<!-- /Scroll To Top -->
<?php wp_footer(); ?>	
</body>
</html>	