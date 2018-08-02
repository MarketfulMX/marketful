<?php

$products = MKF_ProductEntry::GetInstance()->get_product_list();
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

?>

<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
<script>
    
    $(".status").on("change", hola)
    
    
    
    function hola(){
        console.log("hola");
        alert("HOLA HOLA");
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
            <select class="status" onChange="hola()">
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



