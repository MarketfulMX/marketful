<?php

/**
 * Archivo: class-admin-product-entries.php
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
 * Este contiene la clase admin-product-entries, tiene las funciones de crear y ejecutar 
 * la query para solicitar todos los registros que se van a mostrar dentro de las 
 * diferentes secciones del plugin. Ademas define el nombre del plugin, la version
 * y dos ejemplos de hooks para como poner en cola la hoja de estilo específica de 
 * administrador y JavaScript.
 */

/**
 * PRODUCT METADATA MercadoLibre 
 * Se declaran constantes para referirse a campos en la base de datos
 */
if (!defined('ML_META_TITLE'))
    define('ML_META_TITLE', 'titulo_ml');
if (!defined('ML_META_STATUS'))
    define('ML_META_STATUS', 'mercadolibre');
if (!defined('ML_META_STOCK'))
    define('ML_META_STOCK', 'inventario_ml');
if (!defined('ML_META_EXPOSITION_TYPE'))
    define('ML_META_EXPOSITION_TYPE', 'exposicion_ml');
if (!defined('ML_META_DELIVERY_TYPE'))
    define('ML_META_DELIVERY_TYPE', 'tipo_de_envio_ml');
if (!defined('ML_META_STORE_RECALL'))
    define('ML_META_STORE_RECALL', 'retiro_en_tienda_ml');
if (!defined('ML_META_WARRANTY_TIME'))
    define('ML_META_WARRANTY_TIME', 'tiempo_garantia_ml');
if (!defined('ML_META_WARRANTY_UNIT_TIME'))
    define('ML_META_WARRANTY_UNIT_TIME', 'ut_garantia_ml');
if (!defined('ML_META_PRICE'))
    define('ML_META_PRICE', 'regular_price');
if (!defined('ML_META_CATEGORIES'))
    define('ML_META_CATEGORIES', 'categories_ml');
if (!defined('ML_META_LAST_CATEGORY'))
    define('ML_META_LAST_CATEGORY', 'last_category_ml');
if (!defined('ML_META_PRECIO_ML'))
    define('ML_META_PRECIO_ML', 'precio_ml');

//Orders


/**
 * @Clase MKF_ProductEntry que @hereda los metodos y atributos de MKF_DBCore
 *
 * Se declaran las variables de la clase. Ademas se definen las propiedades de la clase
 * ($instance @string, $plg_id @string y $version @string)
 *
 */
class MKF_ProductEntry extends MKF_DBCore 
{
    private static $instance = NULL;
    private $plg_id;
    private $version;
    private $meta_title;
    private $meta_stock;
    private $meta_store;
    private $meta_status;
    private $meta_exp;
    private $meta_wtime;
    private $meta_utime;
    private $meta_price;
    private $meta_cat;
    private $meta_lcat;
    private $meta_precio_ml;
    
    // Agregando error_ml
    private $meta_error_ml;
    
    
    /**
     * @función __construct(@string = (PLUGIN_GSNAME), @string = (PLUGIN_GVERSION))
     *
     * Recibe el valor del $plg id y $version, en caso de que no se envien se asignara el 
     * valor del plugin_gsname y plugin_version.
     *
     * Posteriormente, asigna a las variables que se definieron en un principio los valores de los 
     * diferentes campos de ML.
     */
    public function __construct( $plg_id = PLUGIN_GSNAME, $version = PLUGIN_GVERSION) 
    {
        $this->plg_id  = $plg_id;
        $this->version = $version;
        $this->meta_title  = ML_META_TITLE;
        $this->meta_status = ML_META_STATUS;
        $this->meta_stock  = ML_META_STOCK;
        $this->meta_store  = ML_META_STORE_RECALL;
        $this->meta_exp    = ML_META_EXPOSITION_TYPE;
        $this->meta_ship   = ML_META_DELIVERY_TYPE;
        $this->meta_wtime  = ML_META_WARRANTY_TIME;
        $this->meta_utime  = ML_META_WARRANTY_UNIT_TIME;
        $this->meta_price  = ML_META_PRICE;
        $this->meta_cat    = ML_META_CATEGORIES;
        $this->meta_lcat   = ML_META_LAST_CATEGORY;
        $this->meta_precio_ml   = ML_META_PRECIO_ML;

        // Orders 
    }


