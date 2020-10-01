<?php
function bagility_banner_section_setting( $wp_customize ){
$selective_refresh = isset( $wp_customize->selective_refresh ) ? 'postMessage' : 'refresh';	
	
class Bagility_Banner_Toggle_Switch_Custom_control extends WP_Customize_Control {
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
	$wp_customize->add_section( 'banner_page_section' , array(
		'title'      => __('Banner settings', 'bagility'),
		'priority'   => 30,
   	) );
		
	
		
	$wp_customize->add_setting( 'bagility_banner_enabled',
		   array(
			  'default' => 1,
			  'transport' => 'refresh',
			  'sanitize_callback' => 'bagility_switch_sanitization'
		   )
		);
		 
		$wp_customize->add_control( new Bagility_Banner_Toggle_Switch_Custom_control( $wp_customize, 'bagility_banner_enabled',
		   array(
			  'label' => esc_html__( 'Banner image Enable/Disable from all pages','bagility' ),
			  'section' => 'banner_page_section'
		   )
		) );
}

add_action('customize_register','bagility_banner_section_setting');
?>