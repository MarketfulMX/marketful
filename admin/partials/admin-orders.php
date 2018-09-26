<?php
/*
 * Archivo: admin-orders.php
 * Ultima edición : 17 de septiembre de 2018
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
 * Vista que muestra las ordenes existentes que se tiene en Mercado Libre
 * y permite ver sus atributos.
 *
 *
 */

 $imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

 // Tomar las ordenes
 $orders = MKF_ProductEntry::GetInstance()->get_order_list();
?>
    
<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script type="text/javascript">
  function clic(num)
  {
    console.log(num);
    if(num == 2)
    {
      $('#2').attr('class','nav-link active'); $('#1').attr('class','nav-link');  
      $('.cerradas').css('display','inline');
      $('.abiertas').css('display','none');
    }
    else
    {
      $('#1').attr('class','nav-link active'); $('#2').attr('class','nav-link'); 
      $('.abiertas').css('display','inline');
      $('.cerradas').css('display','none');
    }
  }

  function checkbox_select_all(tipo)
  {
    console.log('Entro: '+tipo+' : ');
    if(tipo = 'o')
    {
      o = 'open';
    }
    else
    {
      o = 'close';
    }
    var checkboxes = document.getElementsByName('checkbox_'+o);
    var source = $('#checkbox_master')
    //console.log(source)
    for(var i=0, n=checkboxes.length;i<n;i++) 
    {
        checkboxes[i].checked = source.is(":checked");
        // checkboxes[i].checked = true;
    }
  }

</script>

