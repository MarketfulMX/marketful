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
$pagina = $_GET['pagina'];
$tope = $_GET['tope'];
$keyword = $_GET['keyword'];

$offset = 0;
if (is_null($pagina)){
  error_log("la pagina es nula");
  $offset = 0;
  $pagina = 1;
} else {
  error_log ("la pagina esta presente");
  error_log($pagina);
  $offset = ($pagina-1)*50;
}
if (is_null($tope)){
  error_log("el tope es nulo");
  $tope = 50;
} else {
  error_log ("el tope esta presente");
}
  


$products = MKF_ProductEntry::GetInstance()->get_product_list($tope, $offset, $keyword);
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

?>


<?php

/*
* @Script PHP
* Primero se valida con el @parametro $_POST['nonce'] y si el hash es correcto
* posteriormente manda a llamar a la funcion my_theme_ajax_submit()
*
*/
if (isset($_POST['my_theme_ajax_submit'])){
  if ( wp_verify_nonce( $_POST['nonce'], 'my_theme_ajax_submit' ) ){
    $response = my_theme_ajax_submit(); 
    error_log("vamos con la response");
    error_log($response);
    echo $response;
  }
  error_log("vamos con la salida del isset");
  wp_die();
  // error_log($response);
  
}
    
   error_log("estamos fuera del isset");      
        // wp_send_json_success("hola");

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

