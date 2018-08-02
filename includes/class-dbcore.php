<?php
if ( !class_exists( 'MKF_DBCore', false ) ):
  /**
   * Core of the database transactions
   *
   * @link       http://innodite.com
   * @since      1.0.0
   *
   * @package    mkf
   * @subpackage mkf/includes
   * @author     Javier Urbano <javierurbano11@gmail.com> at Innodite Inc
   * @author     Angel Salazar <salazar.angel.e@gmail.com> at Innodite Inc.
   */

  /**
  * 
  */
  class MKF_DBCore
  {
    /**
     * @var Plg_Instance
     */
    protected static $Plg_Instance = NULL;
    /**
     * @var Wpdb
     */
    protected $Wpdb;
    /**
     * @var db_prefix
     */
    private $db_prefix     = "";
    /**
     * @var plugin_prefix
     */
    private $plugin_prefix = "";
    /**
     * @var default_charset
     */
    private $default_charset = "utf8";
    /**
     * @var default_collate
     */
    private $default_collate = "utf8_general_ci";

    function __construct() {

      $this->plugin_prefix = defined( 'PLUGIN_GSNAME' )   ? PLUGIN_GSNAME   : 'mkf_';

    }
    /**
     * @return dbcore instace object
     */
    public static function GetInstance() {
      if ( is_null( self::$Plg_Instance ) ) {
        self::$Plg_Instance = new self;
      }
      return self::$Plg_Instance;
    }
    /**
     * Loads our WPDB object if required.
     *
     * @return \wpdb
     */
    protected function loadWpdb() {
      if ( is_null( $this->Wpdb ) ) {
        $this->Wpdb = $this->getWpdb();
      }
      return $this->Wpdb;
    }
    /**
     */
    private function getWpdb() {
      global $wpdb;
      return $wpdb;
    }

    /* ::::::::::::::::::::::::: USABLE ::::::::::::::::::::::::*/

    public function getUsersTableName()
    {
      return $this->getPrefix() . "users";
    }

    public function getUserMetaTableName()
    {
      return $this->getPrefix() . "usermeta";
    }

    public function getPostTableName()
    {
      return $this->getPrefix() . "posts";
    }

    public function getPostMetaTableName()
    {
      return $this->getPrefix() . "postmeta";
    }

    public function getTermTaxonomyTableName()
    {
      return $this->getPrefix() . "term_taxonomy";
    }

    public function getTermRelationshipsTableName()
    {
      return $this->getPrefix() . "term_relationships";
    }

    public function getTermsTableName()
    {
      return $this->getPrefix() . "terms";
    }

    public function getPlgWpDB()
    {
      return $this->loadWpdb();
    }

    public function getPrefix()
    {
      if (empty($this->db_prefix)) {
        $this->db_prefix = $this->getPlgWpDB()->prefix;
      }
      return $this->db_prefix;
    }

    public function getPlgPrefix()
    {
    	return $this->plugin_prefix;
    }

    public function getCharSet()
    {
      $charset_collate = '';

      if (empty($this->getPlgWpDB()->charset)) {
        $charset_collate = "DEFAULT CHARSET={$this->default_charset}";
      } else {
        $charset_collate = "DEFAULT CHARACTER SET {$this->getPlgWpDB()->charset}";
      }

      if (empty($this->getPlgWpDB()->collate)) {
        $charset_collate .= " COLLATE {$this->default_collate}";
      } else {
        $charset_collate .= " COLLATE {$this->getPlgWpDB()->collate}";
      }

      return $charset_collate;
    }

    public function execute_custom_query($query, $force_row = false) {

      $result_set = $this->loadWpdb()->get_results($query, OBJECT);

      if ($force_row) {
        return $this->get_rows_force($result_set);
      }
      return $result_set;
    }

    protected function get_rows_force($result_set) {
      switch (count($result_set)) {
        case 1: return $result_set[0];
        case 0: return false;
        default: return $result_set;
      }
      return $result_set;
    }

  }

endif;