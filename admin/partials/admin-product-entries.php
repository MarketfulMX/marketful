<?php

$products = MKF_ProductEntry::GetInstance()->get_product_list();
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );


?>


<?php
if (isset($_POST['my_theme_ajax_submit']))
    if ( wp_verify_nonce( $_POST['nonce'], 'my_theme_ajax_submit' ) )
        my_theme_ajax_submit(); 

function my_theme_ajax_submit() {
    // do something
    // some php code that fires from AJAX click of #fire
    $producto_id = $_POST['product_id'];
    $value = $_POST['value'];
    $key = $_POST['key'];
    ### aqui fue 
    // update_user_meta( 1, "first_name", nombre );
    update_post_meta( $producto_id, $key, $value );
    // wp_send_json_success([200, "hola"], 200) ; NO SIRVE
    wp_die();
}
?>

<!-- <button id='fire'>Fire Something</button> -->

<script>
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

  <?php echo "<img src='{$imgSrc}' > "; ?>

  <table id="services_list" class="table stripe tableMK" style="width:100%">
    <thead>
      <tr>
        <th class="dt_check"><input type="checkbox" class="ids" name="ids[]"  /> </th>
        <th>SKU</th>
        <th>Título</th>
        <th>Status</th>
        <th>Exposición</th>
 <!--        <th>Precio</th>
        <th>Precio ML</th> -->
        <!-- <th>Cantidad</th> -->
        <!-- <th style="min-width: 215px;">Acción</th> -->
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
            <select class="status" onChange="cambioStatus(<?php echo $product->ID;  ?>, 'status_ml')" id="status_ml_<?php echo $product->ID;  ?>">
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
       <!--  <td><?php echo $product->price; ?></td>
        <td><?php echo $product->precio_ml; ?></td> -->
        <!-- <td><?php echo $product->stock; ?></td> -->
        <!-- <td>
          <a href="?page=mkf-product-edit&product_id=<?php echo $product->ID; ?>" class="btn btn-success"><i class="fa fa-edit" aria-hidden="true"></i> Edit</a>
          <a href="<?php echo $product->url; ?>" target="_blank" class="btn btn-primary"><i class="fa fa-search" aria-hidden="true"></i> Preview</a>
        </td> -->
      </tr>
    <?php endforeach; //Fin Iteracion ?>
    </tbody>
  </table>
</div>
</div>



