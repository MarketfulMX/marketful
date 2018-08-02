<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://innodite.com
 * @since      1.0.0
 *
 * @package    mkf
 * @subpackage mkf/includes
 * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc
 * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
 */


class MKF_i18n {


  /**
   * Load the plugin text domain for translation.
   *
   * @since    1.0.0
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
      'mkf',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );

  }



}
