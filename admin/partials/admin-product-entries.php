<?php

$products = MKF_ProductEntry::GetInstance()->get_product_list();
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

?>
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
        <td><?php echo $product->status; ?></td>
        <td><?php echo $product->exposicion; ?></td>
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
