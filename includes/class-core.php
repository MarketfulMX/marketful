<?php
if ( !class_exists( 'MKF_Core', false ) ):
/**
 * The core plugin class.
 *
 * The file that defines the core plugin class
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @link       http://innodite.com
 * @since      1.0.0
 *
 * @package    mkf
 * @subpackage mkf/includes
 * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc
 * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
 */


class MKF_Core {

  /**
   * The loader that's responsible for maintaining and registering all hooks that power
   * the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      plgcore_Loader    $loader    Maintains and registers all hooks for the plugin.
   */
  protected $loader;

  /**
   * The unique identifier of this plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $plugin_id    The string used to uniquely identify this plugin.
   */
  protected $plugin_id;

  /**
   * The current version of the plugin.
   *
   * @since    1.0.0
   * @access   protected
   * @var      string    $version    The current version of the plugin.
   */
  protected $version;

  protected $plugin_root;

  /**
   * Define the core functionality of the plugin.
   *
   * Set the plugin name and the plugin version that can be used throughout the plugin.
   * Load the dependencies, define the locale, and set the hooks for the admin area and
   * the public-facing side of the site.
   *
   * @since    1.0.0
   */
  public function __construct() {
    $this->version    = defined( 'PLUGIN_GVERSION' ) ? PLUGIN_GVERSION : '1.0.0';
    $this->plugin_id  = defined( 'PLUGIN_GSNAME' )   ? PLUGIN_GSNAME   : 'mkf';

    $this->set_root_path();
    $this->load_dependencies();
    $this->set_locale();
    $this->define_admin_hooks();
    $this->define_public_hooks();

  }

  public function set_root_path() {
    $this->plugin_root = plugin_dir_path( dirname( __FILE__ ) );
  }

  /**
   * Load the required dependencies for this plugin.
   *
   * Include the following files that make up the plugin:
   *
   * - Loader. Orchestrates the hooks of the plugin.
   * - i18n. Defines internationalization functionality.
   * - Admin. Defines all hooks for the admin area.
   * - Public. Defines all hooks for the public side of the site.
   *
   * Create an instance of the loader which will be used to register the hooks
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  private function load_dependencies() {

    require_once $this->plugin_root . 'includes/class-loader.php';
    require_once $this->plugin_root . 'includes/class-i18n.php';
    require_once $this->plugin_root . 'includes/class-dbcore.php';
    require_once $this->plugin_root . 'admin/class-admin.php';
    require_once $this->plugin_root . 'admin/class-admin-product-entries.php';
    require_once $this->plugin_root . 'admin/class-admin-wc-proxy.php';

    $this->loader = new MKF_Loader();

  }

  /**
   * Define the locale for this plugin for internationalization.
   *
   * Uses the i18n class in order to set the domain and to register the hook
   * with WordPress.
   *
   * @since    1.0.0
   * @access   private
   */
  
  private function set_locale() {

    $i18n = new MKF_i18n();

    $this->loader->add_action( 'plugins_loaded', $i18n, 'load_plugin_textdomain' );

  }
  
  /**
   * Register all of the hooks related to the admin area functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_admin_hooks() {

    $plugin_admin = new MKF_Admin( $this->get_plugin_small_name(), $this->get_version() );
    $product_entry = new MKF_ProductEntry( $this->get_plugin_small_name(), $this->get_version() );

    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
    $this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
    $this->loader->add_action( 'admin_menu',            $plugin_admin, 'plg_menu' );

    // CRUD ProductEntries (Definir la accion para procesar un formulario html con method POST)
    $this->loader->add_action( 
      'admin_post_add_metadata_to_product_entry', 
      $product_entry, 
      'prefix_admin_add_metadata_to_product_entry' 
    );

  }

  /**
   * Register all of the hooks related to the public-facing functionality
   * of the plugin.
   *
   * @since    1.0.0
   * @access   private
   */
  private function define_public_hooks() {

  }

  /**
   * Run the loader to execute all of the hooks with WordPress.
   *
   * @since    1.0.0
   */
  public function run() {
    $this->loader->run();
  }

  /**
   * The name of the plugin used to uniquely identify it within the context of
   * WordPress and to define internationalization functionality.
   *
   * @since     1.0.0
   * @return    string    The name of the plugin.
   */
  public function get_plugin_small_name() {
    return $this->plugin_id;
  }

  /**
   * The reference to the class that orchestrates the hooks with the plugin.
   *
   * @since     1.0.0
   * @return    mkf_Loader    Orchestrates the hooks of the plugin.
   */
  public function get_loader() {
    return $this->loader;
  }

  /**
   * Retrieve the version number of the plugin.
   *
   * @since     1.0.0
   * @return    string    The version number of the plugin.
   */
  public function get_version() {
    return $this->version;
  }

}

endif;