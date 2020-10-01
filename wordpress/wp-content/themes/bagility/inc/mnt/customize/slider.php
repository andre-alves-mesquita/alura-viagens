<?php
function bagility_front_page_section_setting( $wp_customize ){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	
/* HomePage section setting */
$wp_customize->add_panel( 'home_page_settings', array(
	'priority'       => 33,
	'capability'     => 'edit_theme_options',
	'title'      => __('Homepage section settings','bagility'),
) );


class Bagility_Toggle_Switch_Custom_control extends WP_Customize_Control {
		/**
		 * The type of control being rendered
		 */
		public $type = 'toogle_switch';
		/**
		 * Enqueue our scripts and styles
		 */
		/**
		 * Render the control in the customizer
		 */
		public function render_content(){
		?>
			<div class="toggle-switch-control">
				<div class="toggle-switch">
					<input type="checkbox" id="<?php echo esc_attr($this->id); ?>" name="<?php echo esc_attr($this->id); ?>" class="toggle-switch-checkbox" value="<?php echo esc_attr( $this->value() ); ?>" <?php $this->link(); checked( $this->value() ); ?>>
					<label class="toggle-switch-label" for="<?php echo esc_attr( $this->id ); ?>">
						<span class="toggle-switch-inner"></span>
						<span class="toggle-switch-switch"></span>
					</label>
				</div>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php if( !empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</div>
		<?php
		}
}


/* Slider Section */
	$wp_customize->add_section( 'slider_section' , array(
		'title'      => __('Slider settings', 'bagility'),
		'panel'  => 'home_page_settings',
		'priority'   => 1,
   	) );
		
		// Enable slider
		
		
		
		$wp_customize->add_setting( 'home_page_slider_enabled',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'bagility_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Bagility_Toggle_Switch_Custom_control( $wp_customize, 'home_page_slider_enabled',
		   array(
			  'label' => esc_html__( 'Slider Enable/Disable','bagility' ),
			  'section' => 'slider_section'
		   )
		) );

		
		//Slider Image
		$wp_customize->add_setting( 'slider_image',array('default' => get_stylesheet_directory_uri() .'/images/slider/banner.jpg',
		'sanitize_callback' => 'esc_url_raw'));
 
		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'slider_image',
				array(
					'type'        => 'upload',
					'label' => __('Image','bagility'),
					'settings' =>'slider_image',
					'section' => 'slider_section',
					
				)
			)
		);
		
		// Image overlay
		$wp_customize->add_setting( 'slider_image_overlay', array(
			'default' => true,
			'sanitize_callback' => 'bagility_sanitize_checkbox',
		) );
		
		$wp_customize->add_control('slider_image_overlay', array(
			'label'    => __('Enable slider image overlay', 'bagility' ),
			'section'  => 'slider_section',
			'type' => 'checkbox',
		) );
		
		
		//Slider Background Overlay Color
		$wp_customize->add_setting( 'slider_overlay_section_color', array(
			'sanitize_callback' => 'bagility_sanitize_rgba',
			'default' => 'rgba(0,0,0,0.30)',
            ) );	
            
            $wp_customize->add_control(new Short_Customize_Alpha_Color_Control( $wp_customize,'slider_overlay_section_color', array(
               'label'      => __('Slider image overlay color','bagility' ),
                'palette' => true,
                'section' => 'slider_section')
            ) );
		
		
		// Slider title
		$wp_customize->add_setting( 'slider_title',array(
		'default' => __('We are Best in Premium Consulting Services','bagility'),
		'transport'         => $selective_refresh,
		'sanitize_callback' => 'bagility_sanitize_text',
		));	
		$wp_customize->add_control( 'slider_title',array(
		'label'   => __('Title','bagility'),
		'section' => 'slider_section',
		'type' => 'text',
		));	
		
		//Slider discription
		$wp_customize->add_setting( 'slider_discription',array(
		'default' => 'we bring the proper people along to challenge esmtblished thinking and drive transformation.',
		'transport'         => $selective_refresh,
		'sanitize_callback' => 'bagility_sanitize_text',
		));	
		$wp_customize->add_control( 'slider_discription',array(
		'label'   => __('Description','bagility'),
		'section' => 'slider_section',
		'type' => 'textarea',
		));
		
		
		// Slider button text
		$wp_customize->add_setting( 'slider_btn_txt',array(
		'default' => __('Read more','bagility'),
		'transport'         => $selective_refresh,
		'sanitize_callback' => 'bagility_sanitize_text',
		));	
		$wp_customize->add_control( 'slider_btn_txt',array(
		'label'   => __('Button Text','bagility'),
		'section' => 'slider_section',
		'type' => 'text',
		));
		
		// Slider button link
		$wp_customize->add_setting( 'slider_btn_link',array(
		'default' => '#',
		'transport'         => $selective_refresh,
		'sanitize_callback' => 'esc_url_raw',
		));	
		$wp_customize->add_control( 'slider_btn_link',array(
		'label'   => __('Button Link','bagility'),
		'section' => 'slider_section',
		'type' => 'text',
		));
		
		// Slider button target
		$wp_customize->add_setting(
		'slider_btn_target', 
			array(
			'default'        => false,
			'sanitize_callback' => 'bagility_sanitize_checkbox',
			
		));
		$wp_customize->add_control('slider_btn_target', array(
			'label'   => __('Open link in a new tab', 'bagility'),
			'section' => 'slider_section',
			'type' => 'checkbox',
		));
		
		
		
}
add_action( 'customize_register', 'bagility_front_page_section_setting' );


