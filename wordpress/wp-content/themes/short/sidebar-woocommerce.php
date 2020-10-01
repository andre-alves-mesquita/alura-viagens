<?php
/**
 * side bar template
 *
 * @package WordPress
 */
?>
<?php if ( is_active_sidebar( 'woo-sidebar' )  ) : ?>
<!--Sidebar-->
<?php dynamic_sidebar( 'woo-sidebar' ); ?>
<!--/End of Sidebar-->
<?php endif; ?>