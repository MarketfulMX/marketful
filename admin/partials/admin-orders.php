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
    padding: 10px 5px;
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
    padding: 5px;
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
    .fr4
    {
      padding-top: 20px;
      display: grid;
      grid-template-columns: 50% 35% 15%;
      grid-template-rows: 100%;
    }
      .fr4_1
      {
        display: grid;
        grid-template-columns: 100%;
        grid-template-rows: 40% 30% 30%;
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
    <input name="cb" type="checkbox" />
    <input type="text" class="input_ord" placeholder="comprador o venta" name="" />
    <button class="boton_ord">Buscar</button>
  </div>
  <div class="opciones_ord_down">
    <button class="boton_ord">Filtros</button>
  </div>
  </div>
  <div class="contenedor">
    <div class="abiertas">
      <div class="caja_orden">
        <div class="fr1">
          <div class="fr1_1">
            <input type="checkbox" name="">
          </div>
          <div class="fr1_2">
            En camino
          </div>
          <div class="fr1_3">
          </div>
          <div class="fr1_4">
            Llega tal dia
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
              <a href="#">Nombre del producto</a>
            </div>
            <div class="fr3_2_2">
              Zona 3.2.2
            </div>
            <div class="fr3_2_3">
              Zona 3.2.3
            </div>
          </div>
        </div>
        <div class="fr4">
          <div class="fr4_1">
            <div class="fr4_1_1">
              Zona 4.1.1
            </div>
            <div class="fr4_1_2">
              Zona 4.1.2
            </div>
            <div class="fr4_1_3">
              Zona 4.1.3
            </div>
          </div>
          <div class="fr4_2">
            Zona 4.2
          </div>
          <div class="fr4_3">
            Zona 4.3
          </div>
        </div> 
      </div>
    </div>
    <div class="cerradas">
      Cerradas
    </div>
  </div>
</div>