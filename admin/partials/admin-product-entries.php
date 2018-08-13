<?php
/*
 * Archivo: admin-product-edit-form.php
 * Ultima edición : 7 de agosto de 2018
 *
 * @autor: Adolfo Yanes (adolfo@marketful.mx)
 * @autor: Administrador de Proyecto: Mauricio Alcala (mauricio@marketful.mx)
 * @versión: 1.02
 * 
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 */

 /**
 * Descripción General: 
 * Sección de publicaciones dentro del plugin de Marketful
 * que muestra la lista de productos con opcion de modificar
 * los atributos de status, exposición y permite buscar 
 * entre tus productos.
 *
 *
 */

/*
* @Script PHP
* Se toman los productos que se mostraran dentro de la tabla, y se guardan dentro de $products.
* Se toma la imagen que se mostrara como cabecera.
*/
$products = MKF_ProductEntry::GetInstance()->get_product_list();
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

?>


<?php

/*
* @Script PHP
* Primero se valida con el @parametro $_POST['nonce'] y si el hash es correcto
* posteriormente manda a llamar a la funcion my_theme_ajax_submit()
*
*/
if (isset($_POST['my_theme_ajax_submit']))
    if ( wp_verify_nonce( $_POST['nonce'], 'my_theme_ajax_submit' ) )
        my_theme_ajax_submit(); 
/*
 * @Función PHP: my_theme_ajax_submit()
 * La @función my_theme_ajax_submit() recibe dentro de las variables:
 * $producto_id = Identificador del producto 
 * $value = Nuevo valor a actualizar
 * $key = Tipo de metadato que se modificara
 *
 * Posteriormente despues de recibir los @parámetros ejecuta la función de wp
 * update_post_meta(@string,@string,@string) que actualiza la meta data que se envió.
 *
 * Para finalizar la @función wp_die() finaliza la ejecución y muestra el error
 * en caso de que suceda alguno.
 */

function my_theme_ajax_submit() {
    // do something
    // some php code that fires from AJAX click of #fire
    $producto_id = $_POST['product_id'];
    $value = $_POST['value'];
    $key = $_POST['key'];
    ### aqui fue 
    // update_user_meta( 1, "first_name", nombre );
    $a = update_post_meta( $producto_id, $key, $value );
    // wp_send_json_success([200, "hola"], 200) ; NO SIRVE
    error_log("guardarmos el producto");
    // error_log($a)
    // Notificar el cambio a Marketful para que lo envie a Mercadolibre
    // $url = "https://woocommerce.marketful.mx/notifications?{$key}={$value}&product_id={$producto_id}";
     // para pruebas locales
    site_url = <get_site_url();
    $url = "http://localhost:3000/notifications?{$key}={$value}&product_id={$producto_id}&site=site_url";
    // $parametros = array($key => $value, "woo_id" => $_POST['product_id']);
    error_log( print_r($parametros, TRUE));
    // $response = wp_remote_post( $url, $args = $parametros ); 
    $http = _wp_http_get_object();
    // $response = $http->post( $url, array("elkey" => "elvalue") ); no manda los params 
    $response = $http->post( $url );
    error_log( print_r($response, TRUE));
    wp_die();
}
?>

<!-- <button id='fire'>Fire Something</button> -->

<script>
/*
 * - @Función JQuery/Ajax: cambioStatus(@string,@string)
 * Esta función recibe dos @parámetros que son el id del producto y el tipo de
 * metadato que modificara.
 * La @función console log muestra en la consola del navegador la información del objeto
 * product_id.
 *
 * Se crea una variable con el valor del select que se modificó, se obtiene dicha
 * información obteniendo el id del select con el tipo de metadato que se modificara
 * más guion bajo más el id del producto.
 *
 * Se envía con console.log el valor de key
 * Se crea una función AJAX que pide el tipo de solicitud que se hace 'POST'
 * y se envían los @parámetros además que se manda a llamar a la función de PHP 
 * my_theme_ajax_submit. Se le envían los @parámetros: product_id, value y key .
 *
 * La @función Ajax que nombramos response nos responde a la solicitud con un archivo Json.
 *
 * En caso de que la @función haya resultado exitosa, la reflejamos en consola con
 * console.log y lo mostramos en el @boton #fire cambiando su texto a "Cambio
 * correcto".
 * En caso de que la @función Ajax no haya resultado exitosa, reflejamos en
 * consola el error y actualizamos el @boton #fire cambiando su texto a "error".
 */
       function cambioStatus(product_id, key){
            console.log(product_id)
            var value = $('#' + key + "_" + product_id).val()
            console.log(key)
            jQuery.ajax({
                type: 'post',
                data: { 
                    "my_theme_ajax_submit": "now",
                    "nonce" : "<?php echo wp_create_nonce( 'my_theme_ajax_submit' ); ?>", 
                    product_id: product_id, 
                    value: value, 
                    key: key
                },
                success: function(response) { 
                  console.log(response)
                    // jQuery('#fire').text("Cambio Correcto!");
                },
                error: function(response) { 
                  console.log(response)
                    // jQuery('#fire').text("...error!");
                },
            });
        };
