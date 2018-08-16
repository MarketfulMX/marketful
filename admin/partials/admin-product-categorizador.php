<?php
/*
 * Archivo: admin-product-categorizador.php
 * Ultima edición : 16 de agosto de 2018
 *
 * @autor: Adolfo Yanes (adolfo@marketful.mx)
 * @autor: Administrador de Proyecto: Mauricio Alcala (mauricio@marketful.mx)
 * @versión: 1.02
 * 
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 */

/*
 * Descripción General: 
 * Categorizador de productos, usando el arbol de categorias de mercado libre.
 */

/**
 * @script PHP
 *
 * - Tomamos el valor del $product_id que vamos a utilizar
 *
 * 
 */
$product_id = $_GET['product_id'];
//$product_id = $_REQUEST['product_id'];

/**
 * @scripts PHP
 * 
 * Tomamos los datos que requermimos utilizando la función 
 * get_post_meta(@producto, @categoria, @solo un dato (opcional))
 */
$productObject = MKF_ProductEntry::GetInstance();
$categories = $productObject->get_ml_categories();
$titulo = get_post_meta($product_id, "titulo_ml", $single = true );
$categoria_ultima = get_post_meta($product_id, "last_category_ml");
$categoria_arbol = get_post_meta($product_id, "categories_ml");
$all_mlmeta = $productObject->get_ml_metadata($product_id)[0]['data'];
$ml_categories = $all_mlmeta[0]->categories;
if (!empty($ml_categories)) 
{
    $ml_obj_cat = json_decode($ml_categories, true);
}


?>
<script>
    var api_ml_url = "";
    
    function getCategory(categ, tree, currentLevel) 
    {
        if (tree == "father" && jQuery("#category_aux").val() != categ.value) 
        {
          jQuery("#category_aux").val(categ.value);
          jQuery(".subcat").remove();
        } 
        else 
        {
          jQuery.each(jQuery('.syi-category-tree__column.subcat'), function(index, item) 
          {
            if (parseInt(index) >= parseInt(currentLevel))
            {
              jQuery(item).remove();
            }
          });
        }

        var numItems = jQuery('.syi-category-tree__column').length-1;
        jQuery.ajax({
            type: "GET",
            url: "https://api.mercadolibre.com/categories/"+categ.value,
            success: function(data){
                if (data.children_categories.length>0)
                {
                    Ndiv = '<div class="ui-box syi-category-tree__column cat subcat">';
                    Ndiv += '<div data-index="1" class="syi-category-tree__container ">';
                    Ndiv += '<select class="syi-category-tree__selector selected" id="level_'+numItems+'"  title="Elige una categoría" size="20" onChange="getCategory(this, \'child\', ' + numItems +');" name="ml_categories[child][]">';
                    jQuery.each(data.children_categories,function(i,obj)
                    {
                      Ndiv +='<option class="syi-category-tree__option" value='+obj.id+'>'+obj.name+'</option>';
                    });
                    Ndiv += '</select>';
                    Ndiv += '</div>';
                    Ndiv += '</div>';
                    jQuery(".syi-category-tree__column:last").after(Ndiv);
                    jQuery('#demo').scrollLeft(2000);
                }
                else
                {
                    add_submit_button();
                    jQuery('#demo').scrollLeft(2000);
                }
            }
        });
    }
    <?php if (is_array($ml_obj_cat)): ?>
    <?php foreach ($ml_obj_cat as $key => $category) : ?>
      <?php if ($key == "father"): ?>
        jQuery("#level_0").val("<?php echo htmlentities($category[0]); ?>");
        api_ml_url = "https://api.mercadolibre.com/categories/" + "<?php echo $category[0]; ?>";
        add_categories_object(0, api_ml_url, "<?php echo $category[0]; ?>", true);
      <?php elseif ($key == "child"): ?>
        <?php foreach ($category as $keyu => $subcat) : ?>
          <?php if ( intval($keyu) < count($category)): ?>
            api_ml_url = "https://api.mercadolibre.com/categories/" + "<?php echo $subcat; ?>";
            bandera = "<?php echo ((count($category) -1) > intval($keyu)) ? 'true' : 'false'; ?>";
            add_categories_object(<?php echo intval($keyu) + 1; ?>, api_ml_url, "<?php echo $subcat; ?>", (bandera == 'true'));
          <?php endif; ?>
        <?php endforeach; ?>
      <?php endif; ?>
    <?php endforeach; ?>
        add_submit_button();
    <?php endif; ?>
    function add_categories_object(level, ml_url, cat_name, flag_to_add)
    {
      var myLevel = parseInt(level) + 1;
      var myName  = cat_name;

      jQuery.ajax({
        type: "GET",
        url: ml_url,
        async: false,
        success: function(data) {

          if (flag_to_add)
          {
            var Ndiv = '<div class="ui-box syi-category-tree__column cat subcat">';
            Ndiv += '<div data-index="1" class="syi-category-tree__container ">';
            Ndiv += '<select class="syi-category-tree__selector selected" id="level_'+ myLevel +'"  title="Elige una categoría" size="20" onChange="getCategory(this, \'child\', ' + myLevel + ');" name="ml_categories[child][]">';

            jQuery.each(data.children_categories,function(i,obj)
            {
              Ndiv +='<option class="syi-category-tree__option" value='+obj.id+'>'+obj.name+'</option>';
            });

            Ndiv += '</select>';
            Ndiv += '</div>';
            Ndiv += '</div>';
            jQuery(".syi-category-tree__column:last").after(Ndiv);
          }

          if (myLevel > 1)
          {
            jQuery("#level_" + (myLevel - 1)).val(myName);
          }

         }
        });
    }
    
    function add_submit_button()
    {

    var Ndiv = '<div class="ui-box syi-category-tree__column subcat">';
        Ndiv += '<div class="syi-category-tree__box-msg ">';
        Ndiv += '<svg class="ui-icon " xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 52 52">';
        Ndiv += '<path fill="#468847" d="M42.9910714,20.2901786 C42.9910714,19.6651754 42.7901806,19.1517877 42.3883929,18.75 L39.3415179,15.7366071 C38.9174086,15.3124979 38.4151815,15.1004464 37.8348214,15.1004464 C37.2544614,15.1004464 36.7522343,15.3124979 36.328125,15.7366071 L22.6674107,29.3638393 L15.1004464,21.796875 C14.6763372,21.3727657 14.17411,21.1607143 13.59375,21.1607143 C13.01339,21.1607143 12.5111628,21.3727657 12.0870536,21.796875 L9.04017857,24.8102679 C8.63839085,25.2120556 8.4375,25.7254433 8.4375,26.3504464 C8.4375,26.953128 8.63839085,27.4553551 9.04017857,27.8571429 L21.1607143,39.9776786 C21.5848235,40.4017878 22.0870507,40.6138393 22.6674107,40.6138393 C23.2700923,40.6138393 23.78348,40.4017878 24.2075893,39.9776786 L42.3883929,21.796875 C42.7901806,21.3950873 42.9910714,20.8928602 42.9910714,20.2901786 L42.9910714,20.2901786 Z M51.4285714,25.7142857 C51.4285714,30.3794876 50.2790294,34.6818999 47.9799107,38.6216518 C45.6807921,42.5614036 42.5614036,45.6807921 38.6216518,47.9799107 C34.6818999,50.2790294 30.3794876,51.4285714 25.7142857,51.4285714 C21.0490838,51.4285714 16.7466715,50.2790294 12.8069196,47.9799107 C8.8671678,45.6807921 5.74777935,42.5614036 3.44866071,38.6216518 C1.14954208,34.6818999 0,30.3794876 0,25.7142857 C0,21.0490838 1.14954208,16.7466715 3.44866071,12.8069196 C5.74777935,8.8671678 8.8671678,5.74777935 12.8069196,3.44866071 C16.7466715,1.14954208 21.0490838,0 25.7142857,0 C30.3794876,0 34.6818999,1.14954208 38.6216518,3.44866071 C42.5614036,5.74777935 45.6807921,8.8671678 47.9799107,12.8069196 C50.2790294,16.7466715 51.4285714,21.0490838 51.4285714,25.7142857 L51.4285714,25.7142857 Z"></path>';
        Ndiv += '</svg><span class="ui-box-msg__title">¡Listo!</span>';
        Ndiv += '<div class="syi-action-button">';
        Ndiv += '<input type="submit" value="Continuar" class="syi-action-button__primary ui-btn ">';
        Ndiv += '</div>';
        Ndiv += '</div>';
        Ndiv += '</div>';
        jQuery(".syi-category-tree__column:last").after(Ndiv);
    }
    
    
