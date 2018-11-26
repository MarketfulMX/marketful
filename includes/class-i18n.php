<?php

/**
 * Archivo: class-i18n.php
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
 * Descripción General:
 * La clase i18n hace referencia a la internacionalización del plugin, 
 * por lo cual aqui se puede ampliar la capaciadad del plugin de 
 * llegar a nuevos usuarios en su propio idioma.
 *
 */

/**
 * @Clase MKF_i18n
 * 
 */

class MKF_i18n 
{
  /**
   * @función load_plugin_textdomain()
   * Se carga el dominio de texto que corresponde al plugin, 
   * se pone como parametro el dominio y se coloca el $plugin_rel_path
   * que indica la ruta donde reside el archivo de lenguaje.
   */
  public function load_plugin_textdomain() {

    load_plugin_textdomain(
      'mkf',
      false,
      dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
    );

  }
}
