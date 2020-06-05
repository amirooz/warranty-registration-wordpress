<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/amirphp7
 * @since             1.0.0
 * @package           Proregistration
 *
 * @wordpress-plugin
 * Plugin Name:       Product Registrations
 * Plugin URI:        https://github.com/amirphp7/product_registrations
 * Description:       Product registrations plugin allows its customer to register their purchased products if the product needs any support. The manufacturer can tracked the products been purchased from authorized distributor or not.
 * Version:           1.0.0
 * Author:            MD. Amir Hossain
 * Author URI:        https://github.com/amirphp7
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       proregistration
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if( ! defined('CVM_SUPPORT_PLUGIN_DIR'))
{
	define('CVM_SUPPORT_PLUGIN_DIR', plugin_dir_path(__FILE__));
}

if( ! defined('CVM_SUPPORT_PLUGIN_URL'))
{
	define('CVM_SUPPORT_PLUGIN_URL', plugins_url().'/cvm-supports');
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PROREGISTRATION_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-proregistration-activator.php
 */
function activate_proregistration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-proregistration-tables.php';
	$tables = new Proregistration_Tables();

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-proregistration-activator.php';
	$activator = new Proregistration_Activator($tables);
	$activator->activate();
	// Proregistration_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-proregistration-deactivator.php
 */
function deactivate_proregistration() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-proregistration-tables.php';
	$tables = new Proregistration_Tables();

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-proregistration-deactivator.php';
	$deactivator = new Proregistration_Deactivator($tables);
	$deactivator->deactivate();
	// Proregistration_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_proregistration' );
register_deactivation_hook( __FILE__, 'deactivate_proregistration' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-proregistration.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_proregistration() {

	$plugin = new Proregistration();
	$plugin->run();

}
run_proregistration();
