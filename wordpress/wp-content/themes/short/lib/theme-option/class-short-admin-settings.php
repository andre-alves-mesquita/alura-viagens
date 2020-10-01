<?php
/**
 * Admin settings helper
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package     Short
 * @since 1.0.0
 */
if ( ! defined( 'ABSPATH' ) ){
	exit;
}
/**
 * Add admin notice when active theme, just show one time
 *
 * @return bool|null
 */
add_action( 'admin_notices', 'short_admin_notice' );
function short_admin_notice() {
  global $current_user;
  $user_id   = $current_user->ID;
  $theme_data  = wp_get_theme();
  if ( !get_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ) ) {
    ?>
    <div class="notice short-notice">

      
	  <div class="short-logo">
	  </div>
	  
	  <h1>
        <?php
        /* translators: %1$s: theme name, %2$s theme version */
        printf( esc_html__( 'Thanks For Choosing %1$s - Version %2$s', 'short' ), esc_html( $theme_data->Name ), esc_html( $theme_data->Version ) );
        ?>
      </h1>
      <p>
        <?php
        /* translators: %1$s: theme name, %2$s link */
        printf( __( 'Visit short page to take full advantage of theme.', 'short' ), esc_html( $theme_data->Name ), esc_url( admin_url( 'themes.php?page=short' ) ) );
        printf( '<a href="%1$s" class="notice-dismiss dashicons dashicons-dismiss dashicons-dismiss-icon"></a>', '?' . esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore=0' );
        ?>
      </p>
      <p>
        <a href="<?php echo esc_url( admin_url( 'themes.php?page=short' ) ) ?>" class="button button-primary button-hero" style="text-decoration: none;">
          <?php
          /* translators: %s theme name */
          printf( esc_html__( 'Get started with %s', 'short' ), esc_html( $theme_data->Name ) )
          ?>
        </a>
      </p>
    </div>
    <?php
  }
}
add_action( 'admin_init', 'short_notice_ignore' );
function short_notice_ignore() {
  global $current_user;
  $theme_data  = wp_get_theme();
  $user_id   = $current_user->ID;
  /* If user clicks to ignore the notice, add that to their user meta */
  if ( isset( $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) && '0' == $_GET[ esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore' ] ) {
    add_user_meta( $user_id, esc_html( $theme_data->get( 'TextDomain' ) ) . '_notice_ignore', 'true', true );
  }
}

/*****************************************/

if ( ! class_exists( 'short_Admin_Settings' ) ){
    /**
	 * short Admin Settings
	 */
	class short_Admin_Settings{

    /**
		 * View all actions
		 *
		 * @since 1.0
		 * @var array $view_actions
		 */
		static public $view_actions = array();

		/**
		 * Menu page title
		 *
		 * @since 1.0
		 * @var array $menu_page_title
		 */
		static public $menu_page_title = 'short Theme';

		/**
		 * Page title
		 *
		 * @since 1.0
		 * @var array $page_title
		 */
		static public $page_title = 'short';

		/**
		 * Plugin slug
		 *
		 * @since 1.0
		 * @var array $plugin_slug
		 */
		static public $plugin_slug = 'short';

		/**
		 * Default Menu position
		 *
		 * @since 1.0
		 * @var array $default_menu_position
		 */
		static public $default_menu_position = 'themes.php';

		/**
		 * Parent Page Slug
		 *
		 * @since 1.0
		 * @var array $parent_page_slug
		 */
		static public $parent_page_slug = 'general';

		/**
		 * Current Slug
		 *
		 * @since 1.0
		 * @var array $current_slug
		 */
		static public $current_slug = 'general';

		/**
		 * Constructor
		 */
		function __construct() {

			if ( ! is_admin() ) {
				return;
			}

			add_action( 'after_setup_theme', __CLASS__ . '::init_admin_settings', 99 );
		}
        /**
		 * Admin settings init
		 */
		static public function init_admin_settings() {
			self::$menu_page_title = apply_filters( 'short_menu_page_title', __( 'Short Options', 'short' ) );
			self::$page_title      = apply_filters( 'short_page_title', __( 'short', 'short' ) );

			if ( isset( $_REQUEST['page'] ) && strpos( $_REQUEST['page'], self::$plugin_slug ) !== false ) {
				add_action( 'admin_enqueue_scripts', __CLASS__ . '::styles_scripts' );
            
				// Let extensions hook into saving.
				do_action( 'short_admin_settings_scripts' );
				self::save_settings();
			}
            add_action( 'admin_enqueue_scripts', __CLASS__ . '::admin_scripts' );
			add_action( 'admin_menu', __CLASS__ . '::add_admin_menu', 99 );

			add_action( 'short_menu_general_action', __CLASS__ . '::general_page',99 );
			add_action( 'short_header_right_section', __CLASS__ . '::top_header_right_section' );
			add_filter( 'admin_title', __CLASS__ . '::short_admin_title', 10, 2 );
			add_action( 'short_welcome_page_right_sidebar_content', __CLASS__ . '::short_welcome_page_starter_sites_section', 10 );
			add_action( 'short_welcome_page_right_sidebar_content', __CLASS__ . '::short_welcome_page_knowledge_base_scetion', 11 );
			add_action( 'short_welcome_page_right_sidebar_content', __CLASS__ . '::short_welcome_page_five_star_scetion', 12 );
			add_action( 'short_welcome_page_content', __CLASS__ . '::short_welcome_page_content' );
			// AJAX.
			add_action( 'wp_ajax_short-sites-plugin-activate', __CLASS__ . '::required_plugin_activate' );

		}
		 /**
		 * View actions
		 */
		static public function get_view_actions() {

			if ( empty( self::$view_actions ) ) {

				$actions            = array(
					'general' => array(
						'label' => __( 'Welcome', 'short' ),
						'show'  => ! is_network_admin(),
					),
				);
				self::$view_actions = apply_filters( 'short_menu_options', $actions );
			}

			return self::$view_actions;
		}
        /**
		 * Save All admin settings here
		 */
		static public function save_settings() {

			// Only admins can save settings.
			if ( ! current_user_can( 'manage_options' ) ){
				return;
			}

			// Let extensions hook into saving.
			do_action( 'short_admin_settings_save' );
		}

        /**
		 * Enqueues the needed CSS/JS for the builder's admin settings page.
		 *
		 * @since 1.0
		 */
		static public function styles_scripts(){
			// Styles.
			wp_enqueue_style( 'short-admin-settings', SHORT_THEME_URI . 'lib/theme-option/assets/css/short-admin-menu-settings.css', array(), 999 );
			// Script.
		}

		/**
		 * Enqueues the needed CSS/JS for Backend.
		 *
		 * @since 1.0
		 */
		static public function admin_scripts(){
			// Styles.
			wp_enqueue_style( 'short-admin', SHORT_THEME_URI . 'lib/theme-option/assets/css/short-admin.css', array(), 999 );

		}
        /**
		 * Add main menu
		 *
		 * @since 1.0
		 */
		static public function add_admin_menu() {

			$parent_page    = self::$default_menu_position;
			$page_title     = self::$menu_page_title;
			$capability     = 'manage_options';
			$page_menu_slug = self::$plugin_slug;
			$page_menu_func = __CLASS__ . '::menu_callback';

			if ( apply_filters( 'short_dashboard_admin_menu', true ) ) {
				add_theme_page( $page_title, $page_title, $capability, $page_menu_slug, $page_menu_func );
			} else {
				do_action( 'short_register_admin_menu', $parent_page, $page_title, $capability, $page_menu_slug, $page_menu_func );
			}
		}

        /**
		 * Menu callback
		 *
		 * @since 1.0
		 */
		static public function menu_callback() {

			$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;

			$active_tab   = str_replace( '_', '-', $current_slug );
			$current_slug = str_replace( '-', '_', $current_slug );

			$ast_icon           = apply_filters( 'short_page_top_icon', true );
			$ast_visit_site_url = apply_filters( 'short_site_url', 'https://themeansar.com' );
			$ast_wrapper_class  = apply_filters( 'short_welcome_wrapper_class', array( $current_slug ) );
			$my_theme = wp_get_theme();
			$consult_theme_version = $my_theme->get( 'Version' );
            
			?>
			<div class="consult-menu-page-wrapper wrap consult-clear <?php echo esc_attr( implode( ' ', $ast_wrapper_class ) ); ?>">
					<div class="consult-theme-page-header">
						<div class="consult-container consult-flex">
							<div class="consult-theme-title">
								<a href="<?php echo esc_url( $ast_visit_site_url ); ?>" target="_blank" rel="noopener" >
								<?php if ( $ast_icon ) { ?>
									<img src="<?php echo esc_url( SHORT_THEME_URI . 'lib/theme-option/assets/images/logo.png' ); ?>" class="consult-theme-icon" alt="<?php echo esc_attr( self::$page_title ); ?> " >
									<span class="short-theme-version"><?php echo  esc_html($consult_theme_version); ?></span>
								<?php } ?>
								<?php do_action( 'short_welcome_page_header_title' ); ?>
								</a>
							</div>
							<?php do_action( 'short_header_right_section' ); ?>
						</div>
					</div>
				<?php do_action( 'short_menu_' . esc_attr( $current_slug ) . '_action' ); ?>
			</div>
			<?php
		}
        /**
		 * Include general page
		 *
		 * @since 1.0
		 */
		static public function general_page(){
			get_template_part( 'lib/theme-option/view-general');
		}
        
        /**
		 * Include Welcome page right starter sites content
		 *
		 * @since 1.2.4
		 */
		static public function short_welcome_page_starter_sites_section(){
			?>
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror">
					<span class="dashicons dashicons-admin-customizer"></span>
					<span><?php echo esc_html( apply_filters( 'short_sites_menu_page_title', __( 'Install Plugin', 'short' ) ) ); ?></span>
				</h2>
				<img class="consult-starter-sites-img" src="<?php echo esc_url( SHORT_THEME_URI . 'lib/theme-option/assets/images/short-preview.png' ); ?>">
				<div class="inside">
					
					<p>
						<?php
							esc_html_e( 'Click the below button and install ShortBuild plugin in customizer Setting for full advatages frontpage and many other theme feature', 'short' );
						?>
					</p>
					<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary button-hero" style="text-decoration: none;">
					<?php echo esc_html__('Go to the Customizer','short'); ?> </a>
				</div>
			</div>

			<?php
		}
        /**
		 * Include Welcome page right side knowledge base content
		 *
		 * @since 1.2.4
		 */
		static public function short_welcome_page_knowledge_base_scetion(){
			?>

			<div class="postbox">
				<h2 class="hndle consult-normal-cusror">
					<span class="dashicons dashicons-book"></span>
					<span><?php esc_html_e( 'Learn More', 'short' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php esc_html_e( 'Want to know how it works, take a look on this and get whole knowledge about short. Learn short', 'short' ); ?>
					</p>
					<a href="<?php echo esc_url('https://themeansar.com/help/'); ?>" target="_blank" rel="noopener"><?php echo esc_html__('Visit Us','short'); ?></a>
				</div>
			</div>
			<?php
		}

	
		/**
		 * Include Welcome page right side Five Star Support
		 *
		 * @since 1.2.4
		 */
		static public function short_welcome_page_five_star_scetion(){
			?>
			<div class="postbox">
				<h2 class="hndle short-normal-cusror">
					<span class="dashicons dashicons-sos"></span>
					<span><?php esc_html_e( 'Customer Support', 'short' ); ?></span>
				</h2>
				<div class="inside">
					<p>
						<?php
						printf(
							esc_html__( 'We start with what the customer needs and we work backwards. You\'re absolutely free to contact us and short team will be happy to help you.', 'short' ));
						?>
					</p>
					<a href="<?php echo esc_url('https://themeansar.com/submit-ticket/'); ?>" target="_blank" rel="noopener"><?php echo esc_html__('Submit Ticket','short'); ?></a>
				</div>
			</div>
			<?php
		}

         
		/**
		 * Include Welcome page content
		 *
		 * @since 1.2.4
		 */
		static public function short_welcome_page_content() {

			$short_addon_tagline = apply_filters( 'short_addon_list_tagline', __( 'Get More Options with short Pro!', 'short' ) );
			$consult_visit_pro_feature_site_url = apply_filters( 'short_pro_site_url', 'http://themeansar.com/themes/short-pro/' );
			
			
			// Quick settings.
			$quick_settings = apply_filters(
				'short_quick_settings',
				array(
					'logo-favicon' => array(
						'title'     => __( 'Upload Logo', 'short' ),
						'dashicon'  => 'dashicons-format-image',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_logo' ),
					),
					'colors'       => array(
						'title'     => __( 'Set Colors', 'short' ),
						'dashicon'  => 'dashicons-admin-customizer',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=custom_color' ),
					),
					
					'sidebars'     => array(
						'title'     => __( 'Sidebar Options', 'short' ),
						'dashicon'  => 'dashicons-align-left',
						'quick_url' => admin_url( 'customize.php?autofocus[control]=short-section-sidebar-group' ),
					),
					
					'social'     => array(
						'title'     => __( 'Social Icon', 'short' ),
						'dashicon'  => 'dashicons-groups',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=short-social-icon' ),
					),
					
					'site-button'     => array(
						'title'     => __( 'Site Button', 'short' ),
						'dashicon'  => 'dashicons-admin-post',
						'quick_url' => admin_url( 'customize.php?autofocus[section]=short-site-button' ),
					),
				)
			);
			?>
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror"><span><?php esc_html_e( 'Visit to Customizer Settings:', 'short' ); ?></span></h2>
					<div class="consult-quick-setting-section">
						<?php
						if ( ! empty( $quick_settings ) ) :
							?>
							<div class="consult-quick-links">
								<ul class="consult-flex">
									<?php
									foreach ( (array) $quick_settings as $key => $link ) {
										echo '<li class=""><span class="dashicons ' . esc_attr( $link['dashicon'] ) . '"></span><a class="ast-quick-setting-title" href="' . esc_url( $link['quick_url'] ) . '" target="_blank" rel="noopener">' . esc_html( $link['title'] ) . '</a></li>';
									}
									?>
								</ul>
							</div>
						<?php endif; ?>
					</div>
			</div>
			
			<div class="postbox">
				<h2 class="hndle consult-normal-cusror"><span><?php esc_html_e( 'Short Usefull Links', 'short' ); ?></span></h2>
					<div class="consult-quick-setting-section">
													<div class="consult-quick-links">
								<ul class="consult-flex">
									<li class=""><span class="dashicons dashicons-format-image"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://demo.themeansar.com/short/lite/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Lite Demo', 'short' ); ?></a></li>
									
									<li class=""><span class="dashicons dashicons-format-image"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://demo.themeansar.com/short/default/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Pro Demo', 'short' ); ?></a></li>
									
									<li class=""><span class="dashicons dashicons-align-left"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://wordpress.org/support/theme/short/reviews/#new-post');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Your Feedback', 'short' ); ?></a></li>
									
									<li class=""><span class="dashicons dashicons-align-left"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://docs.themeansar.com/docs/short-pro/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Documentation', 'short' ); ?></a></li>


									<li class=""><span class="dashicons dashicons-groups"></span><a class="ast-quick-setting-title" href="<?php echo esc_url('https://themeansar.com/help/');?>" target="_blank" rel="noopener"><?php esc_html_e( 'Premium Support', 'short' ); ?></a></li>
									</ul>
							</div>
											</div>
			</div>
		   
			<div class="postbox short-pro-link">
				<h2 class="short-pro-build"><span><a href="<?php echo esc_url('http://themeansar.com/themes/short-pro/');?>" target="_blank">
				<?php echo esc_html_e('Get More Options with Short Pro!','short'); ?></a></span>
					<?php do_action( 'short_addon_bulk_action' ); ?>
				</h2>
			</div>

			<?php
		}
        
		/**
		 * Update Admin Title.
		 *
		 * @since 1.0.19
		 *
		 * @param string $admin_title Admin Title.
		 * @param string $title Title.
		 * @return string
		 */
		static public function short_admin_title( $admin_title, $title ) {

			$screen = get_current_screen();
			if ( 'appearance_page_short' == $screen->id ) {

				$view_actions = self::get_view_actions();

				$current_slug = isset( $_GET['action'] ) ? esc_attr( $_GET['action'] ) : self::$current_slug;
				$active_tab   = str_replace( '_', '-', $current_slug );

				if ( 'general' != $active_tab && isset( $view_actions[ $active_tab ]['label'] ) ) {
					$admin_title = str_replace( $title, $view_actions[ $active_tab ]['label'], $admin_title );
				}
			}

			return $admin_title;
		}

        /**
		 * short Header Right Section Links
		 *
		 * @since 1.2.4
		 */
		static public function top_header_right_section(){

			$top_links = apply_filters(
				'short_header_top_links',
				array(
					'short-theme-info' => array(
						'title' => __( 'Easy to use, Fully Customizable, Unique options', 'short' ),
					),
				)
			);

			if ( ! empty( $top_links ) ) {
				?>
				<div class="consult-top-links">
					<ul>
						<?php
						foreach ( (array) $top_links as $key => $info ) {
							/* translators: %1$s: Top Link URL wrapper, %2$s: Top Link URL, %3$s: Top Link URL target attribute */
							printf(
								'<li><%1$s %2$s %3$s > %4$s </%1$s>',
								isset( $info['url'] ) ? 'a' : 'span',
								isset( $info['url'] ) ? 'href="' . esc_url( $info['url'] ) . '"' : '',
								isset( $info['url'] ) ? 'target="_blank" rel="noopener"' : '',
								esc_html( $info['title'] )
							);
						}
						?>
						</ul>
					</div>
				<?php
			}
		}

	}
   new Short_Admin_Settings;

}