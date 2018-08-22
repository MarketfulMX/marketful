<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.marketful.mx
 * @since             1.0.0
 * @package           mkf
 *
 * @wordpress-plugin
 * Plugin Name:       Marketful
 * Plugin URI:        http://www.marketful.mx
 * Description:       Conecta tu tienda de WooCommerce con Mercado Libre y manten actualizada tu información desde Marketful.
 * Version:           1.0.0
 * Author:            MarketFul
 * Author URI:        http://www.marketful.mx/
 * License:           GPL2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mkf
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) || !defined('ABSPATH')) {
  die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_GVERSION', '1.0.0' );
define( 'PLUGIN_GNAME', 'MarketFul' );
define( 'PLUGIN_GSNAME' , 'mkf');


/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mkf-activator.php
 */
function pgl_activate() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-dbcore.php';
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
  MKF_Activator::GetInstance()->activate();
}
/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-protected-content-for-pms-deactivator.php
 */
function plg_deactivate() {
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-dbcore.php';
  require_once plugin_dir_path( __FILE__ ) . 'includes/class-activator.php';
  MKF_Activator::GetInstance()->deactivate();
}

register_activation_hook(   __FILE__, 'pgl_activate'   );
register_deactivation_hook( __FILE__, 'plg_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-core.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function mkf_run_core() {

  $plugin = new MKF_Core();
  $plugin->run();

}
//
mkf_run_core();
add_action( 'wp_ajax_foobar', ['MKF_ProductEntry', 'my_theme_ajax_submit']);

// Descripcion //
add_action('wp_ajax_desc_comun_ajax', ['MKF_ProductEntry', 'desc_comun_ajax']);