</script>
<style>
</style>
<div>
    <h4> Categorizador de productos </h4>
    <h2><?php echo $titulo; ?> </h2>
    <h5><?php echo $categoria_ultima[0]; ?> </h5>
    <h5><?php //echo $categoria_arbol[0]; ?> </h5>
</div>
<h2 class="margenCat">Categoría</h2>
      <hr>
      <div class="syi-category-tree">
          <div class="ui-box syi-category-tree__column syi-category-tree__column--fixed syi-category-tree__column--selected syi-hub-std u--arrange-fit" data-reactid="22">
              <h2 class="category-tree__title" >Productos y otros</h2>
              <span class="syi-category-tree__image syi-category-tree__image--std" ></span>
              <div class="syi-gradient"></div>
          </div>
          <div class="syi-category-tree__wrapper u--arrange-fill" id="demo" >
              <div class="syi-category-tree__container syi-category-tree__container--3 ">
                  <div class="ui-box syi-category-tree__column" >
                      <div data-index="0" class="syi-category-tree__container " >
                          <select class="syi-category-tree__selector selected" id="level_0" required="" title="Elige una categoría" size="20" onChange="getCategory(this, 'father', 0);" name="ml_categories[father][]">
                              <?php foreach (json_decode($categories->getBody(), true) as $key => $category) : ?>
                                      <option class="syi-category-tree__option" value="<?php echo $category['id']; ?>">
                                        <?php echo $category['name']; ?>
                                      </option>
                              <?php endforeach; ?>
                          </select>
                      </div>
                  </div>
              </div>
          </div>
      </div>