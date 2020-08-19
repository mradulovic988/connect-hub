<?php
/**
 * Settings API
 *
 * @link       https://mlab-studio.com
 * @since      1.0.0
 *
 * @package    Connect_Hub
 * @subpackage Connect_Hub/includes/Api/Settings
 */

/**
 * Settings API
 *
 * This class defines all code necessary for the Settings API
 *
 * @since      1.0.0
 * @package    Connect_Hub
 * @subpackage Connect_Hub/includes
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */

class Connect_Hub_Settings_Api 
{
	
	public function __construct()
	{
		// Adding admin pages
		add_action( 'admin_menu', [ $this, 'add_admin_pages' ] );

		// Adding register setting for control center
		add_action( 'admin_init', [ $this, 'ch_register_settings_control_center' ] );

		// Adding register setting for header banner
		add_action( 'admin_init', [ $this, 'ch_register_settings_header_banner' ] );

		// Adding get_fields method to show on front end every result from settings API - DELETE LATER
		add_action( 'wp_head', [ $this, 'get_fields' ] );

		// Error notice for submiting results
		add_action( 'admin_notices', [ $this, 'error_notice' ] );
	}

	/**
	 * Adding admin page for the Connect Hub
	 */
	public function add_admin_pages() 
	{
		add_menu_page( __( 'Connect Hub', 'connect-hub' ), __( 'Connect Hub', 'connect-hub' ), 'manage_options', 'ch_connect_hub', [ $this, 'ch_control_center', ], $this->dashicon_icon(), 65 );
		add_submenu_page( 'ch_connect_hub', __( 'Control Center', 'connect-hub' ), __( 'Control Center', 'connect-hub' ), 'manage_options', 'ch_connect_hub', [ $this, 'ch_control_center' ] );
		add_submenu_page( 'ch_connect_hub', __( 'Messaging Center', 'connect-hub' ), __( 'Messaging Center', 'connect-hub' ), 'manage_options', 'ch_messaging_center', [ $this, 'ch_messaging_center' ] );
		add_submenu_page( 'ch_connect_hub', __( 'Negotiation Hub', 'connect-hub' ), __( 'Negotiation Hub', 'connect-hub' ), 'manage_options', 'ch_negotiation_hub', [ $this, 'ch_negotiation_hub' ] );
		add_submenu_page( 'ch_connect_hub', __( 'Header Banner', 'connect-hub' ), __( 'Header Banner', 'connect-hub' ), 'manage_options', 'ch_header_banner', [ $this, 'ch_header_banner' ] );
		add_submenu_page( 'ch_connect_hub', __( 'Documentation', 'connect-hub' ), __( 'Documentation', 'connect-hub' ), 'manage_options', 'ch_documentation', [ $this, 'ch_documentation' ] );
		add_submenu_page( 'ch_connect_hub', __( 'Update to PRO', 'connect-hub' ), __( 'Update to PRO', 'connect-hub' ), 'manage_options', 'ch_update_to_pro', [ $this, 'ch_update_to_pro' ] );	
	}

	/**
	 * Show notice message on form submit
	 */
	public function error_notice()
	{
		settings_errors();
	}

	/**
	 * Dashicon icon
	 */
	protected function dashicon_icon()
	{
		return plugins_url( 'connect-hub' . '/admin/img/connect-hub-dashicon.png' );
	}

