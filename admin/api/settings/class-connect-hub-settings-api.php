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
		add_action( 'admin_menu', [ $this, 'add_admin_pages' ] );
		add_action( 'admin_init', [ $this, 'ch_register_settings_control_center' ] );
	}

	/**
	 * Adding admin page for the Connect Hub
	 */
	public function add_admin_pages() 
	{
		add_menu_page( 
			__( 'Connect Hub', 'connect-hub' ), 
			__( 'Connect Hub', 'connect-hub' ), 
			'manage_options', 
			'ch_connect_hub', 
			[ 
				$this, 'ch_control_center', 
			],
			$this->dashicon_icon(),
			65
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Control Center', 'connect-hub' ),
			__( 'Control Center', 'connect-hub' ),
			'manage_options',
			'ch_connect_hub',
			[
				$this, 'ch_control_center'
			]
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Messaging Center', 'connect-hub' ),
			__( 'Messaging Center', 'connect-hub' ),
			'manage_options',
			'ch_messaging_center',
			[
				$this, 'ch_messaging_center'
			]
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Negotiation Hub', 'connect-hub' ),
			__( 'Negotiation Hub', 'connect-hub' ),
			'manage_options',
			'ch_negotiation_hub',
			[
				$this, 'ch_negotiation_hub'
			]
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Header Banner', 'connect-hub' ),
			__( 'Header Banner', 'connect-hub' ),
			'manage_options',
			'ch_header_banner',
			[
				$this, 'ch_header_banner'
			]
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Documentation', 'connect-hub' ),
			__( 'Documentation', 'connect-hub' ),
			'manage_options',
			'ch_documentation',
			[
				$this, 'ch_documentation'
			]
		);

		add_submenu_page(
			'ch_connect_hub',
			__( 'Update to PRO', 'connect-hub' ),
			__( 'Update to PRO', 'connect-hub' ),
			'manage_options',
			'ch_update_to_pro',
			[
				$this, 'ch_update_to_pro'
			]
		);	
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
				do_settings_sections( 'ch_settings_section' );

				submit_button();
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
				settings_fields( '' );
				do_settings_sections( '' );

				submit_button();
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
		register_setting( 
			'ch_control_center_setting', 
			'ch_control_center_setting', 
			'ch_control_center_setting_sanitize' 
		);

		add_settings_section( 
			'ch_control_center', 
			__( 'Turn on/off', 'connect-hub'), 
			[
				$this, 'ch_settings_section_desc'
			], 
			'ch_settings_section' 
		);

		add_settings_field( 
			'ch_control_center_setting_checkbox', 
			__( 'Messaging Center', 'connect-hub' ), 
			[ 
				$this, 'ch_control_center_setting_checkbox' 
			], 
			'ch_settings_section', 
			'ch_control_center' 
		);
	}

	/**
	 * Description from the setting api for the 
	 * Control Center admin page
	 */
	public function ch_settings_section_desc()
	{
		echo __( 'You can control every section of the plugin by check it or uncheck it.', 'connect-hub' );
	}

	/**
	 * Input field related to the Control Center
	 */
	public function ch_control_center_setting_checkbox()
	{
		$options = get_option( 'ch_control_center_setting' );

		$is_option_set = isset($options['checkbox']) ? checked( 1, $options['checkbox'], false ) : NULL;
		
		echo '<input type="checkbox" id="checkbox_example" name="ch_control_center_setting[checkbox]" value="1"' . $is_option_set . '/>';
		echo '<label for="checkbox_example">' . __( 'Check this if you want to enable it.', 'connect-hub' ) . '</label>';
	}
	

}