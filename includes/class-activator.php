<?php
if ( !class_exists( 'MKF_Activator', false ) ):
/**
 * Fired during plugin activation
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @link       http://innodite.com
 * @since      1.0.0
 *
 * @package    mkf
 * @subpackage mkf/includes
 * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc.
 * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
 */

class MKF_Activator extends MKF_DBCore {

  protected static $instance = NULL;

  public static function GetInstance() {
    if ( is_null( self::$instance ) ) {
      self::$instance = new self;
    }
    return self::$instance;
  }
  /**
   * Short Description. (use period)
   *
   * Long Description.
   *
   * @since    1.0.0
   */
  public function activate() {
    $this->RunInstall();
  }

  public function deactivate() {
    $this->RunUninstall();
  }

  private function RunInstall() 
  {
    
  }

  private function RunUninstall()
  {
    
  }
  

}


endif;