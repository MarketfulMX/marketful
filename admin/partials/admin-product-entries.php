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

/**
 * @Onboarding
 * Recibimos el valor de Onb en caso de ser 1 se activa la vista "onboarding"
 */
$onb = $_GET['onb'];

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


<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<!-- FUNCIONES Y SCRIPTS JS estan dentro de admin/js/admin-product-entries.js -->
<!-- ESTILOS ESTAN DENTRO DE admin/css/admin-product-entries.css -->


<div class="container" style="max-width: 95%; overflow: hidden;" >
  <div class="loader_onb">  
  </div>
<div class="bootstrap-wrapper">
  <!-- <div style="background-color: red"><?php echo ($_GET['page'] == 'mkf-product-entries')?'es':$_GET['page'];?></div> -->
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
  <div class="row"> 
    <div id=""  class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
      <div style="background-color: #E2E5C4; width: 45px; text-align: center; float: left;" class="caja-de-botones">
        <?php 
        if($pagina > 1){
          ?>
          <a class="link-flecha" style="color:#7E7F6D;" id="ant" href="?page=mkf-product-entries&pagina=<?php echo ($pagina - 1) ?>" ><i class="fas fa-chevron-left"></i></a> 
        <?php
        }else{
        ?>
          <i id="ant" style="color:#7E7F6D;" class="fas fa-chevron-left"></i> 
        <?php
        }
        ?>
        <a class="link-flecha" style="color:#7E7F6D;" id="sig" href="?page=mkf-product-entries&pagina=<?php echo $pagina + 1 ?>"><i class="fas fa-chevron-right"></i></a>
      </div>
      <!--Cambiar Status: -->
      <select style=""class="select-arriba" id="status_select" onChange="statusMasivo('mercadolibre', 'status', 'status_select')" >
          <option>Status</option>
          <option value="active" >Activa</option>
          <option value="paused" >Pausada</option>
          <option value="closed" >Finalizada</option> 
      </select>
     <!--   | 
      Exposición: -->
      <select style=""class="select-arriba" id="exposicion_ml_select" onChange="statusMasivo('exposicion_ml', 'Nivel de Exposición', 'exposicion_ml_select')" >
          <option>Exposicion</option>
          <option  value="free" >Gratis</option>
          <option value="clasica" >Clasica</option>
          <option value="premium" >Premium</option> 
      </select>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" id="dg">
        <a href="?page=mkf-descripcion-footer"><button id="boton_dg"> Agregar descripcion general</button></a>
    </div>
    <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
        <h8 id="cambios_guardados"></h8>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12" >
      <button id="boton_buscar" onClick="buscarResultados()" class="btn btn-primary btn-sm"><i class="fas fa-search"></i></button>
      <label style="float: right;"> 
        <input type="text" placeholder="Titulo" id="keyword_input" onkeypress="enterBuscar(event)">
      </label>
    </div>
  </div>

  <style>
  #cambios_guardados{
    font-size: 10px;
  }
  </style>


