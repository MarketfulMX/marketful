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
error_reporting(E_ERROR | E_WARNING | E_PARSE); // Suprime errores de prueba
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
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
<div class="bootstrap-wrapper">


<style>
  .filtro
    {
        text-align: right;
    }
    
    .bootstrap-wrapper
    {
        background-color:white;
        font-family: sans-serif;
    }
        .imagen 
        {
           margin-left: 20px; margin-top: 20px; margin-bottom: 20px; 
        }

        .opciones
        {
            display: inline-grid;grid-template-areas: "izq cen1 der1 ";grid-gap: 10px 60px;justify-items: stretch;justify-content: space-between;
            text-align: center; 
        }

            .a
            {
                grid-area: izq;
                border-color: #7E7F6D; border-style: solid; border-width: 1px; border-radius: 3px;
                background-color: #E2E5C4;
                width: 45px; height: 25px;
                color:#7E7F6D;text-decoration: none;text-align: center
                cursor: default;
            }
                .a a
                {
                    text-decoration: none; color:#7E7F6D;   
                }
                #ant:hover
                {
                    color: #3F4036; 
                    background-color: #BCBFA3;
                }
                #sig:hover
                {
                    color: #3F4036; 
                    background-color: #BCBFA3;
                }
            .b
            {
                grid-area: cen1;
                margin-left: 5px;
                border-color: #7E7F6D; border-style: solid; border-width: 1px; border-radius: 3px;
                background-color: #E2E5C4;
                height: 25px;width: auto;
                padding-left: 10px; padding-right: 10px; padding-bottom: 2px; 
                cursor: default;
            }
                .b select
                {
                    background-color: #E2E5C4; 
                }
                    .b:hover
                    {
                        
                    }
            .c
            {
                display:inline; grid-area: der1; 
                margin-right: -1300px;
            }
                #keyword_input
                {
                    margin-right: 2 px;
                    width: 240px; height: 25px;
                    border-radius: 3px 0px 0px 3px; border-color: #7E7F6D;
                }
                    #keyword_input:hover
                    {
                        border-color: #7E7F6D;
                    }
                    #keyword_input:active
                    {
                        border-color: #3F4036;
                    }
                #boton_buscar
                {
                    background-color:#E2E5C4; height: 25px; width: 48px; 
                    border-style: solid; border-color: #7E7F6D; border-radius: 0px 3px 3px 0px;
                    margin-left: -8px; margin-top: -8px;
                }
                    #boton_buscar:hover
                    {
                        border-color: #7E7F6D;
                        background-color: #BCBFA3;
                    }
                    #boton_buscar:active
                    {
                        border-color: #3F4036;
                        background-color: #BCBFA3;
                    }
                .c i
                {
                    color: #7E7F6D; font-size: 16px; vertical-align: top;
                }

        #tabla
        {
            border-color: black; border-style: solid; border-width: 3px;border: none;
            width: 100%;
        }
            #tabla thead
            {
                border-color: black; border-style: solid; border-width: 3px;border: none;
                font-family: sans-serif;
            }
            #tabla tbody
            {
                border-color: black; border-style: solid; border-width: 3px;border: none;
                font-family: sans-serif;
            }
    .boton #boton_buscar
    {
        background-color:red; height: 100px; width: 100px; border:none;
    }
    .input 
    {
        height: 25px; width: 60px; background-color:#fff;border: none;
    }
        td .input
        {
            height: 25px; widht:120px; background-color: #fff;border-color: black;
        }
    .status
    {
        height: 25px; width: 65px; background-color: red;border: none;
    }
        .expo
        {
            height: 25px; width: 65px; background-color: red;border: none;
        }
        .tipo_envio
        {
            height: 25px; background-color: red;border: none;
        }
    td
    {
        max-width: 100px;
    }
    th
    {
        max-width: 100px;
    }
    
</style>

<div class="container" style="">

  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>

<div class="opciones" style="" id="">
  

  <div class="row">

    <div id=""  class="a">
      <?php 
      if($pagina > 1){
        ?>
        <a class="" id="ant" href="?page=mkf-product-entries&pagina=<?php echo ($pagina - 1) ?>" ><i class="fas fa-chevron-left"></i></a> 
      <?php
      }else{
      ?>
        <i id="" class="fas fa-chevron-left"></i> 
      <?php
      }
      ?>
      <a class="" id="sig" href="?page=mkf-product-entries&pagina=<?php echo $pagina + 1 ?>"><i class="fas fa-chevron-right"></i></a>
    </div>
        <div class="b" id="">
          <!--Cambiar Status: -->
          <select style="background-color: #E2E5C4;font-size: 12px;width: 80px; padding: 0; height: 20px; border:none;"class="custom-select" id="status_select" onChange="statusMasivo('mercadolibre', 'status', 'status_select')" >
              <option>Status</option>
              <option value="active" >Activa</option>
              <option value="paused" >Pausada</option>
              <option value="closed" >Finalizada</option> 
          </select>
         <!--   | 
          Exposición: -->
          <select style="background-color: #E2E5C4;font-size: 12px;width: 90px; padding: 0; height: 20px; border:none;"class="custom-select" id="exposicion_ml_select" onChange="statusMasivo('exposicion_ml', 'Nivel de Exposición', 'exposicion_ml_select')" >
              <option>Exposición</option>
              <option  value="free" >Gratis</option>
              <option value="clasica" >Clásica</option>
              <option value="premium" >Premium</option> 
          </select>
        </div>
    </div>
    <div class="c" id="">
      <label> 
        <input type="text" placeholder="Titulo" id="keyword_input">
      </label>
      <button id="boton_buscar" onClick="buscarResultados()" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
    </div>
  </div>
