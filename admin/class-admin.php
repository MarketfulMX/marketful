<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @link       http://innodite.com
 * @since      1.0.0
 *
 * @package    plgcore
 * @subpackage plgcore/admin
 * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc
 * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
 */


class MKF_Admin {

  /**
   * The Name of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plg_name    The Name of this plugin.
   */
  private $plg_name;

  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plg_small_name    The ID of this plugin.
   */
  private $plg_small_name;

  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;


  private $dashboard_menu_name;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plg_small_name       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plg_small_name = PLUGIN_GSNAME, $version = PLUGIN_GVERSION ) {

    $this->plg_small_name = $plg_small_name;
    $this->version        = $version;
    $this->plg_name       = defined( 'PLUGIN_GNAME' )   ? PLUGIN_GNAME   : 'MarketFul';
    $this->dashboard_menu_name = $this->plg_small_name . "_dashboard";

  }

  /**
   * Register the stylesheets for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_styles() {

    wp_enqueue_style($this->plg_small_name, plugin_dir_url( __FILE__ ) . 'css/plg-admin.css', array(),$this->version,'all');
    wp_enqueue_style('datatables',"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css",array(),'1.10.18','all');
    wp_enqueue_style('category',plugin_dir_url( __FILE__ ) . 'css/category_selection.css',array(),'1.0.0','all');
    wp_enqueue_style('iconos',plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css',array(),'1.0.0','all');
    wp_enqueue_style('bootstrap-map',"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.css.map",array(),'4.1.0','all');
    
  }

  /**
   * Register the JavaScript for the admin area.
   *
   * @since    1.0.0
   */
  public function enqueue_scripts() {

    wp_enqueue_script('Popper',"https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js", array(), '1.14.3', false );
    wp_enqueue_script('bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js",array(),'4.1.0', false );
    wp_enqueue_script('datatables',"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js" , array(), '1.10.18', false );
    wp_enqueue_script('admin_js_bootstrap_hack', plugin_dir_url( __FILE__ ) . 'js/bootstrap-hack.js', false, '1.0.0', false);
    wp_enqueue_script($this->plg_small_name, plugin_dir_url( __FILE__ ) . 'js/plg-admin.js', array('jquery'), $this->version, false);

    wp_enqueue_script( 'ajax-script',
        plugins_url( '/js/myjquery.js', __FILE__ ),
        array('jquery')
    );
    $title_nonce = wp_create_nonce( 'title_example' );
    wp_localize_script( 'ajax-script', 'my_ajax_obj', array(
       // 'ajax_url' => admin_url( 'admin-ajax.php' ),
       'ajax_url' => admin_url( 'admin-ajax.php' ),
       'nonce'    => $title_nonce,
    ) );

  }

  public function plg_menu() {

    add_menu_page(
      __( $this->plg_small_name, 'textdomain' ),
      __( $this->plg_name, 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      $this->dashboard_menu_name,
      array( $this, 'dashboard' ),
      'dashicons-admin-settings'
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-entries", 'textdomain' ),
      __( 'Publicaciones', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-entries",
      array( $this, 'entries_view' )
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-orders", 'textdomain' ),
      __( 'Ordenes', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-orders",
      array( $this, 'dashboard' )
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-questions", 'textdomain' ),
      __( 'Preguntas', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-questions",
      array( $this, 'dashboard' )
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-messages", 'textdomain' ),
      __( 'Mensajería Postventa', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-messages",
      array( $this, 'dashboard' )
    );

    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-product-edit", 'textdomain' ),
      __( 'Publicación', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-edit",
      array( $this, 'entries_edit' )
    );

  }

  public function available_menu_to_editor_or_admin() {
    if (is_user_logged_in()){
      $is_editor = false;
      $user      = wp_get_current_user();

      foreach ($user->roles as $key => $role) {
        
        switch ($role) {
          case 'administrator': return "manage_options";
          case 'editor': $is_editor = true; 
             break;
          default: break;
        }
      }

      if ($is_editor) { return "editor"; }
      
    }
    return "manage_options";  
  }

  public function dashboard() {
    include_once "partials/admin-dashboard.php";
  }

  public function entries_view() {
    include_once "partials/admin-product-entries.php";
  }

  public function entries_edit() {
    include_once "partials/admin-product-edit-form.php";
  }

}
