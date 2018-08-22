<?php
if ( !class_exists( 'MKF_Activator', false ) ):
/**
 * Archivo: class-activator.php
 * Ultima edición : 13 de agosto de 2018
 *
 * @autor: Adolfo Yanes <adolfo@marketful.mx> as master contributor
 * @autor: Mauricio Alcala <mauricio@marketful.mx> as proyect admin
 * @author Javier Urbano <javierurbano11@gmail.com> as contributor
 * @author Angel Salazar <salazar.angel.e@gmail.com> as contributor
 *
 * @versión: 1.01
 * @link: marketful.mx
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 */

/**
 * Descripción general:
 * Instala o desisntala el activador dependiendo si esta activado o no.
 */


/**
 * @Clase MKF_Activator @hereda metodos y atributos de MKF_DBCore
 * 
 * @Atributo
 * Define $instance con valor NULL
 * 
 */
class MKF_Activator extends MKF_DBCore 
{

  protected static $instance = NULL;
  /**
   * @función getInstance()
   * Es una función estatica que accede al objeto $instance y busca que sea nulo, 
   * en cuyo caso creal el objeto.
   * En caso contrario retorna el objeto.
   */
  public static function GetInstance() 
  {
    if ( is_null( self::$instance ) ) 
    {
      self::$instance = new self;
    }
    return self::$instance;
  }
  /**
   * @función activate()
   * Se asigna el valor que retorna RunInstall()
   */
  public function activate() 
  {
    $this->RunInstall();
  }
  /**
   * @función desactivate()
   * Se asigna el valor que retorna RunUninstall()
   */
  public function deactivate() 
  {
    $this->RunUninstall();
  }
  /**
   * @función RunInstall()
   */
  private function RunInstall() 
  {
    /**
     * @script que crea un nuevo producto dentro de MKF
     */
      $producto = MKF_ProductEntry::GetInstance()->get_product_list(50, 0, 'marketful_descripcion_comun');
      if(! $producto)
      {
          $new_simple_product = new WC_Product_Simple();
          $new_simple_product->set_name("marketful_descripcion_comun");
          $new_simple_product->set_sku("");
          $new_simple_product->set_status("draft");
          $new_simple_product->set_regular_price(0);
          $new_simple_product->set_sale_price(0);
          $new_simple_product->save();
      }
  }
  /**
   * @función RunUninstall()
   */
  private function RunUninstall()
  {
      $producto = MKF_ProductEntry::GetInstance()->get_product_list(50, 0, 'marketful_descripcion_comun');
      //wc_delete_product_transients( $producto->id);
      //wp_delete_post($producto->ID);
      //$producto->delete(true);
      //$result = ! ( $producto->get_id() > 0 );
      //echo $result;
      //WC_API_Products :: delete_product ($producto->ID, true);
  }
  

}


endif;