/**
 * Add selective refresh for slider section controls.
 */
function bagility_register_slider_section_partials( $wp_customize ){

	
	
	$wp_customize->selective_refresh->add_partial( 'slider_image', array(
		'selector'            => '.mt-slider-warraper .item figure',
		'settings'            => 'slider_image',
		'render_callback'  => 'bagility_slider_image_render_callback',
	
	) );
	
	//Slider section
	$wp_customize->selective_refresh->add_partial( 'slider_title', array(
		'selector'            => '.slide-inner-box-two h1',
		'settings'            => 'slider_title',
		'render_callback'  => 'bagility_slider_title_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'slider_discription', array(
		'selector'            => '.slide-inner-box-two p',
		'settings'            => 'slider_discription',
		'render_callback'  => 'bagility_slider_iscription_render_callback',
	
	) );
	
	$wp_customize->selective_refresh->add_partial( 'slider_btn_txt', array(
		'selector'            => '.slide-inner-box-two a',
		'settings'            => 'slider_btn_txt',
		'render_callback'  => 'bagility_slider_btn_render_callback',
	
	) );
}

add_action( 'customize_register', 'bagility_register_slider_section_partials' );


function bagility_slider_image_render_callback() {
	return get_theme_mod( 'slider_image' );
}


function bagility_slider_title_render_callback() {
	return get_theme_mod( 'slider_title' );
}

function bagility_slider_iscription_render_callback() {
	return get_theme_mod( 'slider_discription' );
}

function bagility_slider_btn_render_callback() {
	return get_theme_mod( 'slider_btn_txt' );
}

if ( ! function_exists( 'bagility_switch_sanitization' ) ) {
		function bagility_switch_sanitization( $input ) {
			if ( true === $input ) {
				return 1;
			} else {
				return 0;
			}
		}
}


function bagility_sanitize_rgba( $value ) {
				
		$red   = 'rgba(0,0,0,0)';
		$green = 'rgba(0,0,0,0)';
		$blue  = 'rgba(0,0,0,0)';
		$alpha = 'rgba(0,0,0,0)';   // If empty or an array return transparent
		if ( empty( $value ) || is_array( $value ) ) {
			return '';
		}

		// By now we know the string is formatted as an rgba color so we need to further sanitize it.
		$value = str_replace( ' ', '', $value );
		sscanf( $value, 'rgba(%d,%d,%d,%f)', $red, $green, $blue, $alpha );
		return 'rgba(' . $red . ',' . $green . ',' . $blue . ',' . $alpha . ')';
}

if ( ! function_exists( 'bagility_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 *
	 * @since 1.0.0
	 *
	 * @param bool $checked Whether the checkbox is checked.
	 * @return bool Whether the checkbox is checked.
	 */
	function bagility_sanitize_checkbox( $checked ) {

		return ( ( isset( $checked ) && true === $checked ) ? true : false );
	}

endif;

function bagility_sanitize_text( $input ) {

		return wp_kses_post( force_balance_tags( $input ) );

}
?>