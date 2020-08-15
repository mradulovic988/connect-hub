<?php

/**
 * @link              https://mlab-studio.com
 * @since             1.0.0
 * @package           Connect_Hub
 *
 * @wordpress-plugin
 * Plugin Name:       Connect Hub
 * Plugin URI:        https://mlab-studio.com
 * Description:       Connect Hub is a powerful plugin that will manage your communication on many level with all of the users from the website. Registered and non-registered.
 * Version:           1.0.0
 * Author:            Marko Radulovic
 * Author URI:        https://mlab-studio.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       connect-hub
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CONNECT_HUB_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-connect-hub-activator.php
 */
function activate_connect_hub() 
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-hub-activator.php';
	Connect_Hub_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-connect-hub-deactivator.php
 */
function deactivate_connect_hub() 
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-connect-hub-deactivator.php';
	Connect_Hub_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_connect_hub' );
register_deactivation_hook( __FILE__, 'deactivate_connect_hub' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-connect-hub.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_connect_hub() 
{

	$plugin = new Connect_Hub();
	$plugin->run();

}
run_connect_hub();
