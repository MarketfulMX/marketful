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
 * En estam vista los usuarios pueden ver de manera clara las ordenes que 
 * se encuentran activas asi como la informacion relacionada con las mismas.
 *
 */
 $keyword = ''; $keyword = $_REQUEST['keyword'];
 $imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

 // Tomar las ordenes
 $orders = MKF_ProductEntry::GetInstance()->get_order_list($keyword);
?>
    
<!-- Mandamos llamar a las libreruas que utilizaremos -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<script type="text/javascript">
  /** 
   * @funcion cambio(@tring: 1 or 2)
   * 
   * Recibe el valor de la pagin ane la que desea para mostrarla y ocultar la otra.
   */
  function cambio(num)
  {
    console.log(num);
    if(num == 2)
    {
      $('#2').attr('class','nav-link active'); $('#1').attr('class','nav-link');  
      $('.cerradas').css('display','inline');
      $('.abiertas').css('display','none');
      $('#checkbox_master').attr('onclick','checkbox_select_all("class")'); 
    }
    else
    {
      $('#1').attr('class','nav-link active'); $('#2').attr('class','nav-link'); 
      $('.abiertas').css('display','inline');
      $('.cerradas').css('display','none');
      $('#checkbox_master').attr('onclick','checkbox_select_all("o")'); 
    }
  }

  /**
   * @funcion checkbox_select_all(@string: o or c)
   * 
   * Esta funcion selecciona todos los checkboxes de la pagina para seleccionar todos sus 
   * checkboxes de los productos que tengamos en lista.
   */
  function checkbox_select_all(tipo)
  {
    console.log('Entro: '+tipo+' : ');
    if(tipo == 'o')
    {
      tipo = 'open';
    }
    else
    {
      tipo = 'close';
    }
    console.log(' Entro a : '+tipo);
    var checkboxes = document.getElementsByName('checkbox_'+tipo);
    var source = $('#checkbox_master');
    for(var i=0, n=checkboxes.length;i<n;i++) 
    {
        checkboxes[i].checked = source.is(":checked");
    }
  }

  /***
   * @funcion buscar_orden()
   *
   * - Descripcion General: Postea el parametro que se ha escrito en el input de busqueda. Redirige la pagina hacia si misma pero 
   * con la keyword que hace que se realice la busqueda de resultados. La keyword busca el nombre del producto, o el nombre del 
   * comprador.
   */
  function buscar_orden()
  {
    var keyword = $('#i_search').val();
    location.href = '?page=mkf-product-orders&keyword='+keyword;
  }

  /**
   * @funcion checar_enter(@enter)
   *
   * - Descripcion General: Funcion que ejecuta la busqueda cuando el usuario 
   * ingresa la keyword a buscar y da enter.
   */
  function checar_enter(e)
  {
      if(e.which==13)
      {
          buscar_orden();
      }
  }

  /**
   * @funcion imprimir_etiqueta()
   *
   */
  function imprimir_etiqueta(producto, fecha, nombre, apellidos)
  {
    alert(" Imprimir etiqueta. ");
    var etiqueta = new jsPDF();
    etiqueta.text('----------------------------------------------------', 100, 10, 'center');
    etiqueta.text('|     MARKETFUL SHIPPING SERVICE PREV LABEL        |', 100, 20, 'center');
    etiqueta.text('----------------------------------------------------', 100, 30, 'center');
    etiqueta.text('|  Etiqueta de salida del producto: '+producto+'   |', 100, 40, 'center');
    etiqueta.text('-                                                  -', 100, 50, 'center');
    etiqueta.text('|  CUSTOMER: '+ apellidos + ' ' + nombre + ' ', 100, 60, 'center'); 
    etiqueta.text('----------------------------------------------------', 100, 70, 'center');
    etiqueta.text('|  DATE: '+ fecha +' ', 100, 80, 'center');
    etiqueta.save('Etiqueta.pdf');
  }

</script>