    /*
     * @Función PHP: my_theme_ajax_submit()
     * 
     * - Descripcion General: La @función my_theme_ajax_submit() recibe dentro de las variables:
     * $producto_id = Identificador del producto 
     * $value = Nuevo valor a actualizar
     * $key = Tipo de metadato que se modificara
     *
     * Posteriormente despues de recibir los @parámetros ejecuta la función de wp
     * update_post_meta(@string,@string,@string) que actualiza la meta data que se envió.
     * 
     * Se obtiene el $site_url, despues se crea el URL para guardar en ML con la $key
     * y con el valor a cambiar $value del $producto_id en la $site_url que obtuvimos
     * previamente.
     * Se muestra un error en caso de que haya succedido.
     * Se guarda un objeto inicializado WP_Http, se postea la $URL para ejecutar los cambios
     * y en caso de error se muestra.
     *
     * Para finalizar la @función wp_die() finaliza la ejecución y muestra el error
     * en caso de que suceda alguno.
     */
    public function my_theme_ajax_submit() 
    {
        $producto_id = $_POST['product_id'];
        $value = $_POST['value'];
        $key = $_POST['key'];
        $tarea_id = $_POST['tarea_id'];
        $a = update_post_meta( $producto_id, $key, $value );
        wp_send_json_success(array('product_id' => $producto_id, 'value' => $value, 'key' => $key, 'tarea_id'=>$tarea_id));
        wp_die();
    }

    /**
     * @Funcion actualiza_mkf()
     * 
     * - Descripcion Masiva: Recibe el metadato y el valor que se va a cambiar para actualizar el valor en woocommerce.marketful
     */
    public function actualiza_mkf() 
    {
        $producto_id = $_POST['product_id'];
        $tarea_id = $_POST['tarea_id'];
        $site_url = get_site_url();
        $url = "https://woocommerce.marketful.mx/notifications?product_id={$producto_id}&site={$site_url}";
        $http = _wp_http_get_object();
        $response = $http->post( $url ); 
        wp_send_json_success(array('product_id' => $producto_id, 'value' => $value, 'key' => $key, 'tarea_id'=>$tarea_id));
        wp_die();
    }
    
    
    /** 
     * @funcion des_comun_ajax_submit()
     *
     * - Descripcion General: Agrega la descripcion masiva a los productos.
     **/
    public function desc_comun_ajax_submit() 
    {
        error_log("entramos en descomunajax");
        $product_id = $_POST['product_id'];
        $descripcion = $_POST['descripcion'];
        error_log($product_id);
        error_log($descripcion);
        $my_post = array();
        $my_post['ID'] = $product_id;
        $my_post['post_content'] = $descripcion;
        wp_update_post( $my_post );
        $site_url = get_site_url();
        $url = "https://woocommerce.marketful.mx/notifications?site={$site_url}&descomun=true&product_id={$product_id}";
        $http = _wp_http_get_object();
        $response = $http->post( $url ); 
        wp_send_json_success(array($descripcion));
        wp_die();
    }

    
    /**
     * @función GetInstance()
     * 
     * - Descripcion General: Es una función estatica que accede al objeto $instance y busca que sea nulo, 
     * en cuyo caso creal el objeto.
     * Em caso contrario retorna el objeto.
     */
    // funcion para traer objetos de la clase
    public static function GetInstance() 
    {
        if ( is_null( self::$instance ) ) 
        {
            self::$instance = new self;
        }
        return self::$instance;
    }


