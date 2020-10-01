<?php
function short_front_page_section_setting( $wp_customize ){
	
	/* HomePage section setting */
	$wp_customize->add_panel( 'home_page_settings', array(
		'priority'       => 33,
		'capability'     => 'edit_theme_options',
		'title'      => __('Homepage section settings','short'),
	) );

$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	

if ( isset( $wp_customize->selective_refresh ) ) {
	
	// site title
	$wp_customize->selective_refresh->add_partial(
		'blogname',
		array(
			'selector'        => '.site-title',
			'render_callback' => array( 'Short_Customizer_Partials', 'customize_partial_blogname' ),
		)
	);

    // site tagline
	$wp_customize->selective_refresh->add_partial(
		'blogdescription',
		array(
			'selector'        => '.site-description',
			'render_callback' => array( 'Short_Customizer_Partials', 'customize_partial_blogdescription' ),
		)
	);
}

}
add_action( 'customize_register', 'short_front_page_section_setting' );
?>