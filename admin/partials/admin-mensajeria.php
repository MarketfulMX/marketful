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
 * Vista de mensajes automaticos en woocommerce.
 *
 *
 */
 $imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );
?>

<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script type="text/javascript">
  /**  
   * @funcion show()
   * Muestra el textarea con el mensaje que se va a mostrar en cierta situacion.
   */
  function show_msj(num)
  {
    if($('#a'+num).css('display') == 'none')
    {
      $('#a'+num).css('display','block');
    }
    else
    {
      $('#a'+num).css('display','none');
    }
  }
</script>

<style type="text/css">
  .titulo_msj
  {
    margin: 20px;
  }
  .opc_msj
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-style: solid; 
    border-radius: 3px;
    padding: 10px;
    background-color: white;    
    margin-right: 2%; margin-bottom: 1%;
    vertical-align: middle;
  }
  .text_msj
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-style: solid; 
    border-radius: 0px;
    padding: 5px;
    background-color: white;    
    margin-right: 2%; margin-bottom: 1%;
  }
  #a11, #a22, #a33, #a44
  {
    display: none;
  }
  .boton_msj
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
    .boton_msj:hover
    {
      border-color: #7E7F6D;
      background-color: #BCBFA3;
    }
    .boton_msj:active
    {
      border-color: #3F4036;
      background-color: #BCBFA3;
    }
  div h6
  {
    cursor: pointer;  
  }

</style>

<div class="contenedor_msj">
  <div class="titulo_msj">
    <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
    <h3> Mensajeria</h3>
  </div>
  <div class="opc_msj" id="1">
    <h6 onclick="show_msj(11)">Notificar Envio Listo <i class="far fa-plus-square"></i></h6>
    <div class="text_msj" id="a11">
      <textarea rows="4" cols="90" name=""> </textarea><br>
      <button class="boton_msj"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="2">
    <h6 onclick="show_msj(22)">Mensaje al recibir una orden de compra con envio <i class="far fa-plus-square"></i></h6>
    <div class="text_msj" id="a22">
      <textarea rows="4" cols="90" name=""> </textarea><br>
      <button class="boton_msj"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="3">
    <h6 onclick="show_msj(33)">Mensaje al recibir una orden de compra con entrega personal <i class="far fa-plus-square"></i></h6>
    <div class="text_msj" id="a33">
      <textarea rows="4" cols="90" name=""> </textarea><br>
      <button class="boton_msj"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="4">
    <h6 onclick="show_msj(44)">Mensaje cuando la empresa de envio acusa recibo del paquete <i class="far fa-plus-square"></i></h6>
    <div class="text_msj" id="a44">
      <textarea rows="4" cols="90" name=""> </textarea><br>
      <button class="boton_msj"> Actualizar Mensaje</button>
    </div>
  </div>
</div>