</script>




<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    
    /*
    * @Script JQuery
    * Mostramos en consola con console.log los valores de my_ajax_obj y ajaxurl
    */
    
  // $(".status").on("change", cambioStatus)
console.log(my_ajax_obj)
console.log(ajaxurl)
  // function cambioStatus(){
  //   console.log("hola");    

  //   var this2 = this;                      //use in callback
  //   $.post(my_ajax_obj.ajax_url, {         //POST request
  //      _ajax_nonce: my_ajax_obj.nonce,     //nonce
  //       action: "my_ajax_handler",            //action
  //       title: this.value                  //data
  //   }, function(data) {                    //callback
  //     console.log(data)
  //       // this2.nextSibling.remove();        //remove current title
  //       // $(this2).after(data);              //insert server response
  //   });
  // }     
    
</script>

<div class="bootstrap-wrapper">
<div class="container" style="margin-top: 5%">

  <?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> 

  <table id="services_list" class="table stripe tableMK" style="width:100%">
    <thead>
      <tr>
        <th class="dt_check"><input type="checkbox" class="ids" name="ids[]"  /> </th>
        <th>SKU </th>
        <th>Título</th>
        <th>Status</th>
        <th>Exposición</th>
        <th style="min-width: 215px;">Acción</th>
      </tr>
    </thead>
    <tbody>
    <?php
      foreach ($products[0]["data"] as $key => $product) :
    ?>
      <tr>
        <td class="dt_check"><input type="checkbox" class="ids" name="ids[]" value="<?php echo $product->ID; ?>" />  </td>
        <td><?php echo $product->sku; ?></td>
        <td><?php echo $product->title; ?></td>
        <td>
            ******************************************************************
                @Scripts PHP en esta sección:
                -  Hacemos un Echo al valor de ID del producto para mandarlo como parametro a la @función
                   cambioStatus(@string,@string)
                -  Se toman los datos de los productos en $productObject.
                -  Se capta toda la metadata desde el objeto $productObject
                -  Se selecciona de la matriz resultante, el valor relacionado con el status
                -  Dentro del select, se hace echo de 'Selected' para que sea la opcion seleccionada, en        caso de que el valor de $select_value sea igual a alguna de las opciones.
                -  Se repite el procedimiento, pero en esta ocacion el dato que se utiliza es exposición_ml
                --->
            <select class="status" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'mercadolibre')" id="mercadolibre_<?php echo $product->ID;  ?>">
            <?php $productObject = MKF_ProductEntry::GetInstance(); ?>
            <?php $all_mlmeta = $productObject->get_ml_metadata($product->ID) ?>
            <?php $select_value = $all_mlmeta[0]["data"][0]->status; ?>
                <option>...</option>
                <option value="active" <?php echo ($select_value=="active")?'selected':''; ?>>Activa</option>
                <option value="paused" <?php echo ($select_value=="paused")?'selected':''; ?>>Pausada</option>
                <option value="closed" <?php echo ($select_value=="closed")?'selected':''; ?> >Finalizada</option> 
            </select>
        </td>
        <td>
            <select onChange="cambioStatus(<?php echo $product->ID;  ?>, 'exposicion_ml')" id="exposicion_ml_<?php echo $product->ID;  ?>">
            <?php $select_value = $all_mlmeta[0]["data"][0]->exposicion; ?>
                <option>...</option>
                <option value="free" <?php echo ($select_value=="free")?'selected':''; ?>>Gratis</option>
                <option value="clasica" <?php echo ($select_value=="clasica")?'selected':''; ?>>Clasica</option>
                <option value="premium" <?php echo ($select_value=="premium")?'selected':''; ?> >Premium</option> 
            </select>
        </td>
        <td>
          <a href="?page=mkf-product-edit&product_id=<?php echo $product->ID; ?>" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
          <a href="<?php echo $product->url; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Preview</a>
        </td>
      </tr>
    <?php endforeach; //Fin Iteracion ?>
    </tbody>
  </table>
</div>
</div>