function my_theme_ajax_submit() 
{
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
    error_log($a);
    // error_log($a)
    // Notificar el cambio a Marketful para que lo envie a Mercadolibre
    $site_url = get_site_url();
    $url = "https://woocommerce.marketful.mx/notifications?{$key}={$value}&product_id={$producto_id}&site={$site_url}";
    // para pruebas locales
    // $url = "http://localhost:3000/notifications?{$key}={$value}&product_id={$producto_id}&site={$site_url}"; 
    // $parametros = array($key => $value, "woo_id" => $_POST['product_id']);
    // error_log( print_r($parametros, TRUE));
    // $response = wp_remote_post( $url, $args = $parametros ); 
    $http = _wp_http_get_object();
    // $response = $http->post( $url, array("elkey" => "elvalue") ); no manda los params 
    $response = $http->post( $url ); 
    // error_log( print_r($response, TRUE));
    // wp_die();
    $data = array(
      'producto_id' => $product_id
      );
    error_log("vamos de salida");
    // echo "Hola";

    // return "hello";
    echo "salidaprueba";
    // wp_send_json_success($data);
    // wp_send_json_error($data);
    // echo "hello";
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
       function cambioStatus(product_id, key)
       {
            console.log(product_id)
            var value = $('#' + key + "_" + product_id).val()
            console.log(key)
            jQuery.ajax({
                type: 'post',
                url: ajaxurl,
                // dataType: 'json',
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


  function buscarResultados(){
    var keyword = jQuery('#keyword_input').val();
    var url = "?page=mkf-product-entries&keyword=" + keyword
    window.location.href = url;
  }

  function selectTodos(){
    console.log("entramos en select otodos")
    checkboxes = document.getElementsByName('checkboxes');
    var source = $('#checkbox_master')
    console.log(source)
    for(var i=0, n=checkboxes.length;i<n;i++) {
      checkboxes[i].checked = source.is(":checked");
      console.log(i)
      // checkboxes[i].checked = true;
    }
  }

  function statusMasivo(){
    console.log("vamos a hacer un cambio masivo")
    // console.log(product_id)
    var value = $('#status_select').val()
    var key = "mercadolibre"
    console.log(key)
    console.log(value)
    var isGood=confirm('Confirmar hacer cambio masivo de status a ' + value + '?');
    if (isGood) {
      console.log("se prendio")
      var checkboxes = $( '[name="checkboxes"]:checked');
      for(var i=0, n=checkboxes.length;i<n;i++) {
        var product_id = checkboxes[i].id.replace("checkbox_", "")
        console.log(product_id)
        // checkboxes[i].checked = true;

          jQuery.ajax({
              url: ajaxurl,
              type: 'post',
              dataType: 'json',
              data: { 
                  "my_theme_ajax_submit": "now",
                  "nonce" : "<?php echo wp_create_nonce( 'my_theme_ajax_submit' ); ?>", 
                  product_id: product_id, 
                  value: value, 
                  key: key
              },
              success: function(response) { 
                console.log(response)
                console.log("success")
                
                // var nombre = 'mercadolibre_' + product_id
                // var element = document.getElementById(nombre);
                // element.value = value;
              },
              error: function(response) { 
                console.log("error")
                console.log(response.responseText)

                console.log(response.data)
                  // jQuery('#fire').text("...error!");
              },
          });
      }
    }
  }

  function setSelect(){
    console.log("entramos en set select")
    // $('#mercadolibre_' + product_id).value = value;

    var element = document.getElementById('mercadolibre_37');
    console.log(element)
      element.value = "paused";
  }



</script>



<style>
  .filtro{
    /*float: right;*/
    text-align: right;
  }
</style>

<div class="bootstrap-wrapper">
<div class="container" style="margin-top: 5%">

  <?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> 

<div class="col-lg-12 col-md-12 col-sm-12" style=" padding-top:20px;">
  

  <div class="row">

    <div id="paginador" style="float: left;" class="col-lg-3 col-md-3 col-sm-3 col-xs-3">
      <?php 
      if($pagina > 1){
        ?>
        <a href="?page=mkf-product-entries&pagina=<?php echo ($pagina - 1) ?>">Anterior</a> | 
      <?php
      }else{
      ?>
        Anterior | 
      <?php
      }
      ?>
      <a href="?page=mkf-product-entries&pagina=<?php echo $pagina + 1 ?>">Siguiente</a>
    </div>
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
      Cambiar Selección: 
      <select class="status" id="status_select" onChange="statusMasivo()" >
          <option>Status</option>
          <option value="active" >Activa</option>
          <option value="paused" >Pausada</option>
          <option value="closed" >Finalizada</option> 
      </select>
      <button onClick="setSelect()">seleccion imponer</button>
    </div>
    <div class="filtro col-lg-4 col-md-4 col-sm-4 col-xs-4">
      <label> 
        <input placeholder="Titulo" id="keyword_input">
      </label>
      <button id="boton_buscar" onClick="buscarResultados()">Buscar</button>
    </div>
  </div>
</div>



  <table id="" class="table stripe tableMK" style="width:100%">
    <thead>
      <tr>
        <th class="dt_check"><input type="checkbox" class="ids"   id="checkbox_master" onClick="selectTodos()"/> </th>
        <th>SKU </th>
        <th>Título</th>
        <th>Status</th>
        <th>Exposición</th>
        <!-- <th style="min-width: 215px;">Acción</th> -->
      </tr>
    </thead>
    <tbody id="tbody_productos">
    <!-- Creamos un foreach para recorrer todos los valores -->
    <?php
      foreach ($products[0]["data"] as $key => $product) :
    ?>
      <tr>
        <td class="dt_check"><input type="checkbox" class="ids" name="checkboxes" id="checkbox_<?php echo $product->ID; ?>" />  </td>
        <td><?php echo $product->sku; ?></td>
        <td><?php echo $product->title; ?></td>
        <td><!--
            ******************************************************************
                @Scripts PHP en esta sección:
                -  Hacemos un Echo al valor de ID del producto para mandarlo como parametro a la @función
                   cambioStatus(@string,@string)
                -  Se toman los datos de los productos en $productObject.
                -  Se capta toda la metadata desde el objeto $productObject
                -  Se selecciona de la matriz resultante, el valor relacionado con el status
                -  Dentro del select, se hace echo de 'Selected' para que sea la opcion seleccionada, en        caso de que el valor de $select_value sea igual a alguna de las opciones.
                -  Se repite el procedimiento, pero en esta ocacion el dato que se utiliza es exposición_ml
                -->
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
         <!--  <td>
          <a href="?page=mkf-product-edit&product_id=<?php echo $product->ID; ?>" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
          <a href="<?php echo $product->url; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Preview</a>
        </td> -->
      </tr>
    <?php endforeach; //Fin Iteracion ?>
    </tbody>
  </table>
</div>
</div>