    /**
     * @función prefix_admin:add_metadata_to_product_entry()
     *
     * - Descripcion General: Primero tomamos el valor de extr_prefix_all en caso de no encontrar ningun valor le asignamos una "p"
     * Posteriormente con la funcion update_post_meta de WP actualizamos los valores del producto $p_product_id.
     * Finaliza redirigiendonos hacia admin.php en la sección mkf-product-entries.
     */
    // funcion para guardar la data q viene del formulario
    public function prefix_admin_add_metadata_to_product_entry()
    {

        extract($_REQUEST,EXTR_PREFIX_ALL,"p");
        // update_post_meta(intval($p_product_id), $this->meta_title, empty($p_entry_title) ? null : $p_entry_title);
        update_post_meta(intval($p_product_id), $this->meta_stock, $p_stock);
        // update_post_meta(intval($p_product_id), $this->meta_store, $p_store_recall);
        update_post_meta(intval($p_product_id), $this->meta_status, $p_status_post);
        update_post_meta(intval($p_product_id), $this->meta_exp, $p_exposition);
        // update_post_meta(intval($p_product_id), $this->meta_wtime, $p_time_warranty);
        update_post_meta(intval($p_product_id), $this->meta_cat, json_encode($p_ml_categories, JSON_FORCE_OBJECT));
        update_post_meta(intval($p_product_id), $this->meta_lcat, $p_ml_categories['child'][count($p_ml_categories['child']) - 1]);
        // update_post_meta(intval($p_product_id), $this->meta_precio_ml, $p_precio_ml);
        header("Location: admin.php?page=mkf-product-entries&success");
    }

    
    /**
     * @función get_product_list()
     *
     * - Descripcion General: Esta función define la query que se requiere hacer y la ejecuta para traer todos los datos que requiere el 
     * plugin.
     * 
     * Primero se define un array que posteriormente mostrara toda la información resultante llamado $out.
     * Despues utilizando array_push() agregamos al final del array out() el resultado que devuelve
     * ejecutar la query.
     * Despues retorna el valor de $out
     */
    // funcion para traer los productos
    public function get_product_list($tope, $offset, $keyword)
    {

        $out = array();

        $sql = "SELECT tmp.ID,
                   tmp.sku,
                   IFNULL(tmp.titulo_ml, tmp.title) title,
                   CASE WHEN tmp.mercadolibre = 'A' THEN 'Activo' 
                        WHEN tmp.mercadolibre = 'I' THEN 'Inactivo'
                   ELSE tmp.mercadolibre
                   END status,
                   CASE WHEN tmp.exposicion_ml = 'C' THEN 'Clasica' 
                        WHEN tmp.exposicion_ml = 'P' THEN 'Premium'
                   ELSE tmp.exposicion_ml
                   END exposicion
            FROM
            (
              SELECT p.ID, 
                     pm1.meta_value sku, 
                     (SELECT meta_value 
                      FROM {$this->getPostMetaTableName()} 
                      WHERE post_id = p.ID AND meta_key = '{$this->meta_title}') titulo_ml,
                     p.post_title title,
                     (SELECT meta_value 
                      FROM {$this->getPostMetaTableName()} 
                      WHERE post_id = p.ID AND meta_key = '{$this->meta_status}') mercadolibre,
                     (SELECT meta_value 
                      FROM {$this->getPostMetaTableName()} 
                      WHERE post_id = p.ID AND meta_key = '{$this->meta_exp}') exposicion_ml
                      
              FROM {$this->getPostTableName()} p
              INNER JOIN {$this->getPostMetaTableName()} pm1 ON pm1.post_id = p.ID and pm1.meta_key = '_sku'
              WHERE 
              (p.post_type = 'product' AND 
              p.post_title LIKE '%{$keyword}%' AND 
              'trash' != (SELECT post_status FROM wp_posts t2 WHERE p.ID = t2.ID) OR 
              (pm1.meta_key = '_sku' AND pm1.meta_value LIKE '%{$keyword}%')))  
              tmp limit {$tope} offset {$offset}";

        array_push($out, array("data"=> $this->execute_custom_query($sql)));
        return $out;
    }

