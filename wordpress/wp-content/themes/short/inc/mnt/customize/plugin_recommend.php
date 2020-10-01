<?php
/* Notify in customizer */
require get_template_directory() . '/inc/mnt/customizer-notify/short-customizer-notify.php';

$config_customizer = array(
	'recommended_plugins'       => array(
		'shortbuild' => array(
			'recommended' => true,
			'description' => wp_kses_post('Activate by installing <strong>ShortBuild</strong> plugin to use front page and all theme features.', 'short'),
		),
	),
	'recommended_actions'       => array(),
	'recommended_actions_title' => esc_html__( 'Recommended Actions', 'short' ),
	'recommended_plugins_title' => esc_html__( 'Recommended Plugin', 'short' ),
	'install_button_label'      => esc_html__( 'Install and Activate', 'short' ),
	'activate_button_label'     => esc_html__( 'Activate', 'short' ),
	'deactivate_button_label'   => esc_html__( 'Deactivate', 'short' ),
);
Short_Customizer_Notify::init( apply_filters( 'short_customizer_notify_array', $config_customizer ) );
?>