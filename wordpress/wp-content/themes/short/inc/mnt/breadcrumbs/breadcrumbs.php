<?php
function short_pageURL() {
	$pageURL = 'http';
	if ( key_exists("HTTPS", $_SERVER) && ( $_SERVER["HTTPS"] == "on" ) ){
		$pageURL .= "s";
	}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
		$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
 }
 return $pageURL;
}

if( !function_exists('short_breadcrumbs') ):
	function short_breadcrumbs() { 
			
		global $post;
		$homeLink = home_url();
	
						echo '<ul class="mt-breadcrumb-nav text-center">';
						
						 if (is_home() || is_front_page()) :
							echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','short').'</a></li>';
							echo '<li class="active">'; echo single_post_title(); echo '</li>';
						 else:
							echo '<li><a href="'.esc_url($homeLink).'">'.esc_html__('Home','short').'</a></li>';
							if ( is_category() ) {
								echo '<li class="active"><a href="'. short_pageURL() .'">' . esc_html__('Archive by category','short').' "' . single_cat_title('', false) . '"</a></li>';

							} elseif ( is_day() ) {
								echo '<li class="active"><a href="'. esc_url(get_year_link(esc_attr(get_the_time('Y')))) . '">'. esc_html(get_the_time('Y')) .'</a>';
								echo '<li class="active"><a href="'. esc_url(get_month_link(esc_attr(get_the_time('Y')),esc_attr(get_the_time('m')))) .'">'. esc_html(get_the_time('F')) .'</a>';
								
								echo '<li class="active"><a href="'. short_pageURL() .'">'. esc_html(get_the_time('d')) .'</a></li>';

							} elseif ( is_month() ) {
								echo '<li class="active"><a href="' . get_year_link(esc_attr(get_the_time('Y'))) . '">' . esc_html(get_the_time('Y')) . '</a>';
								echo '<li class="active"><a href="'. short_pageURL() .'">'. esc_html(get_the_time('F')) .'</a></li>';

							} elseif ( is_year() ) {
								echo '<li class="active"><a href="'. short_pageURL() .'">'. esc_html(get_the_time('Y')) .'</a></li>';

							} elseif ( is_single() && !is_attachment() && is_page('single-product') ) {
								
								if ( get_post_type() != 'post' ) {
									$cat = get_the_category(); 
									$cat = $cat[0];
									echo '<li>';
										echo get_category_parents($cat, TRUE, '');
									echo '</li>';
									echo '<li class="active"><a href="' . short_pageURL() . '">'. wp_title( '',false ) .'</a></li>';
								} }  
								elseif ( is_page() && $post->post_parent ) {
								$parent_id  = $post->post_parent;
								$breadcrumbs = array();
								while ($parent_id) {
									$page = get_page($parent_id);
									$breadcrumbs[] = '<li class="active"><a href="' . esc_url(get_permalink($page->ID)) . '">' . wp_kses( force_balance_tags(get_the_title($page->ID)), $allowed_html ) . '</a>';
									$parent_id  = $page->post_parent;
								}
								$breadcrumbs = array_reverse($breadcrumbs);
								foreach ($breadcrumbs as $crumb) echo $crumb;
								
								echo '<li class="active"><a href="' . short_pageURL() . '">'. get_the_title() .'</a></li>';

							
							}
							elseif( is_search() )
							{
								echo '<li class="active"><a href="' . short_pageURL() . '">'. get_search_query() .'</a></li>';
							}
							elseif( is_404() )
							{
								echo '<li class="active"><a href="' . short_pageURL() . '">'.esc_html__('404','short').'</a></li>';
							}
							else { 
								echo '<li class="active"><a href="' . short_pageURL() . '">'. get_the_title() .'</a></li>';
							}
						endif;
						
						echo '</ul>';
			}
endif;
?>