</div>



  <table id="tabla" class="table stripe tableMK" >
    <thead class="thead-light">
      <tr>
        <th class="dt_check"><input type="checkbox" class="ids"   id="checkbox_master" onClick="selectTodos()" /> </th>
        <th scope="col" style="min-width: 140px">SKU </th>
        <th scope="col" style="min-width: 140px">Título</th>
        <th scope="col" style="min-width: 138px">Status</th>
        <th scope="col" style="min-width: 140px">Exposición</th>
        <th scope="col" style="min-width: 140px">Categoría ML</th>
        <th scope="col" style="min-width: 140px">Precio Woo Commerce</th>
        <th scope="col" style="min-width: 140px">Precio Mercado Libre</th>
        <th scope="col" style="min-width: 140px">Inventario Woo Commerce</th>
        <th scope="col" style="min-width: 140px">Inventario Mercado Libre</th>
        <th scope="col" style="min-width: 140px">Tipo de Envío</th>
        <th scope="col" style="min-width: 165px">Ver Publicacion</th>
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
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones">
              <select style="font-size: 12px;width: 80px; padding: 0; height: 25px;"class="custom-select" id="mercadolibre_<?php echo $product->ID;  ?>" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'mercadolibre')" id="mercadolibre_<?php echo $product->ID;  ?>" >
                <?php $productObject = MKF_ProductEntry::GetInstance(); ?>
                <?php $all_mlmeta = $productObject->get_ml_metadata($product->ID) ?>
                <?php $select_value = $all_mlmeta[0]["data"][0]->status; ?>
                <option>...</option>
                <option value="active" <?php echo ($select_value=="active")?'selected':''; ?>>Activa</option>
                <option value="paused" <?php echo ($select_value=="paused")?'selected':''; ?>>Pausada</option>
                <option value="closed" <?php echo ($select_value=="closed")?'selected':''; ?> >Finalizada</option> 
              </select>
            </div>
            
        </td>
        <td>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones">
              <select style="font-size: 12px;width: 90px; padding: 0; height: 25px;"class="custom-select" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'exposicion_ml')" id="exposicion_ml_<?php echo $product->ID;  ?>">
                <?php $select_value = $all_mlmeta[0]["data"][0]->exposicion; ?>
                <option>...</option>
                <option value="free" <?php echo ($select_value=="free")?'selected':''; ?>>Gratis</option>
                <option value="clasica" <?php echo ($select_value=="clasica")?'selected':''; ?>>Clasica</option>
                <option value="premium" <?php echo ($select_value=="premium")?'selected':''; ?> >Premium</option> 
              </select>
            </div>
            
        </td>
        <?php $categoria = get_post_meta($product->ID, "last_category_ml", $single = true ) ?>
        <td id="categoria_<?php echo $product->ID; ?>" class="category_field" ><?php echo (strlen($categoria) > 3 ? $categoria : ("<a href='?page=mkf-entries_categorizador&product_id={$product->ID}'>categorizar</a>")) ?></td>
        <td><?php echo get_post_meta($product->ID, "_regular_price", true) ?></td>
        <td ><input style="width: 125px" onchange="cambioStatus('<?php echo $product->ID ?>', 'precio_ml')" class="input" type="text" value="<?php echo get_post_meta($product-> ID, "precio_ml", $single = true) ?>" id="precio_ml_<?php echo $product->ID; ?>"></td>
        <td><?php echo get_post_meta($product->ID, "_stock", true) ?></td>
        <td ><input style="width: 125px" onchange="cambioStatus('<?php echo $product->ID ?>', 'inventario_ml')" class="input" type="text" value="<?php echo get_post_meta($product-> ID, "inventario_ml", $single = true) ?>" id="inventario_ml_<?php echo $product->ID; ?>"></td>
        <?php $link_publicacion = get_post_meta($product->ID, "link_publicacion", $single = true ) ?>
        <td>
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones">
              <select style="font-size: 12px;width: 140px; padding: 0; height: 25px;"class="custom-select" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'metodo_envio_ml')" id="metodo_envio_ml_<?php echo $product->ID;  ?>">
                <?php $select_value = get_post_meta($product->ID, "metodo_envio_ml", true) ?>
                <option>...</option>
                <option value="me_g" <?php echo ($select_value=="me_g")?'selected':''; ?>>Mercado Envío Gratis</option>
                <option value="me_c" <?php echo ($select_value=="me_c")?'selected':''; ?>>Mercado Envío Pago</option>
                <option value="custom" <?php echo ($select_value=="custom")?'selected':''; ?> >Personalizado</option> 
              </select>
            </div>  
        </td>
        <td><?php echo (strlen($link_publicacion) > 3 ? "<a href='{$link_publicacion}' target='_blank' class='btn btn-primary btn-sm'><i class='fa fa-search' aria-hidden='true'></i> Ver Publicación</a>" : "no hay ") ?>
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




