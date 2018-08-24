<?php
/*
 * Archivo: admin-description-footer.php
 * Ultima edición : 21 de agosto de 2018
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
 *
 *
 */
$imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

// buscar el producto que guarda la descripcion comun
if(function_exists(wc_get_productssss)){
    $products = wc_get_products( array(
        'title' => 'marketful_descripcion_comun',
    ) );
}else{
    $products = MKF_ProductEntry::GetInstance()->get_product_list(1, 0, "marketful_descripcion_comun");
}

?>


<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">



<script>
    /**
     * @Función JQuery
     */
    // jQuery(document).ready(function($){
    
    // });
    


</script>




<style>
    #footer_texto_superior
    {
        max-width: 660px;
        margin-top: 20px;
        display: inline-block;
        padding: 5px;
        border-width: 1px 0px 1px 0px;
        border-color: #D9D9D9;
        border-style: solid;
    }
    .footer_contenido
    {
        text-align: center;
        font-family: sans-serif;
    }
    .footer_contenido textarea
    {
        font-size: 14px;
        max-width: 700px;
    }
    .footer_contenido p
    {
        font-size: 16px;
    }
    #footer_titulo_mostrar_texto
    {
        margin-top: 25px;
        width: auto;
        border-width: 1px 0px 1px 0px;
        border-color: #D9D9D9;
        border-style: solid;
        padding: 5px;
    }
    #footer_mostrar
    {
        width: 662px;
        align-content: center;
        margin: auto;
    }
    #footer_mostrar_texto
    {
        display: inline-block;
        padding: 10px 20px;
        text-align: center;
        color: #4C4E34;
        border-color: #D9D9D9;
        border-style: solid;
        border-radius: 3px;
        border-width: 1px;
        width: 660px;
        height: auto;
        min-height: 30px;
        background-color: white;
    }
    #footer_enviar
    {
        background-color:#E2E5C4; 
        height: 25px; 
        width: auto; 
        border-width: 1px;
        border-style: solid; 
        border-color: #7E7F6D; 
        border-radius: 3px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
        font-family: sans-serif;
    }
    #footer_enviar:hover
    {
        border-color: #7E7F6D;
        background-color: #BCBFA3;
    }
    #footer_enviar:active
    {
        border-color: #3F4036;
        background-color: #BCBFA3;
    }
</style>

<div class="container" style="max-width: 95%; overflow: hidden;">
    <?php $product = $products[0]["data"]["0"]; ?>
    <div class="imagen">
        <?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> 
    </div>
    <div class="footer_contenido">
        <p id="footer_texto_superior"> Escribe una descripción para agregarla a todos tus productos de Mercado Libre. Esta descripción se agregara sin borrar la descripción actual de cada producto. </p>
        <textarea rows="4" cols="90" id="footer_textarea"></textarea><br>
        <button id="footer_enviar" onClick="
        <?php  
         if(isset($product)){ 
            ?>
                    getDescription(
                    <?php 
                        echo $product->ID; 
                    ?>
                    )
        <?php  
                } 
                ?>
        "> Enviar</button> <a href="?page=mkf-product-entries"><button type="button" id="footer_enviar">Regresar</button></a>
            <p id="status_cambios"></p>
        <div id="footer_mostrar">
            <p id="footer_titulo_mostrar_texto"> Descripción Actual</p>
            <p id="footer_mostrar_texto">
                <?php 
               if(isset($product)){

                    echo get_post($product->ID)->post_content;

                }else{
                    echo "Error! No hay producto de prueba creado";
                }
                ?> 
                <br>
                <br>
            </p>
        </div>
    </div>
</div>

<!--div style="max-width: 100%; overflow-x: scroll;">
  
</div-->

