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
                dataType: 'json',
                data: { 
                    product_id: product_id, 
                    value: value, 
                    key: key, 
                    action: 'foobar'
                },
                success: function(response) { 
                  console.log("exito")
                  console.log(response)
                   
                },
                error: function(response) { 
                  console.log("fracaso")
                  console.log(response)
                   
                },
            });
        };
</script>



<!-- // creo que sobra  -->
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

  function statusMasivo(key, nombre_key, id){
    console.log("vamos a hacer un cambio masivo")
    // console.log(product_id)
    var value = $('#' + id).val()
    // var key = "mercadolibre"
    console.log(key)
    console.log(value)
    var isGood=confirm('Confirmar hacer cambio masivo de ' + nombre_key + ' a ' + value + '?');
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
                  product_id: product_id, 
                  value: value, 
                  key: key,
                  action: 'foobar'
              },
              success: function(response) { 
                console.log(response.data)
                console.log("success")
                var nombre = key + "_" + response.data["product_id"]
                var el_valor = response.data["value"]
                console.log("el nombre es")
                console.log(nombre)
                var element = document.getElementById(nombre);
                element.value = el_valor;
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
    text-align: right;
  }
</style>

<div class="bootstrap-wrapper">
<div class="container" style="margin-top: 5%">

  <?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> 

<div class="col-lg-12 col-md-12 col-sm-12" style=" padding-top:20px;">
  

  <div class="row">

    <div id="paginador" style="float: left;" class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
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
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
      Cambiar Selección: 
      <select class="status" id="status_select" onChange="statusMasivo('mercadolibre', 'status', 'status_select')" >
          <option>Status</option>
          <option value="active" >Activa</option>
          <option value="paused" >Pausada</option>
          <option value="closed" >Finalizada</option> 
      </select>
      | 
      Exposición: 
      <select class="status" id="exposicion_ml_select" onChange="statusMasivo('exposicion_ml', 'Nivel de Exposición', 'exposicion_ml_select')" >
          <option>Exposición</option>
          <option value="free" >Gratis</option>
          <option value="clasica" >Clásica</option>
          <option value="premium" >Premium</option> 
      </select>
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
        <th>Categoría ML</th>
        <th>Precio Woo Commerce</th>
        <th style="max-width: 100px;">Precio Mercado Libre</th>
        <th>Inventario Woo Commerce</th>
        <th>Inventario Mercado Libre</th>
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
        <?php $categoria = get_post_meta($product->ID, "last_category_ml", $single = true ) ?>
        <td id="categoria_<?php echo $product->ID; ?>" class="category_field" ><?php echo (strlen($categoria) > 3 ? $categoria : ("<a href='?page=mkf-entries_categorizador&product_id={$product->ID}'>categorizar</a>")) ?></td>
        <td><?php echo get_post_meta($product->ID, "_regular_price", true) ?></td>
        <td style="max-width: 100px;"><input style="max-width: 80px;" type="text" value="<?php echo get_post_meta($product-> ID, "precio_ml", $single = true) ?>"></td>
        <td><?php echo get_post_meta($product->ID, "_stock", true) ?></td>
        <td><input style="max-width: 100px;" type="text" value="<?php echo get_post_meta($product-> ID, "inventario_ml", $single = true) ?>"></td>

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



<script>

function getCategory() {


  var categorias = $(".category_field").map(function() {
    var el_id = $(this).attr("id");
    if($(this).text().length > 1 && $(this).text() != "categorizar"){
      jQuery.ajax({
      type: "GET", 
        url: "https://api.mercadolibre.com/categories/"+ $(this).text(),
        async: false,
        success: function(data){
          var path_categoria = "";
          data.path_from_root.map(function(r){
            path_categoria = path_categoria + " > " + r.name;
          });
          $('#' + el_id).text("");
          path_categoria = path_categoria.substring(3);
          $('#' + el_id).append('<a href=?page=mkf-entries_categorizador&product_id=' + el_id.replace("categoria_", "") + ">" + path_categoria + "</a>");
        }
      });
    }
    
  });
}


jQuery(document).ready(function($){
  getCategory();
});
</script>




