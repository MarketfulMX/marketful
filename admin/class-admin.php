<?php

/**
 * Archivo: admin-product-edit-form.php
 * Ultima edición : 7 de agosto de 2018
 *
 * @autor: Adolfo Yanes <adolfo@marketful.mx>
 * @autor: Mauricio Alcala <mauricio@marketful.mx> as proyect admin
 * * @author: Javier Urbano <javierurbano11@gmail.com> as contributor
 * * @author: Angel Salazar <salazar.angel.e@gmail.com> as contributor
 *
 * @versión: 
 * @link: marketful.mx
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 */

/**
 * Descripción General: 
 * Archivo PHP que tiene la función de hacer la primera llamada a los diferentes elementos 
 * que se encuentran dentro de si.
 */

/**
 * @clase PHP MKF_admin
 * @Atributos:
 * private $plg_name (Nombre del plugin)
 * private $plg_small_name (Nombre corto)
 * private $version (version)
 * private $dashboard_menu_name ( Nombre a mostrar en el dashboard)
 * 
 * @Métodos
 
 *
 
 *
 
 *

 * 
 * @función plg_menu(), encargada de indicar que es lo que se realiza 
 *
 *
 *
 *
 */
class MKF_Admin 
{

  private $plg_name;
  private $plg_small_name;
  private $version;
  private $dashboard_menu_name;
  /**
   * La @función @publica __construct(@string,@string) Inicializala clase y le asigna sus propiedades
   */
  public function __construct( $plg_small_name = PLUGIN_GSNAME, $version = PLUGIN_GVERSION ) 
  {

    $this->plg_small_name = $plg_small_name;
    $this->version        = $version;
    $this->plg_name       = defined( 'PLUGIN_GNAME' )   ? PLUGIN_GNAME   : 'MarketFul';
    $this->dashboard_menu_name = $this->plg_small_name . "_dashboard";

  }
  /**
   * La @función @publica enqueve_styles() sobre escribe el estilo tomado de wp en caso de que no se 
   * haya modificado. 
   */
  //Register the stylesheets for the admin area. Since 1.0.0
  public function enqueue_styles() 
  {

    wp_enqueue_style($this->plg_small_name, plugin_dir_url( __FILE__ ) . 'css/plg-admin.css', array(),$this->version,'all');
    wp_enqueue_style('datatables',"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css",array(),'1.10.18','all');
    wp_enqueue_style('category',plugin_dir_url( __FILE__ ) . 'css/category_selection.css',array(),'1.0.0','all');
    wp_enqueue_style('iconos',plugin_dir_url( __FILE__ ) . 'css/font-awesome.min.css',array(),'1.0.0','all');
    wp_enqueue_style('bootstrap-map',"https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.0/css/bootstrap.css.map",array(),'4.1.0','all');
    
  }
  /**
   * La @función @publica enqueve_styles() sobre escribe los 
   * @Scripts de JavaScript en caso de que no hayan sido modificados, logra que los datos estén disponibles 
   * para su secuencia de comandos que normalmente solo puede obtener del lado del servidor de WordPress.
   */
  //Register the JavaScript for the admin area. Since 1.0.0 
  public function enqueue_scripts() 
  {
    wp_enqueue_script('Popper',"https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js", array(), '1.14.3', false );wp_enqueue_script('bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js",array(),'4.1.0', false );
    wp_enqueue_script('datatables',"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js" , array(), '1.10.18', false );
    wp_enqueue_script('admin_js_bootstrap_hack', plugin_dir_url( __FILE__ ) . 'js/bootstrap-hack.js', false, '1.0.0', false);
    wp_enqueue_script($this->plg_small_name, plugin_dir_url( __FILE__ ) . 'js/plg-admin.js', array('jquery'), $this->version, false);
    wp_enqueue_script( 'ajax-script',
        plugins_url( '/js/myjquery.js', __FILE__ ),
        array('jquery')
    );
    /**
     * El @Script que a continuación se utiliza la @función wp_create_nonce(@string) que genera un hash con 
     * esa informacion para despues ser utilizada para validar la información que se envia.
     */
    $title_nonce = wp_create_nonce( 'title_example' );
    wp_localize_script( 'ajax-script', 'my_ajax_obj', array(
       // 'ajax_url' => admin_url( 'admin-ajax.php' ),
       'ajax_url' => admin_url( 'admin-ajax.php' ),
       'nonce'    => $title_nonce,
    ) );
  }
    
  //Add items to menú panel
  public function plg_menu() 
  {
    add_menu_page(
      __( $this->plg_small_name, 'textdomain' ),
      __( $this->plg_name, 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      $this->dashboard_menu_name,
      array( $this, 'dashboard' ),
      'dashicons-hammer'
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