    /** 
     * @fución publica get_ml_metadata(@string = (NULL))
     *
     * - Descripcion General: Recibe el valor de el $post_id y en caso de no enontrarlo le asigna valor nulo.
     * Crea en una variable @string la query que se requere ejecutar.
     * Posteriormente con la función array_push() se ejecuta la query y se guarda dentro del array $out
     * Para finalizar retornando el valor de $out.
     */
    public function get_ml_metadata($post_id = null)
    {
        $out = array();

        $post_id = is_null($post_id) ? 0 : intval($post_id);

        $sql = "SELECT pm1.meta_value title,
                   pm2.meta_value status,
                   pm3.meta_value inventary,
                   pm4.meta_value exposicion,
                   pm5.meta_value delivery_type,
                   pm6.meta_value store_recall,
                   pm7.meta_value time_warranty,
                   pm8.meta_value utime_warranty,
                   pm9.meta_value price,
                   pm10.meta_value categories, 
                   pm11.meta_value precio_ml
            FROM {$this->getPostTableName()} p
            LEFT JOIN {$this->getPostMetaTableName()} pm1 ON pm1.post_id = p.ID and pm1.meta_key = '{$this->meta_title}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm2 ON pm2.post_id = p.ID and pm2.meta_key = '{$this->meta_status}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm3 ON pm3.post_id = p.ID and pm3.meta_key = '{$this->meta_stock}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm4 ON pm4.post_id = p.ID and pm4.meta_key = '{$this->meta_exp}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm5 ON pm5.post_id = p.ID and pm5.meta_key = '{$this->meta_ship}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm6 ON pm6.post_id = p.ID and pm6.meta_key = '{$this->meta_store}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm7 ON pm7.post_id = p.ID and pm7.meta_key = '{$this->meta_wtime}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm8 ON pm8.post_id = p.ID and pm8.meta_key = '{$this->meta_utime}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm9 ON pm9.post_id = p.ID and pm9.meta_key = '{$this->meta_price}' 
            LEFT JOIN {$this->getPostMetaTableName()} pm10 ON pm10.post_id = p.ID and pm10.meta_key = '{$this->meta_cat}'
            LEFT JOIN {$this->getPostMetaTableName()} pm11 ON pm9.post_id = p.ID and pm11.meta_key = '{$this->meta_precio_ml}' 
            WHERE p.ID = {$post_id}";

        array_push($out, array("data"=> $this->execute_custom_query($sql)));
        return $out;
    }

    /** 
     * @función get_product_edit_form_title(@tring = (NULL), @string = (NULL))
     * 
     * - Descripcion General: Dentro de esta función se retorna el valor del titulo dependiendo si es nulo o simplemente esta vacio, 
     * así como el valor del SKU.
     */
    public static function get_product_edit_form_title($title = null, $sku = null)
    {
        return ((is_null($title) || empty($title)) ? "" : $title) .
            ((is_null($sku)   || empty($sku))   ? "" : " // " . $sku);
    }

    /**
     * @función product_edit_form_title_to_presenter(@string = (NULL), @tring = (NULL))
     * 
     * - Descripcion General: Hace echo al valor  $title y $Sku del objeto en cuestion.
     */
    public static function product_edit_form_title_to_presenter($title = null, $sku = null)
    {
        echo self::get_product_edit_form_title($title, $sku);
    }
    public function get_ml_categories()
    {
        require_once plugin_dir_path( __FILE__ ) . "extras/vendor/autoload.php";

        // Create a client with a base URI
        $client = new GuzzleHttp\Client([
            'base_uri' => 'https://api.mercadolibre.com/sites/MLM/categories',
            'verify' => false
        ]);

        $response = $client->request('GET', 'categories#json');
        return $response;
    }