<style type="text/css">
  .head_ord
  {
    margin-bottom: 10px; margin-left: 10px;
  }
    h4
    {
      margin-top: -10px;
    }
  .container
  {
    width: 100%;
  }
  .contenedor
  {
    overflow-y: scroll; 
    height: 60vh;
    border-color: #dee2e6;
    border-width: 0px;
    border-top-width: 0px;
    border-style: solid;
    border-radius: 0px 0px 3px 3px;
    padding: 0px 0px;
    background-color: white;    
    margin-right: 2%; margin-bottom: 0px;
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
    margin-top: -100px;
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
    #etiquetas
    {
      color: #FFA534;
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
        grid-template-rows: 25% 25% 25% 25%;
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
<div class="container">
<div class="head_ord">
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
  <h4> Seller Center - &Oacute;rdenes</h4>
</div>
<div class="maximo">
  <ul class="nav nav-tabs tab-superior" id= tab-superior style="max-width: 98%;">
    <li class="nav-item"><a href="#" id="1" class="nav-link active" onclick="cambio(1)" >Abiertas</a></li>
    <li class="nav-item"><a href="#" id="2" class="nav-link" onclick="cambio(2)" >Cerradas</a></li>
  </ul>
  <div class="opciones_ord" style="display: none;">
    <input id="checkbox_master" type="checkbox" onclick="checkbox_select_all('o')">
    <input type="text" class="input_ord" placeholder="comprador o venta" name="" onkeypress="checar_enter(event)" value="<?php echo $keyword; ?>"  id="i_search" />
    <button class="boton_ord" onclick="buscar_orden()">Buscar</button>
  </div>
  <div class="opciones_ord_down" style="display: none;">
    <button class="boton_ord">Filtros</button>
  </div>
</div>
  <div class="contenedor">
    <div class="abiertas">
      <?php
        /**
         * @Script: El foreach recorrera todos los posibles registros que haya retornado la query
         * y despues lo mostrara con el formato de la vista.
         * Aqui se muestran todas las ordenes abiertas.
         */
        foreach ($orders[0]['data'] as $key => $order) 
        {
          if($order->estado == 'wc-pending' || $order->estado == 'wc-processing' || $order->estado == 'wc-on-hold')
          {
            /**
             * @Script para mostrar la imagen desde woocommerce
             *
             * - 1: Se toma el valor de la descripcion que llega de la base de datos.
             * - 2: Usando strpos() buscamos dentro del array $path el texto 'src="http' que nos indica que 
             *      existe una imagen y guardamos la posicion y lo guardamos en $img. 
             * - 3: Validamos si el valor de $img es mayor a cero, lo cual nos indica que existe una imagen
             *      en la descripcion.
             * - 4: En caso que si, buscamos dentro de $path el texto '.jpeg" alt="" width="' para saber si
             *      la imagen es jpeg.
             * - 5: En caso que si, buscamos dentro de $path el texto '.jpeg" alt="" width="' para saber si
             *      la imagen es jpg.
             * - 6: Sacamos el valor de $inicio, sumandole 5 caracteres a la posicion que nos regresa en $img.
             * - 7: En caso de que el valor de $jpg sea mayor a cero, significa que hay una imagen jpg, en caso
             *      contrario valida si $jpeg es mayor a cero lo que indica que existe una imagen jpeg.
             * - 8: En ambios casos, determina el valor de $fin, segun la posicion tomando en cuenta el inicio 
             *      y el fin.
             * - 9: Despues de lo anterior se setea el valor de jpg y jpeg en 0.
             */
            $path = $order->item_content;
            $img = strpos($path, 'src="http');
            if($img > 0)
            {
              $jpeg = strrpos($path, '.jpeg" alt="" width="'); 
              $jpg = strrpos($path, '.jpg" alt="" width="'); 
              $inicio = $img + 5; 
              if($jpg > 0)
              {
                $fin = $jpg - $inicio + 4; 
                $direc = substr($path, ($inicio), ($fin)); 
                $jpg = 0;
              }
              elseif($jpeg > 0)
              {
                $fin =  $jpeg - $inicio + 5;  
                $direc = substr($path, ($inicio), ($fin)); 
                $jpeg = 0;
              }
            }
            else
            {
              $inicio = '';
              $fin = '';
              $direc = 'https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg';
            }

            /**
             * @script
             * - Usando un switch definimos el titulo que tendra el producto de la orden, asi como el texto que mostrara el 
             *   boton de dicha orden y la accion que ejecutara cuando se le haga clic dependiendo el caso.
             */
            switch ($order->estado) {
              case 'wc-pending':
                $texto_boton = 'Imprimir etiqueta';
                $texto_titulo = 'Etiqueta no impresa';
                $etiquetas = 'etiquetas';
                $funcion_ejec = 'imprimir_etiqueta(\''.$order->item_name.'\',\''.$order->fecha.'\',\''.$order->customer_name.'\',\''.$order->customer_lastname.'\');';
                break;
              case 'wc-processing':
                $texto_boton = 'Seguir envio';
                $texto_titulo = 'En camino';
                $etiquetas = '';
                $funcion_ejec = '';
                break;
              
              default:
                break;
            }
            $link_publicacion = get_post_meta($order->id, "link_publicacion", true ) ;
            // Alternativa
            // $order->link_pub;
            echo '
             <div class="caja_orden">
              <div class="fr1">
                <div class="fr1_1">
                  <input type="checkbox" style="display: none;" id="checkbox_open_'.$order->id.'"name="checkbox_open">
                </div>
                <div class="fr1_2" id="'.$etiquetas.'">
                  '.$texto_titulo.'
                </div>
                <div class="fr1_3">
                </div>
                <div class="fr1_4">
                  Fecha de orden: '.$order->fecha.'
                </div>
              </div>
              <div class="fr2">
                <button type="button" class="btn btn-primary" onclick="'.$funcion_ejec.'">'.$texto_boton.'</button>
              </div>
              <div class="fr3">
                <div class="fr3_1">
                  <img src="'.$direc.'" width="120" height="100">
                </div>
                <div class="fr3_2">
                  <div class="fr3_2_1">
                    <a href="'.$link_publicacion.'">'.$order->item_name.'</a>
                  </div>
                  <div class="fr3_2_2">
                    $ '.$order->item_price.' x '.$order->item_qty.' unidad(es) = $'.$order->item_price_total.'
                  </div>
                  <div class="fr3_2_3">
                    SKU: '.$order->item_sku.'  
                  </div>
                </div>
              </div>
              <div class="fr4">
                <div class="fr4_1">
                  <div class="fr4_1_1">
                    '.$order->customer_name.' '.$order->customer_lastname.'
                  </div>
                  <div class="fr4_1_2">
                    '/*.$order->customer_id*/.'
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
                <div class="fr4_3" style="display:none;">
                  <i class="fas fa-ellipsis-v opciones" onclick=""></i>
                </div>
              </div> 
            </div>
             ';
            }
          }
           
     ?>
      
    </div>
    <div class="cerradas">
      <?php
        /**
         * @Script: El foreach recorrera todos los posibles registros que haya retornado la query
         * y despues lo mostrara con el formato de la vista.
         * Aqui se muestran todas las ordenes cerradas.
         */

        foreach ($orders[0]['data'] as $key => $order) 
        {
          if($order->estado == 'wc-completed' || $order->estado == 'wc-cancelled' || $order->estado == 'wc-refunded' || $order->estado == 'wc-failed')
          {
            // Script para mostrar la imagen desde woocommerce
            $path = $order->item_content; 
            $img = strpos($path, 'src="http');
            if($img > 0)
            {
              $jpeg = strrpos($path, '.jpeg" alt="" width="'); 
              $jpg = strrpos($path, '.jpg" alt="" width="'); 
              $inicio = $img + 5; 
              if($jpg > 0)
              {
                $fin = $jpg - $inicio + 4; 
                $direc = substr($path, ($inicio), ($fin)); 
                $jpg = 0;
              }
              elseif($jpeg > 0)
              {
                $fin =  $jpeg - $inicio + 5; 
                $direc = substr($path, ($inicio), ($fin)); 
                $jpeg = 0;
              }
            }
            else
            {
              $inicio = '';
              $fin = '';
              $direc = 'https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg';
            }
             echo '
             <div class="caja_orden">
              <div class="fr1">
                <div class="fr1_1">
                  <input type="checkbox" style="display: none;" id="checkbox_close_'.$order->id.'"name="checkbox_close">
                </div>
                <div class="fr1_2-2">
                  Entregado
                </div>
                <div class="fr1_3">
                </div>
                <div class="fr1_4">
                  Fecha de orden: '.$order->fecha.'
                </div>
              </div>
              <div class="fr2">
                <button type="button" class="btn btn-primary">Seguir Envio</button>
              </div>
              <div class="fr3">
                <div class="fr3_1">
                  <img src="'.$direc.'" width="120" height="100">
                </div>
                <div class="fr3_2">
                  <div class="fr3_2_1">
                    <a href="#">'.$order->item_name.'</a>
                  </div>
                  <div class="fr3_2_2">
                    $ '.$order->item_price.' x '.$order->item_qty.' unidad(es) = $'.$order->item_price_total.'
                  </div>
                  <div class="fr3_2_3">
                    SKU: '.$order->item_sku.'  
                  </div>
                </div>
              </div>
              <div class="fr4">
                <div class="fr4_1">
                  <div class="fr4_1_1">
                    '.$order->customer_name.' '.$order->customer_lastname.'
                  </div>
                  <div class="fr4_1_2">
                    '/*.$order->customer_id*/.'
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
                <div class="fr4_3" style="display:none;">
                  <i class="fas fa-ellipsis-v opciones" onclick=""></i>
                </div>
              </div> 
            </div>
            ';
          }
        }
     ?>
    </div>
  </div>
</div>