	/**
	 * Passing the header links
	 * 
	 * @param string $active_tab Declare activate tab
	 * @param string $is_active Declare activate tab attribute
	 * @param string $is_next Declare next activate tab
	 */
	protected function is_active( $active_tab, $is_active, $is_next )
	{
		?>
		<h2 class="nav-tab-wrapper">
			<a href="?page=ch_connect_hub" class="nav-tab <?php if($active_tab == 'ch_connect_hub'){echo 'nav-tab-active';} ?> "><?php _e('Control Center', 'connect-hub'); ?></a>
			<a href="?page=ch_messaging_center" class="nav-tab <?php if($active_tab == 'ch_messaging_center'){echo 'nav-tab-active';} ?>"><?php _e('Messaging Center', 'connect-hub'); ?></a>
			<a href="?page=ch_negotiation_hub" class="nav-tab <?php if($active_tab == 'ch_negotiation_hub'){echo 'nav-tab-active';} ?>"><?php _e('Negotiation Hub', 'connect-hub'); ?></a>
			<a href="?page=ch_header_banner" class="nav-tab <?php if($active_tab == 'ch_header_banner'){echo 'nav-tab-active';} ?>"><?php _e('Header Banner', 'connect-hub'); ?></a>
			<a href="?page=ch_documentation" class="nav-tab <?php if($active_tab == 'ch_documentation'){echo 'nav-tab-active';} ?>"><?php _e('Documentation', 'connect-hub'); ?></a>
			<a href="?page=ch_update_to_pro" class="nav-tab <?php if($active_tab == 'ch_update_to_pro'){echo 'nav-tab-active';} ?>"><?php _e('Update to PRO', 'connect-hub'); ?></a>
		</h2>
		<?php

		$active_tab = $is_active;
			
		if( isset( $_GET[ "tab" ] ) ) {
			
			if( $_GET[ "tab" ] == $is_active ) {
				$active_tab = $is_active;
			} else {
				$active_tab = $is_next;
			}
		}
	}
	
	/**
	 * Control Center admin page
	 */
	public function ch_control_center()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_connect_hub', 'ch_connect_hub', 'ch_messaging_center' ); ?>

			<form action="options.php" method="post">

				<?php
				settings_fields( 'ch_control_center_setting' );
				do_settings_sections( 'ch_control_settings_section' );

				submit_button( __( 'Save Settings', 'connect-hub' ), 'primary', 'control_center_submit' );
				?>

			</form>

