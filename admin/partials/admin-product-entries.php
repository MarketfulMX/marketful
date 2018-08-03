<?php

$products = MKF_ProductEntry::GetInstance()->get_product_list();
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );


// https://developer.wordpress.org/plugins/javascript/enqueuing/
// add_action( 'admin_enqueue_scripts', 'my_enqueue' );
// function my_enqueue( $hook ) {
//     if( 'myplugin_settings.php' != $hook ) return;
    // wp_enqueue_script( 'ajax-script',
    //     plugins_url( '/js/myjquery.js', __FILE__ ),
    //     array( 'jquery' )
    // );
    // $title_nonce = wp_create_nonce( 'title_example' );
    // wp_localize_script( 'ajax-script', 'my_ajax_obj', array(
    //    // 'ajax_url' => admin_url( 'admin-ajax.php' ),
    //    'ajax_url' => admin_url( 'admin-ajax.php' ),
    //    'nonce'    => $title_nonce,
    // ) );
// }



// add_action( 'wp_ajax_my_ajax_handler', 'my_ajax_handler');
// //JSON
// function my_ajax_handler() {
//     // check_ajax_referer( 'title_example' );
//     // update_user_meta( get_current_user_id(), 'title_preference', $_POST['title'] );
//     // $args = array(
//     //     'tag' => $_POST['title'],
//     // );
//     // $the_query = new WP_Query( $args );
//     //     wp_send_json( $_POST['title'] . ' (' . $the_query->post_count . ') ' );
//   echo "hola";

//   wp_die(); // this is required to terminate immediately and return a proper response
// }


// add_action('wp_ajax_r_rate', 'r_rate_recipe')

?>


<?php
if (isset($_POST['my_theme_ajax_submit']))
    if ( wp_verify_nonce( $_POST['nonce'], 'my_theme_ajax_submit' ) )
        my_theme_ajax_submit(); 

function my_theme_ajax_submit() {
    // do something
    // some php code that fires from AJAX click of #fire
    wp_mail( 'user@domain.com', 'my_theme_ajax_submit() fired', time());

    update_user_meta( 1, "first_name", "adolfo" );
    update_post_meta( 27, 'titulo_ml', "gorro chido" );
    
    // wp_send_json_success([200, "hola"], 200) ;
    wp_die();
}
?>

<button id='fire'>Fire Something</button>

<script>
    jQuery('#fire').click(function(){
        jQuery.ajax({
            type: 'post',
            data: { 
                "my_theme_ajax_submit": "now",
                "nonce" : "<?php echo wp_create_nonce( 'my_theme_ajax_submit' ); ?>"
            },
            success: function(response) { 
              console.log(response)
                jQuery('#fire').text("Somthing Done!");
            },
            error: function(response) { 
              console.log(response)
                jQuery('#fire').text("...error!");
            },
        });
    });
</script>




<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    
  // $(".status").on("change", cambioStatus)
console.log(my_ajax_obj)
console.log(ajaxurl)
  function cambioStatus(){
    console.log("hola");    

    var this2 = this;                      //use in callback
    $.post(my_ajax_obj.ajax_url, {         //POST request
       _ajax_nonce: my_ajax_obj.nonce,     //nonce
        action: "my_ajax_handler",            //action
        title: this.value                  //data
    }, function(data) {                    //callback
      console.log(data)
        // this2.nextSibling.remove();        //remove current title
        // $(this2).after(data);              //insert server response
    });
  }     
    
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
        <th>Precio</th>
        <th>Cantidad</th>
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
            <select class="status" onChange="cambioStatus()">
            <?php $productObject = MKF_ProductEntry::GetInstance(); ?>
            <?php $all_mlmeta = $productObject->get_ml_metadata($product->ID) ?>
            <?php $select_value = $all_mlmeta[0]["data"][0]->status; ?>
            <?php switch ($select_value)
                    {
                        case "active":
                            echo "<option value='".$select_value."'selected>Activa</option>
                            <option value='paused'>Pausada</option>
                            <option value='closed'>Finalizada</option>";
                            break;
                        case "paused":
                            echo "<option value='".$select_value."'selected>Pausada</option>
                            <option value='active'>Activa</option>
                            <option value='closed'>Finalizada</option>";
                            break;
                        case "closed":
                            echo "<option value='".$select_value."'selected>Finalizada</option><option value='active'>Activa</option>
                            <option value='paused'>Pausada</option>";
                            break;
                        default :
                            echo "  <option value=''> </option>
                                    <option value='active'>Activa</option>
                                    <option value='paused'>Pausada</option>
                                    <option value='closed'>Finalizada</option>";
                            break;
                    }?>
            </select>
        </td>
        <td>
            <select id="exposicion">
            <?php $select_value = $all_mlmeta[0]["data"][0]->exposicion; ?>
            <?php switch ($select_value)
                    {
                        case "free":
                            echo "<option value='".$select_value."'selected>Gratis</option>
                            <option value='clasica'>Clasica</option>
                            <option value='premium'>Premium</option>";
                            break;
                        case "clasica":
                            echo "<option value='".$select_value."'selected>Clasica</option>
                            <option value='free'>Gratis</option>
                            <option value='premium'>Premium</option>";
                            break;
                        case "premium":
                            echo "<option value='".$select_value."'selected>Premium</option><option value='free'>Gratis</option>
                            <option value='clasica'>Clasica</option>";
                            break;
                        default :
                            echo "  <option value=''> </option>
                                    <option value='free'>Gratis</option>
                                    <option value='clasica'>Clasica</option>
                                    <option value='premium'>Premium</option>";
                            break;
                    }?>
            </select>
            <!--select id="Exposicion">
                <option value=""> </option>
                <option value="Free">Gratis</option>
                <option value="clasica">Clasica</option>
                <option value="premium">Premium</option>
            </select-->
        </td>
        <td><?php echo $product->price; ?></td>
        <td><?php echo $product->stock; ?></td>
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