    /**
     * @funcion test_product()
     * - Descripcion General: Crea un producto de prueba para el obboarding
     */
    public function test_product()
    {
        if(function_exists(wc_get_products))
        {
            $products = wc_get_products( array(
                'title' => 'Producto de Prueba',
                ));
            if(! $products)
            {
                $new_simple_product = new WC_Product_Simple();
                $new_simple_product->set_name("Producto de Prueba");
                $new_simple_product->set_description(" Este es un producto de prueba. ");
                $new_simple_product->set_sku("");
                $new_simple_product->set_status("publish");
                $new_simple_product->set_regular_price(10);
                $new_simple_product->set_sale_price(5);
                $new_simple_product->save();
            }
        }
    }
    /**
     * @Funcion test_product_delete()
     * - Descripcion General: Borra el producto de prueba para el onboarding
     */
    public function test_product_delete()
    {
        if(function_exists(wc_get_products))
        {
            $products = wc_get_products( array(
                'title' => 'Producto de Prueba',
                ));
            if(isset($products[0]))
            {
                $producto = $products[0]->get_id();
            }
            wp_delete_post($producto);
        }
    }
    /**
     * @funcion get_ce()
     * 
     * - Descripcion General: Funcion que se manda a llamar via ajax y manda a llamar a la API Marketful para obtener el 
     * costo de envio.
     */
    public function get_ce()
    {
        $woo_id = $_GET['woo_id'];
        $category_id = $_GET['category_id'];
        $price = $_GET['price'];
        $site_url = get_site_url();
        $url = "https://woocommerce.marketful.mx/calcular_costos_envio?woo_id={$woo_id}&price={$price}&category_id={$category_id}&site={$site_url}";
        $http = _wp_http_get_object();
        $response = $http->get( $url ); 
        // @Array $test contiene valores de prueba. comentar para ver funcionamiento real. y cambiar el parametro en la funcion 
        // wp_send_json_success() por $response
        //$test = array("costo_comision" => ($price * .13),"woo_id" => "13");
        error_log($response["body"]);
        $parseada = json_decode($response["body"]);
        wp_send_json_success($parseada);
        wp_die();
    }




    // ORDERS
    /***
      * @Funcion get_order_list()
      *
      * - Descripcion General: Esta funcion hace la query para retornar la lista de ordenes buscando las de Mercado Libre.
      *
      * La query que se guarda en $sql parte de la orden que se guarda en la tabla posts, de ahi toma todos los metadatos de la orden, 
      * y luego busca todos los productos de la orden y sus metadatos.
      *
      */

      public function get_order_list($keyword = '', $tope = 50, $offset = 0)
      {
        /***********************************
         * @script Obtenemos el nombre prefijo de la base de datos utilizando la clase de WP wpdb
         * la cual nos entrega el valor del prefijo de la base de datos con $wpdb->get_blog_prefix()
         * prefijo que utilizaremos para las querys posteriores haciendo que funcione sin inportar el 
         * prefijo que se haya definido en la instalacion de wordpress.
         */ 
        global $wpdb;
        $prefix = $wpdb->get_blog_prefix();
        //***********************************

        $out = array();
        //$out2 = array(); //No borar: Array para cambiar el idioma en el que se muestra la fecha. 

        $sql = "
        SELECT pt.ID id
        FROM {$prefix}posts pt
        INNER JOIN {$prefix}postmeta pm ON pt.ID = pm.post_id AND pm.meta_key = '_customer_user' AND pm.meta_value = '771'
        WHERE pt.post_type = 'shop_order' AND (pt.post_status = 'wc-pending' OR pt.post_status = 'wc-processing' OR pt.post_status = 'wc-on-hold')
        ";
    
        //$sql_set_lan = "SET lc_time_names = 'es_ES'"; // No borrar: Query para cambiar el idioma a español en el que se muestra la fecha
        
        //array_push($out2, array("data"=> $this->execute_custom_query($sql_set_lan))); //No borrar: Se ejecuta la query para cambiar el idioma de la fecha a español
        array_push($out, array("data"=> $this->execute_custom_query($sql)));
        return $out;
      }
}