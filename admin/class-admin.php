<?php

/**
 * Archivo: class-admin.php
 * Ultima edición : 7 de agosto de 2018
 *
 * @autor: Adolfo Yanes <adolfo@marketful.mx> as master contributor
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
 * @función plg_menu(), encargada de indicar que es lo que se realiza 
 *
 *
 *
 *
 */

/*** Borrar */
error_reporting(E_ERROR | E_WARNING | E_PARSE); // Suprime errores de prueba
/**/

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
    wp_enqueue_style('ape_style',plugin_dir_url( __FILE__ ) . 'css/admin-product-entries.css',array(),'1.0.0','all');
    
  }
  /**
   * La @función @publica enqueve_styles() sobre escribe los 
   * @Scripts de JavaScript en caso de que no hayan sido modificados, logra que los datos estén disponibles 
   * para su secuencia de comandos que normalmente solo puede obtener del lado del servidor de WordPress.
   */
  //Register the JavaScript for the admin area. Since 1.0.0 
  public function enqueue_scripts() 
  {
    //aqui va el if+
    // if(is_page(array('mkf-product-entries', 'mkf-entries_categorizador', 'mkf_dashboard', 'mkf-product-orders', 'mkf-product-questions', 'mkf-product-messages'))){
    //El IF valida los casos en los cuales permite utilizar los archivos de JS 
    if($_GET['page'] == 'mkf-product-entries' || $_GET['page'] == 'mkf-descripcion-footer' || $_GET['page'] == 'mkf-product-orders'){  
      wp_enqueue_script('Popper',"https://unpkg.com/popper.js@1.14.3/dist/umd/popper.min.js", array(), '1.14.3', false );wp_enqueue_script('bootstrap',"https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js",array(),'4.1.0', false );
      wp_enqueue_script('datatables',"https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js" , array(), '1.10.18', false );
      wp_enqueue_script('admin_js_bootstrap_hack', plugin_dir_url( __FILE__ ) . 'js/bootstrap-hack.js', false, '1.0.0', false);
      wp_enqueue_script('ape_func', plugin_dir_url( __FILE__ ) . 'js/admin-product-entries.js', false, '1.0.1', false);
      wp_enqueue_script($this->plg_small_name, plugin_dir_url( __FILE__ ) . 'js/plg-admin.js', array('jquery'), $this->version, false);
      wp_enqueue_script('footer_js', plugin_dir_url( __FILE__ ) . 'js/myjquery.js', false, '1.0.1', false);
      /**
       * El @Script que a continuación se utiliza la @función wp_create_nonce(@string) que genera un hash con 
       * esa informacion para despues ser utilizada para validar la información que se envia.
       */   
    }else{
      error_log("no consiguio la pagina");
    }
     
  }
    
  /**
   * @Función PHP
   * La @función plg_menu() muestra la sección del plugin que corresponda, agregando una pagina al menu
   * y posteriormente manda a llamar al metodo que muestra dichas secciónes.
   * Nos muestra *Dashboard, *Publicaciones, *Ordenes, *Preguntas, *Mensajeria postventa y publicacion.
   * 
   */
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
      array( $this, 'admin_orders' )
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-questions", 'textdomain' ),
      __( 'Preguntas', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-questions",
      array( $this, 'admin_preguntas' )
    );

    add_submenu_page(
      $this->dashboard_menu_name,
      __( "{$this->plg_small_name}-product-messages", 'textdomain' ),
      __( 'Mensajeria Postventa', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-messages",
      array( $this, 'admin_mensajeria' )
    );

    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-product-edit", 'textdomain' ),
      __( 'Publicación', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-product-edit",
      array( $this, 'entries_edit' )
    );
      
    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-entries_categorizador", 'textdomain' ),
      __( 'Categorizador', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-entries_categorizador",
      array( $this, 'entries_categorizador' )
    );

    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-descripcion_footer", 'textdomain' ),
      __( 'Descripcion Común', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-descripcion-footer",
      array( $this, 'descripcion_footer' )
    );

    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-error-list", 'textdomain' ),
      __( 'Lista de Errores', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-error-list",
      array( $this, 'error_list' )
    );
    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-error-list-detail", 'textdomain' ),
      __( 'Lista de Errores Detalles', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-error-list-detail",
      array( $this, 'error_list_detail' )
    );
    add_submenu_page(
      NULL,
      __( "{$this->plg_small_name}-onboarding", 'textdomain' ),
      __( 'OnBoarding', 'textdomain' ),
      $this->available_menu_to_editor_or_admin(),
      "{$this->plg_small_name}-onboarding",
      array( $this, 'OnBoarding' )
    );

  }

  /**
   * @Función PHP
   * aviable_menu_to_editor_or_admin() 
   * Primero se verifica si es una sesion registrada con is_user_logged_in() 
   * Se define al variable $is_editor y se le asigna el valor falso
   * Despues en la variable $user se guarda el valor del objeto usuario que devuelve wp_get_current_user() 
   * Se crea un foreach para recorrer todos los valores (roles) dentro del objeto $user
   * Definimos un switch para ver si es administrador o editor. En caso de ser editor se retorna la leyenda 'editor' en caso contrario se retorna 'manage:options'
   * 
   */
  public function available_menu_to_editor_or_admin() 
  {
    if (is_user_logged_in())
    {
      $is_editor = false;
      $user      = wp_get_current_user();

      foreach ($user->roles as $key => $role) 
      {
        
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

/**
 * @Función dashboard()
 * Método que manda a llamar el archivo admin-dashboard.php
 */
  public function dashboard() {
    include_once "partials/admin-dashboard.php";
  }
/**
 * @Función entries_view()
 * Método que manda a llamar el archivo admin-product-entries
 */
  public function entries_view() {
    include_once "partials/admin-product-entries.php";
  }
/**
 * @Función entries_edit()
 * Método que manda a llamar el archivo admin-product-edit-form.php
 */
  public function entries_edit() {
    include_once "partials/admin-product-edit-form.php";
  }
  /**
   * @Función entries_categorizador()
   * Método que manda a llamar el archivo admin-product-ecategorizador.php
   */
  public function entries_categorizador() {
    include_once "partials/admin-product-categorizador.php";
  }
  /**
   * @Función descripcion_footer()
   * Método de la clase admin que manda a llamar el archivo admin-descripcion.footer.php
   */
  public function descripcion_footer() {
    include_once "partials/admin-descripcion-footer.php";
  }
  /**
   * @Función error_list()
   * Método que manda a llamar el archivo admin-error-list.php
   */
  public function error_list() {
    include_once "partials/admin-error-list.php";
  }
  /**
   * @Función error_list_detail()
   * Método que manda a llamar el archivo admin-error-list-detail.php
   */
  public function error_list_detail() {
    include_once "partials/admin-error-list-detail.php";
  }
  /**
   * @Función onboarding()
   * Método que manda a llamar el archivo admin-onboarding.php
   */
  public function onboarding()
  {
    include_once "partials/admin-onboarding.php";
  }

  /**
   * @funcion admin_orders()
   * Método que manda a llamar el archivo admin-orders.php
   */
  public function admin_orders()
  {
    include_once "partials/admin-orders.php";
  }

  /**
   * @funcion admin_preguntas
   * Método de la clase admin que manda a llamar el archivo admin-preguntas.php
   */
  public function admin_preguntas()
  {
    include_once "partials/admin-preguntas.php";
  }

  /**
   * @funcion admin_mensajeria()
   * Método de la clase admin que manda a llamar el archivo admin-mensajeria.php
   */
  public function admin_mensajeria()
  {
    include_once "partials/admin-mensajeria.php";
  }
}
