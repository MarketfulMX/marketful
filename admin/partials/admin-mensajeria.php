<?php
/*
 * Archivo: admin-mensajeria.php
 * Ultima edición : 27 de septiembre de 2018
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
 * Vista de mensajes automaticos de mesajeria postventa.
 * En esta vista el usuario puede predefinir mensajes que se enviaran a los 
 * clientes de manera automatica.
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
   * @funcion show_msj()
   * Muestra el textarea con el mensaje que se va a mostrar en cierta situacion.
   */
  function show_msj(num)
  {
    if($('#a'+num).css('display') == 'none')
    {
      $('#a'+num).css('display','block');
      $('#c_'+num).attr('class','far fa-minus-square');
    }
    else
    {
      $('#a'+num).css('display','none');
      $('#c_'+num).attr('class','far fa-plus-square');
    }
  }

  /**
   * @funcion act_deact_msj()
   */
  function act_deact_msj(num)
  { 
    if($('#act_'+num).attr('class') == 'fas fa-comment')
    {
      $('#act_'+num).attr('class','fas fa-comment-slash');
      alert('Mensaje Desactivado'); 
    }
    else
    {
      $('#act_'+num).attr('class','fas fa-comment');
      alert('Mensaje Activado'); 
    }
  }

  /**
   * @function show_new_msj(num: int)
   */
  function show_new_msj(num)
  {
    var nm = $('#textarea_'+num).val();
    $('.mensaje_actual_'+num).text(nm);
    $('.mensaje_actual_'+num).css('color','#130266');
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
    font-size: 90%;
  }
  .text_msj
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-style: solid; 
    border-radius: 0px;
    padding: 10px;
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
  #act_11, #act_22, #act_33, #act_44
  {

  }
    #act_11:hover, #act_22:hover, #act_33:hover, #act_44:hover
    {
      font-size: 110%;
    }
  i
  {
    cursor: pointer;  
  }
  .mensaje_actual_11, .mensaje_actual_22, .mensaje_actual_33, .mensaje_actual_44
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-style: solid; 
    border-radius: 3px;
    width: 100%;
    padding: 5px;
    margin: 10px 0px; 
    font-size: 80%; color: dimgray
    cursor: pointer;
  }

</style>

<div class="contenedor_msj">
  <div class="titulo_msj">
    <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
    <h3> Mensajeria Automatica Post Venta </h3>
    <p> Define y activa los mensajes automaticos que se enviaran a tus clientes.</p>
  </div>
  <div class="opc_msj" id="1">
    <h6 >
      Notificar Envio Listo 
      <i id="c_11" class="far fa-plus-square" onclick="show_msj(11)"></i> 
      <i id="act_11" onclick="act_deact_msj(11)" class="<?php if(1 == 2) {echo 'fas fa-comment-slash'; } else {echo 'fas fa-comment'; }?>"></i></h6>
    <div class="text_msj" id="a11">
      <b> Mensaje actual</b>
      <div class="mensaje_actual_11">
        <?php echo 'Mensaje actual a mostrar.'; ?>
      </div>
      <b> Redactar Nuevo Mensaje</b><br>
      <textarea rows="4" cols="90" name="" id="textarea_11"> </textarea><br>
      <button class="boton_msj" onclick="show_new_msj(11)"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="2">
    <h6 >
      Mensaje al recibir una orden de compra con envio 
      <i id="c_22" class="far fa-plus-square" onclick="show_msj(22)"></i> 
      <i id="act_22" onclick="act_deact_msj(22)" class="<?php if(1 == 1) {echo 'fas fa-comment-slash';}else {echo 'fas fa-comment'; }?>"></i></h6>
    <div class="text_msj" id="a22">
      <b> Mensaje actual</b>
      <div class="mensaje_actual_22">
        <?php echo 'Mensaje actual a mostrar.'; ?>
      </div>
      <b> Redactar Nuevo Mensaje</b><br>
      <textarea rows="4" cols="90" name="" id="textarea_22"> </textarea><br>
      <button class="boton_msj" onclick="show_new_msj(22)"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="3">
    <h6 >
      Mensaje al recibir una orden de compra con entrega personal 
      <i id="c_33" class="far fa-plus-square" onclick="show_msj(33)"></i> 
      <i id="act_33" onclick="act_deact_msj(33)" class="<?php if(1 == 1) {echo 'fas fa-comment-slash';} else {echo 'fas fa-comment'; }?>"></i></h6>
    <div class="text_msj" id="a33">
      <b> Mensaje actual</b>
      <div class="mensaje_actual_33">
        <?php echo 'Mensaje actual a mostrar.'; ?>
      </div>
      <b> Redactar Nuevo Mensaje</b><br>
      <textarea rows="4" cols="90" name="" id="textarea_33"> </textarea><br>
      <button class="boton_msj" onclick="show_new_msj(33)"> Actualizar Mensaje</button>
    </div>
  </div>
  <div class="opc_msj" id="4">
    <h6 >
      Mensaje cuando la empresa de envio acusa recibo del paquete 
      <i id="c_44" class="far fa-plus-square" onclick="show_msj(44)"></i> 
      <i id="act_44" onclick="act_deact_msj(44)" class="<?php if(1 == 1) {echo 'fas fa-comment-slash';} else {echo 'fas fa-comment'; }?>"></i></h6>
    <div class="text_msj" id="a44">
      <b> Mensaje actual</b>
      <div class="mensaje_actual_44">
        <?php echo 'Mensaje actual a mostrar.'; ?>
      </div>
      <b> Redactar Nuevo Mensaje</b><br>
      <textarea rows="4" cols="90" name="" id="textarea_44"> </textarea><br>
      <button class="boton_msj" onclick="show_new_msj(44)"> Actualizar Mensaje</button>
    </div>
  </div>
</div>