<style type="text/css">
  .head_ord
  {
    margin: 20px;
  }
  .contenedor
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-top-width: 0px;
    border-style: solid;
    border-radius: 0px 0px 3px 3px;
    padding: 0px 0px;
    background-color: white;    
    margin-right: 2%;
    color: #656666;
  }
  .cerradas
  {
    display: none;
  }
  .opciones_ord
  {
    border-color: #dee2e6;
    border-width: .5px;
    border-top-width: 0px; 
    border-style: solid; 
    border-radius: 0px;
    padding: 10px 5px;
    padding-left: 20px;
    background-color: white;    
    margin-right: 2%;
    vertical-align: middle;   
  }
    .opciones_ord_down
    {
      border-color: #dee2e6;
      border-width: .5px;
      border-top-width: 0px; 
      border-style: solid; 
      border-radius: 0px;
      padding: 5px;
      background-color: white;    
      margin-right: 2%;
      vertical-align: middle;
      background-color: #EAFAE9;  
      padding-left: 10px;
    }
  .input_ord
  {
    width: 150px; height: 25px;
    border-radius: 3px; 
    border-color: #7E7F6D;
  }
  .boton_ord
  {
    padding: 1px 10px;
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
    .boton_ord:hover
    {
      border-color: #7E7F6D;
      background-color: #BCBFA3;
    }
    .boton_ord:active
    {
      border-color: #3F4036;
      background-color: #BCBFA3;
    }
  .caja_orden
  {
    margin-top: 20px;
    border-color: #dee2e6;
    border-style: solid;
    border-width: .5px;
    background-color: white;
    padding: 10px;
    display: grid;
    grid-template-columns: 40% 60%;
    grid-template-rows: 50% 50%;
  }
    .fr1
    {
      display: grid;
      grid-template-columns: 10% 90%;
      grid-template-rows: 50% 50%;
    }
      .fr1_1
      {
        text-align: center;
      }
      .fr1_2
      {
        color: #27B820;
      }
      .fr1_2-2
      {
        color: black;
      }
      .fr1_4
      {
        font-size: 85%;
      }
    .fr2
    {
      text-align: right;
      padding: 5px 40px;
    }
    .fr3
    {
      padding-top: 20px;
      display: grid;
      grid-template-columns: 40% 60%;
      grid-template-rows: 100%;
      font-size: 85%;
    }
      .fr3_1
      {
        text-align: center;
      }
      .fr3_2
      {
        display: grid;
        grid-template-columns: 100%;
        grid-template-rows: 1fr 1fr 1fr;
      }
        .fr3_2_1
        {
          color: blue;
        }
    .fr4
    {
      padding-top: 20px;
      display: grid;
      grid-template-columns: 70% 15% 15%;
      grid-template-rows: 100%;
      font-size: 85%;
    }
      .fr4_1
      {
        display: grid;
        grid-template-columns: 100%;
        grid-template-rows: 30% 30% 20% 20%;
      }
      .fr4_2
      {
        text-align: center;
      }
      .opciones
      {
        cursor: pointer;
      }
</style>
<div class="head_ord">
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
  <h3> Ordenes</h3>
</div>
<div class="maximo">
  <ul class="nav nav-tabs tab-superior" id= tab-superior style="max-width: 98%;">
    <li class="nav-item"><a href="#" id="1" class="nav-link active" onclick="clic(1)" >Abiertas</a></li>
    <li class="nav-item"><a href="#" id="2" class="nav-link" onclick="clic(2)" >Cerradas</a></li>
  </ul>
  <div class="opciones_ord">
    <input name="checkbox_open" type="checkbox" onclick="checkbox_select_all('o')">
    <input type="text" class="input_ord" placeholder="comprador o venta" name="" />
    <button class="boton_ord">Buscar</button>
  </div>
  <div class="opciones_ord_down">
    <button class="boton_ord">Filtros</button>
  </div>
  </div>
  <div class="contenedor">
    <div class="abiertas">
      <?php
        foreach ($orders[0]['data'] as $key => $order) 
        {
         echo '
         <div class="caja_orden">
          <div class="fr1">
            <div class="fr1_1">
              <input type="checkbox" id="checkbox_open_'.$order->id.'"name="checkbox_open">
            </div>
            <div class="fr1_2">
              En camino
            </div>
            <div class="fr1_3">
            </div>
            <div class="fr1_4">
              '.$order->fecha.'
            </div>
          </div>
          <div class="fr2">
            <button type="button" class="btn btn-primary">Seguir Envio</button>
          </div>
          <div class="fr3">
            <div class="fr3_1">
              <img src="https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg" width="120" height="100">
            </div>
            <div class="fr3_2">
              <div class="fr3_2_1">
                <a href="#">'.$order->name.'</a>
              </div>
              <div class="fr3_2_2">
                $ '.$order->precio_sub.' x '.$order->qty.' unidad(es) = $'.$order->precio_tot.'
              </div>
              <div class="fr3_2_3">
                SKU: '.$order->sku.'  
              </div>
            </div>
          </div>
          <div class="fr4">
            <div class="fr4_1">
              <div class="fr4_1_1">
                '.$order->customer_name.'
              </div>
              <div class="fr4_1_2">
                '.$order->customer_id.'
              </div>
              <div class="fr4_1_3">
                '.$order->customer_tel.'
              </div>
              <div class="fr4_1_4">
                <a href="#&'.$order->id.'" >Enviar Mensaje</a>
              </div>
            </div>
            <div class="fr4_2">
              <a href="#"> Ver Detalles </a>
            </div>
            <div class="fr4_3">
              <i class="fas fa-ellipsis-v opciones" onclick=""></i>
            </div>
          </div> 
        </div>
         ';
        }
     ?>
      
    </div>
    <div class="cerradas">
      <?php
        foreach ($orders[0]['data'] as $key => $order) 
        {
         echo '
         <div class="caja_orden">
          <div class="fr1">
            <div class="fr1_1">
              <input type="checkbox" id="checkbox_close_'.$order->id.'"name="">
            </div>
            <div class="fr1_2-2">
              Entregado
            </div>
            <div class="fr1_3">
            </div>
            <div class="fr1_4">
              '.$order->fecha.'
            </div>
          </div>
          <div class="fr2">
            <button type="button" class="btn btn-primary">Seguir Envio</button>
          </div>
          <div class="fr3">
            <div class="fr3_1">
              <img src="https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg" width="120" height="100">
            </div>
            <div class="fr3_2">
              <div class="fr3_2_1">
                <a href="#">'.$order->name.'</a>
              </div>
              <div class="fr3_2_2">
                $ '.$order->precio_sub.' x '.$order->qty.' unidad(es) = $'.$order->precio_tot.'
              </div>
              <div class="fr3_2_3">
                SKU: '.$order->sku.'  
              </div>
            </div>
          </div>
          <div class="fr4">
            <div class="fr4_1">
              <div class="fr4_1_1">
                '.$order->customer_name.'
              </div>
              <div class="fr4_1_2">
                '.$order->customer_id.'
              </div>
              <div class="fr4_1_3">
                '.$order->customer_tel.'
              </div>
              <div class="fr4_1_4">
                <a href="#&'.$order->id.'" >Enviar Mensaje</a>
              </div>
            </div>
            <div class="fr4_2">
              <a href="#"> Ver Detalles </a>
            </div>
            <div class="fr4_3">
              <i class="fas fa-ellipsis-v opciones" onclick=""></i>
            </div>
          </div> 
        </div>
         ';
        }
     ?>
    </div>
  </div>
</div>