		</div>
		<?php
	}

	/**
	 * Messaging Center admin page
	 */
	public function ch_messaging_center()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
			<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_messaging_center', 'ch_messaging_center', 'ch_negotiation_hub' ); ?>

			<form action="options.php" method="post">
				<?php 
				settings_fields( '' );
				do_settings_sections( '' );

				submit_button();
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Negotiation Hub admin page
	 */
	public function ch_negotiation_hub()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_negotiation_hub', 'ch_negotiation_hub', 'ch_header_banner' ); ?>

			<form action="options.php" method="post">
				<?php 
				settings_fields( '' );
				do_settings_sections( '' );

				submit_button();
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Header Banner admin page
	 */
	public function ch_header_banner()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_header_banner', 'ch_header_banner', 'ch_documentation' ); ?>

			<form action="options.php" method="post">
				<?php 
				settings_fields( 'ch_header_banner' );
				do_settings_sections( 'ch_header_banner_settings_section' );

				submit_button( __( 'Save Settings', 'connect-hub' ), 'primary', 'header_banner_submit' );
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Documentation admin page
	 */
	public function ch_documentation()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_documentation', 'ch_documentation', 'ch_update_to_pro' ); ?>

			<form action="options.php" method="post">
				<?php 
				settings_fields( '' );
				do_settings_sections( '' );

				submit_button();
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Update to Pro admin page
	 */
	public function ch_update_to_pro()
	{
		?>
		<div class="wrap">
            <div id="icon-options-general" class="icon32"></div>
            <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>

			<?php $this->is_active( 'ch_update_to_pro', 'ch_update_to_pro', '' ); ?>

			<form action="options.php" method="post">
				<?php 
				settings_fields( '' );
				do_settings_sections( '' );

				submit_button();
				?>
			</form>

		</div>
		<?php
	}

	/**
	 * Register setting for the Control Center admin page
	 */
	public function ch_register_settings_control_center()
	{
		register_setting( 'ch_control_center_setting', 'ch_control_center_setting', 'ch_control_center_setting_sanitize' );

		add_settings_section( 'ch_control_center', __( 'Turn On / Off', 'connect-hub'), [ $this, 'ch_settings_section_desc' ],'ch_control_settings_section' );

		add_settings_field( 'ch_control_center_setting_messaging', __( 'Messaging Center', 'connect-hub' ), [ $this, 'ch_control_center_setting_messaging' ], 'ch_control_settings_section', 'ch_control_center');
		add_settings_field( 'ch_control_center_setting_negotiation', __( 'Negotiation Hub', 'connect-hub' ), [ $this, 'ch_control_center_setting_negotiation' ], 'ch_control_settings_section', 'ch_control_center' );
		add_settings_field( 'ch_control_center_setting_banner', __( 'Header Banner', 'connect-hub' ), [ $this, 'ch_control_center_setting_banner' ], 'ch_control_settings_section', 'ch_control_center' );
	}

	public function ch_register_settings_header_banner()
	{
		register_setting( 'ch_header_banner', 'ch_header_banner', 'ch_header_banner_sanitize' );

		add_settings_section( 'ch_header_banner', __( 'Create your Banner', 'connect-hub'), [ $this, 'ch_settings_section_header_banner_desc'], 'ch_header_banner_settings_section' );

		add_settings_field( 'ch_header_banner_textarea', __( 'Enter the text for the banner', 'connect-hub' ), [ $this, 'ch_header_banner_textarea' ], 'ch_header_banner_settings_section', 'ch_header_banner' );
		add_settings_field( 'ch_header_banner_font_size', __( 'Font size (px):', 'connect-hub' ), [ $this, 'ch_header_banner_font_size' ], 'ch_header_banner_settings_section', 'ch_header_banner' );
		add_settings_field( 'ch_header_banner_font_color', __( 'Font color:', 'connect-hub' ), [ $this, 'ch_header_banner_font_color' ], 'ch_header_banner_settings_section', 'ch_header_banner' );
		add_settings_field( 'ch_header_banner_background_color', __( 'Background color:', 'connect-hub' ), [ $this, 'ch_header_banner_background_color' ], 'ch_header_banner_settings_section', 'ch_header_banner' );
		add_settings_field( 'ch_header_banner_link_color', __( 'Link color:', 'connect-hub' ), [ $this, 'ch_header_banner_link_color' ], 'ch_header_banner_settings_section', 'ch_header_banner' );
		add_settings_field( 'ch_header_banner_custom_css', __( 'Custom CSS:', 'connect-hub' ), [ $this, 'ch_header_banner_custom_css' ], 'ch_header_banner_settings_section', 'ch_header_banner' );

	}

	public function ch_header_banner_custom_css()
	{
		$options = get_option( 'ch_header_banner' );
		$is_option_set = isset( $options[ 'custom_css' ] ) ? $options[ 'custom_css' ] : NULL;

		echo '<textarea id="custom_css" name="ch_header_banner[custom_css]" rows="4" cols="100">' . $is_option_set . '</textarea>';
	}

	public function ch_header_banner_link_color()
	{
		
		$options = get_option( 'ch_header_banner' );

		$is_option_set = isset( $options[ 'link_color' ] ) ? $options[ 'link_color' ] : '#fff';

		echo '<input type="color" id="linkcolor" name="ch_header_banner[link_color]" value="' . $is_option_set . '">';
		echo '<label id="linkcolor"><label>';
	}

	public function ch_header_banner_background_color()
	{
		
		$options = get_option( 'ch_header_banner' );

		$is_option_set = isset( $options[ 'background_color' ] ) ? $options[ 'background_color' ] : '#fff';

		echo '<input type="color" id="backgroundcolor" name="ch_header_banner[background_color]" value="' . $is_option_set . '">';
		echo '<label id="backgroundcolor"><label>';
	}

	public function ch_header_banner_font_color()
	{
		
		$options = get_option( 'ch_header_banner' );

		$is_option_set = isset( $options[ 'font_color' ] ) ? $options[ 'font_color' ] : '#fff';

		echo '<input type="color" id="fontcolor" name="ch_header_banner[font_color]" value="' . $is_option_set . '">';
		echo '<label id="fontcolor"><label>';
	}

	public function ch_header_banner_textarea()
	{
		$options = get_option( 'ch_header_banner' );
		$is_option_set = isset( $options[ 'textarea' ] ) ? $options[ 'textarea' ] : NULL;

		echo '<textarea id="textarea" name="ch_header_banner[textarea]" placeholder="Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups." rows="4" cols="100">' . $is_option_set . '</textarea>';
	}

	public function ch_header_banner_font_size()
	{
		$options = get_option( 'ch_header_banner' );

		echo '<input type="number" id="fontsize" name="ch_header_banner[font_size]" value="' . esc_attr( $options[ 'font_size' ] ) . '">';
		echo '<label id="fontsize"><label>';
	}

	/**
	 * Description from the setting api for the 
	 * Control Center admin page
	 */
	public function ch_settings_section_desc()
	{
		echo __( 'You can control every section of the plugin by check it or uncheck it.', 'connect-hub' );
	}

	public function ch_settings_section_header_banner_desc()
	{
		echo __( 'Please, make sure that you checked the Header Banner on the Control Center page.', 'connect-hub' );
	}

	/**
	 * Input field related to the Control Center
	 * for the Messaging Center
	 */
	public function ch_control_center_setting_messaging()
	{
		$options = get_option( 'ch_control_center_setting' );

		$is_option_set = isset( $options[ 'messaging' ] ) ? checked( 1, $options[ 'messaging' ], false ) : NULL;

		echo '<label class="switch" for="messaging">';
		echo '<input type="checkbox" class="switch-input" id="messaging" name="ch_control_center_setting[messaging]" value="1"' . $is_option_set . '/>';
		echo '<span class="slider round"></span>';
		echo '</label>';
	}

	/**
	 * Input field related to the Control Center
	 * for the Negotiation Hub
	 */
	public function ch_control_center_setting_negotiation()
	{
		$options = get_option( 'ch_control_center_setting' );

		$is_option_set = isset( $options[ 'negotiation' ] ) ? checked( 1, $options[ 'negotiation' ], false ) : NULL;

		echo '<label class="switch" for="negotiation">';
		echo '<input type="checkbox" class="switch-input" id="negotiation" name="ch_control_center_setting[negotiation]" value="1"' . $is_option_set . '/>';
		echo '<span class="slider round"></span>';
		echo '</label>';
	}

	/**
	 * Input field related to the Control Center
	 * for the Header Banner
	 */
	public function ch_control_center_setting_banner()
	{
		$options = get_option( 'ch_control_center_setting' );

		$is_option_set = isset( $options[ 'banner' ] ) ? checked( 1, $options[ 'banner' ], false ) : NULL;
		
		echo '<label class="switch" for="banner">';
		echo '<input type="checkbox" class="switch-input" id="banner" name="ch_control_center_setting[banner]" value="1"' . $is_option_set . '/>';
		echo '<span class="slider round"></span>';
		echo '</label>';
	}
	
	public function get_fields()
	{
		$options = get_option( 'ch_control_center_setting' );
		$banner = get_option( 'ch_header_banner' );

		if ( isset( $options[ 'messaging' ] ) ) {
			echo 'Messaging Center is set on ' . $options[ 'messaging' ] . '<br>';
		}

		if ( isset( $options[ 'negotiation' ] ) ) {
			echo 'Negotiation Hub is set on ' . $options[ 'negotiation' ] . '<br>';
		} 

		if ( isset( $options[ 'banner' ] ) ) {
			echo 'Header Banner is set on ' . $options[ 'banner' ] . '<br>';
		}

		if ( isset( $banner[ 'textarea' ] ) ) {
			echo $banner[ 'textarea' ] . '<br>';
		}

		if ( isset( $banner[ 'font_color' ] ) ) {
			echo $banner[ 'font_color' ] . '<br>';
		}
	}
}