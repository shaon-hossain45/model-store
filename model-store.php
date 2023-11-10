<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://github.com/shaon-hossain45/
 * @since             1.0.0
 * @package           Model_Store
 *
 * @wordpress-plugin
 * Plugin Name:       Model Store
 * Plugin URI:        https://https://github.com/shaon-hossain45/model-store
 * Description:       The best WordPress plugin that helps you upload and download anything. Beautifully.
 * Version:           1.0.0
 * Author:            Shaon Hossain
 * Author URI:        https://https://github.com/shaon-hossain45//
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       model-store
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
defined( 'ABSPATH' ) || exit;
defined( 'WPINC' ) || die;

// if ( ! defined( 'WPINC' ) ) {
// 	die;
// }

if ( ! defined( 'MS_PLUGIN_FILE' ) ) {
	define( 'MS_PLUGIN_FILE', __FILE__ );
}

if ( ! defined( 'MS_PLUGIN_DIR' ) ) {
	define( 'MS_PLUGIN_DIR', __DIR__ );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MODEL_STORE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-model-store-activator.php
 */
function activate_model_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/helper/class-ms-helper-activator.php';
	MS_Helper_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-model-store-deactivator.php
 */
function deactivate_model_store() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/helper/class-ms-helper-deactivator.php';
	MS_Helper_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_model_store' );
register_deactivation_hook( __FILE__, 'deactivate_model_store' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
if ( ! class_exists( 'Model_Store', false ) ) {
	require plugin_dir_path( __FILE__ ) . 'includes/class-model-store.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_model_store() {

	$plugin = new Model_Store();
	$plugin->run();
}
run_model_store();