<div id="registros" style="max-width: 100%; overflow-x: scroll;" >
  <table id="tabla" class="table stripe tableMK" style="overflow: auto;">
    <thead>
      <tr>
        <th class="dt_check"><input type="checkbox" class="ids"   id="checkbox_master" onClick="selectTodos()" /> </th>
        <th style="min-width: 100px">Subir cambios a Mercado Libre</th>
        <th style="min-width: 50px">SKU </th>
        <th style="min-width: 150px">Titulo en MercadoLibre <br><mark style="color:#873B3A;">El titulo no debe tener mas de 60 caracteres.</mark></th>
        <th style="min-width: 50px">Status</th>
        <th style="min-width: 50px">Exposici&oacute;n</th>
        <th style="min-width: 130px">Categoria ML</th>
        <th style="min-width: 50px">Precio Woo Commerce</th>
        <th style="min-width: 50px">Precio Mercado Libre</th>
        <th style="min-width: 50px">Inventario Woo Commerce</th>
        <th style="min-width: 50px">Inventario Mercado Libre</th>
        <th style="min-width: 150px">Tipo de Envio</th>
        <th style="min-width: 110px">Ver Publicacion</th>
        <th style="min-width: 60px">Ultima Actualizaualizaci&oacute;n</th>
        <!-- <th style="min-width: 215px;">Acción</th> -->
      </tr>
    </thead>
    <tbody id="tbody_productos">
    <!-- Creamos un foreach para recorrer todos los valores -->
    <?php
      foreach ($products[0]["data"] as $key => $product) :
    ?>
      <tr <?php if($onb == 1){ echo 'id="tr_onb"'; } // onboarding script, dont erase ?>>
        <!-- Modal para actualizar información -->
          <div class="modal fade" id="modal_ad_<?php echo $product->ID; ?>" onClick="resize_window();"role="alert">
            <div class="modal-dialog">
              <div class="modal-content" >
                <div class="modal-header" onclick="resize_window();">
                  <h4 class="modal-title">Actualiza la informacion del producto</h4>
                  <button type="button" class="close" data-dismiss="modal" onclick="resize_window();">&times;</button>
                </div>
                <div class="modal-body" onclick="resize_window();">
                  <p>Para poder asignar el tipo de status, primero debes actualizar la categoria, el tipo de exposicion y el tipo de envio en MercadoLibre. Deseas actualizarlo ahora?</p>
                </div>
                <div class="modal-footer">
                  <button class="boton_redirige_cat_<?php echo $product->ID; ?> btn btn-default" id=""> Actualizar </button>
                  <button type="button" class="btn btn-default" data-dismiss="modal"  onclick="resize_window();">Cerrar</button>
                </div>
              </div>
            </div>
          </div>
          
        <td class="dt_check" <?php if($onb == 1){echo 'onload="onboarding_nn('.$product->ID.');"';} // Modifica el tamaño del nombre del titulo_ml para el onboarding?>>
          <input type="checkbox" class="ids" name="checkboxes" id="checkbox_<?php echo $product->ID; ?>" />  </td>
          <?php ?>
          <?php $productObject = MKF_ProductEntry::GetInstance(); ?>
          <?php $all_mlmeta = $productObject->get_ml_metadata($product->ID) ?>
          <?php $categoria = get_post_meta($product->ID, "last_category_ml", $single = true ) ?>
          <?php $exposicion = $all_mlmeta[0]["data"][0]->exposicion; ?>
          <?php $envio_ml = $select_value = get_post_meta($product->ID, "metodo_envio_ml", true)?>
          <?php if($categoria == "" || $exposicion == "" || $envio_ml == ""){$disabled=true;}else{$disabled= false;} ?>
        <td><button <?php echo ($disabled == true)?'disabled':''; ?> style=""id="subir_ml_<?php echo $product->ID;?>" class="boton_dg subir" onclick="subir_cambios(<?php echo $product->ID; ?>)"> Subir cambios</button></td>
        <td><?php echo $product->sku; ?></td>
        <td style="min-width: 150px">
            <?php 
              echo '<b>'.$product->title.'</b><br>';
                // if(strlen($product->title) > 60)
                // {
                    echo '<input type="text" class="input titulo_onb" style="width: 200px;" id="titulo_ml_'.$product->ID.'" maxlength="60" placeholder="Nuevo titulo solo para Mercadolibre" onkeypress="cambioStatus('.$product->ID.', \'titulo_ml\')">';
                // }
          
            ?>
          </td>
        <!--
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
          <td>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones" >              
              <select style="font-size: 10px;width: 80px; height: 25px;"class="custom-select pub_status" id="mercadolibre_<?php echo $product->ID;  ?>"  onChange="cambioStatus(<?php echo $product->ID;  ?>, 'mercadolibre');" >
                
                <?php $select_value = $all_mlmeta[0]["data"][0]->status; ?>
                <option value="">...</option>
                <option value="active" <?php echo ($select_value=="active")?'selected':''; ?>>Activa</option>
                <option value="paused" <?php echo ($select_value=="paused")?'selected':''; ?>>Pausada</option>
                <option value="closed" <?php echo ($select_value=="closed")?'selected':''; ?>>Finalizada</option> 
              </select>
            </div>
        </td>
        <td>
            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones">
              <select style="font-size: 10px;width: 80px; height: 25px;"class="custom-select expo_ml" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'exposicion_ml'); check_status(<?php echo $product->ID; ?>); " id="exposicion_ml_<?php echo $product->ID;  ?>">
                <?php $select_value = $all_mlmeta[0]["data"][0]->exposicion; ?>
                <option value="">...</option>
                <option value="free" <?php echo ($select_value=="free")?'selected':''; ?>>Gratis</option>
                <option value="clasica" <?php echo ($select_value=="clasica")?'selected':''; ?>>Clasica</option>
                <option value="premium" <?php echo ($select_value=="premium")?'selected':''; ?> >Premium</option> 
              </select>
            </div>
            
        </td>
        
        <td style="min-width: 130px;" id="categoria_<?php echo $product->ID; ?>" class="category_field" ><?php 
            if(!$onb)
            {
              echo (strlen($categoria) > 3 ? $categoria : ("<a href='?page=mkf-entries_categorizador&product_id={$product->ID}&pagina={$pagina}&keyword={$keyword}'>categorizar</a>"));
            }
            elseif($onb == 1) 
            {
              echo "<a href='?page=mkf-entries_categorizador&product_id={$product->ID}&pagina={$pagina}&keyword={$keyword}&onb=1' onclick='show_spinner()'>categorizar</a>";
            }
            elseif($onb == 2)
            {
              echo "<a href='#'>Categoria del producto</a>";
            }
          ?></td>
        <td style=""><?php echo get_post_meta($product->ID, "_regular_price", true) ?></td>
        <td><input onchange="cambioStatus('<?php echo $product->ID ?>', 'precio_ml')" class="input" type="text" value="<?php echo get_post_meta($product-> ID, "precio_ml", $single = true) ?>" id="precio_ml_<?php echo $product->ID; ?>"></td>
        <td><?php echo get_post_meta($product->ID, "_stock", true) ?></td>
            <td ><input  onchange="cambioStatus('<?php echo $product->ID ?>', 'inventario_ml')" class="input" type="text" value="<?php echo get_post_meta($product-> ID, "inventario_ml", $single = true) ?>" id="inventario_ml_<?php echo $product->ID; ?>"></td>
            <?php $link_publicacion = get_post_meta($product->ID, "link_publicacion", $single = true ) ?>
        <td style="min-width: 150px;">
           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" id="selecciones">
              <select style="font-size: 10px;width: 140px; padding: 0; height: 25px;"class="custom-select tipo_envi" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'metodo_envio_ml'); check_status(<?php echo $product->ID.');';?>" id="metodo_envio_ml_<?php echo $product->ID;?>">
                <?php $select_value = get_post_meta($product->ID, "metodo_envio_ml", true) ?>
                <option value="">...</option>
                <option value="me_g" <?php echo ($select_value=="me_g")?'selected':''; ?>>Mercado Envio Gratis</option>
                <option value="me_c" <?php echo ($select_value=="me_c")?'selected':''; ?>>Mercado Envio Pago</option>
                <option value="custom" <?php echo ($select_value=="custom")?'selected':''; ?> >Personalizado</option> 
              </select>
            </div>  
        </td>
        <td ><?php echo (strlen($link_publicacion) > 3 ? "<a href='{$link_publicacion}' target='_blank' class='btn btn-primary btn-sm'><i class='fa fa-search' aria-hidden='true'></i> Ver Publicación</a>" : "no hay ") ?>
          </td>
        <td><?php echo get_post_meta($product->ID, "error_ml", true);?></td>
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

<!-- On boarding div, dont erase -->
<div class="onb_flotante" <?php if($onb == 2){ echo 'onload="onboarding_4()"'; } ?>>    
</div>

<script>
    /**
     * @Función JQuery
     */
    jQuery(document).ready(function($){
      getCategory(<?php echo $pagina; ?>,'<?php echo $keyword; ?>');
      <?php 
      // En caso de que onb tenga valor de uno. Y se este ejecutando el onboarding
      if($onb == 1)
      {
          echo 'onboarding_1(); console.log("entroa ready");';     
      } 
      ?>
    });


    <?php if($onb==1 || $onb==2){ ?>


        jQuery(function()
        {
            $('.onb_flotante').trigger('onload');
            $('.dt_check').trigger('onload');
        });

    <?php } ?>


</script>


