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

?>


<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script>
    function getDescription()
    {
        $('#footer_mostrar_texto').text($('#footer_textarea').val());
    }
</script>

<style>
    #footer_texto_superior
    {
        max-width: 700px;
        display: inline-block;
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
    #footer_mostrar_texto
    {
        margin-top: 45px;
        color: crimson;
    }
    #footer_enviar
    {
        background-color:#E2E5C4; 
        height: 25px; 
        width: auto; 
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
    <div class="imagen">
        <?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> 
    </div>
    <div class="footer_contenido">
        <p id="footer_texto_superior"> Escribe una descripción, presiona enviar y nosotros la agregaremos a todos tus productos de Mercado Libre</p>
        <textarea rows="4" cols="90" id="footer_textarea"></textarea><br>
        <button id="footer_enviar" onClick="getDescription()"> Enviar</button>
        <p id="footer_mostrar_texto"></p>
    </div>
</div>

<!--div style="max-width: 100%; overflow-x: scroll;">
  
</div-->

