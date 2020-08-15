<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://mlab-studio.com
 * @since      1.0.0
 *
 * @package    Connect_Hub
 * @subpackage Connect_Hub/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Connect_Hub
 * @subpackage Connect_Hub/includes
 * @author     Marko Radulovic <mradulovic988@gmail.com>
 */
class Connect_Hub_i18n 
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() 
	{

		load_plugin_textdomain(
			'connect-hub',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
