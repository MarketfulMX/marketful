<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://innodite.com
 * @since      1.0.0
 *
 * @package    mkf
 * @subpackage mkf/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    mkf
 * @subpackage mkf/admin
 * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc.
 * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
 */
class MKF_ProductProxy extends MKF_DBCore {

  private static $instance = NULL;
  /**
   * The ID of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $plg_id    The ID of this plugin.
   */
  private $plg_id;
  /**
   * The version of this plugin.
   *
   * @since    1.0.0
   * @access   private
   * @var      string    $version    The current version of this plugin.
   */
  private $version;

  private $woocommerce;
  private $customer_key;
  private $secret_key;
  private $wc_api_v1;
  private $wc_api_v2;
  private $wc_api_v3;

  /**
   * Initialize the class and set its properties.
   *
   * @since    1.0.0
   * @param      string    $plg_id       The name of this plugin.
   * @param      string    $version    The version of this plugin.
   */
  public function __construct( $plg_id = PLUGIN_GSNAME, $version = PLUGIN_GVERSION) {

    require_once plugin_dir_path( __FILE__ ) . "extras/vendor/autoload.php";

    $this->plg_id  = $plg_id;
    $this->version = $version;
    $this->customer_key = '';
    $this->secret_key = '';
    $this->wc_api_v2 = 'wp-json/wc/v2';
    $this->wc_api_v3 = 'wc-api/v3';
    
    $this->woocommerce = new GuzzleHttp\Client([
      'base_uri' => esc_url(home_url()),
      'verify'   => true
    ]);
    
  }

  public static function GetInstance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self;
    }
    return self::$instance;
  }

  public function getWC()
  {
    return $this->woocommerce;
  }

  public function products_get_request($product_id = null)
  {
    $url_path = (empty($product_id) || is_null($product_id)) ? "" : "/{$product_id}";

    return $this->getWC()->request(
      'GET', 
      "fullmarket/{$this->wc_api_v2}/products{$url_path}", 
      [
        'auth' => [ $this->customer_key, $this->secret_key]
      ]
    );
  }

  public function products_put_request($product_id = null, $metadata = [])
  {
    $url_path = (empty($product_id) || is_null($product_id)) ? "" : "/{$product_id}";

    return $this->getWC()->request(
      'PUT', 
      "fullmarket/{$this->wc_api_v2}/products{$url_path}", 
      [
        'auth' => [ $this->customer_key, $this->secret_key],
        'json' => ['product' => $metadata]
      ]
    );
  }

  public function products_get_body($product_id = null, $force_to_array = true)
  {

    $body = $this->products_get_request($product_id)->getBody();
    
    return $force_to_array ? json_decode($body, true) : $body;
  }
}