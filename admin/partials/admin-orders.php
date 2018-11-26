<?php
/*
 * Archivo: admin-orders.php
 * Ultima edici�n : 17 de septiembre de 2018
 *
 * @autor: Adolfo Yanes (adolfo@marketful.mx)
 * @autor: Administrador de Proyecto: Mauricio Alcala (mauricio@marketful.mx)
 * @versi�n: 1.02
 * 
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 */

 /**
 * Descripci�n General: 
 * Vista que muestra las ordenes existentes que se tiene en Mercado Libre
 * y permite ver sus atributos.
 * En estam vista los usuarios pueden ver de manera clara las ordenes que 
 * se encuentran activas asi como la informacion relacionada con las mismas.
 *
 */
 $keyword = ''; $keyword = $_REQUEST['keyword'];
 $op1 = ''; $op1 = $_REQUEST['op1']; 
 $op2 = ''; $op2 = $_REQUEST['op2']; 
 $op3 = ''; $op3 = $_REQUEST['op3']; 
 $op4 = ''; $op4 = $_REQUEST['op4']; 
 $imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );

 // Tomar las ordenes
 $orders = MKF_ProductEntry::GetInstance()->get_order_list($keyword, $op1, $op2, $op3, $op4);
?>
    
<!-- Mandamos llamar a las libreruas que utilizaremos -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>

<!-- estilos de mercado libre  -->
<link rel="stylesheet" type="text/css" href="https://http2.mlstatic.com/ui/chico/2.0.11/ui/chico.min.css">
<script type="text/javascript" src="https://http2.mlstatic.com/ui/chico/2.0.11/ui/chico.min.js"></script>
<!-- fin ML -->

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
   * - Al ejecutarse recibe datos de un producto de una orden y los muestra dentro de un PDF
   *   que se descarga automaticamente.
   *
   */
  function imprimir_etiqueta(producto, fecha, nombre, apellidos)
  {
    alert(" Imprimir etiqueta. ");
    var etiqueta = new jsPDF();
    etiqueta.text('----------------------------------------------------', 100, 10, 'center');
    etiqueta.text('     MARKETFUL SHIPPING SERVICE PREV LABEL        ', 100, 20, 'center');
    etiqueta.text('----------------------------------------------------', 100, 30, 'center');
    etiqueta.text('  Etiqueta de salida del producto: '+producto+'   ', 100, 40, 'center');
    etiqueta.text('-                                                  -', 100, 50, 'center');
    etiqueta.text('   CUSTOMER: '+ apellidos + ' ' + nombre + ' ', 100, 60, 'center'); 
    etiqueta.text('----------------------------------------------------', 100, 70, 'center');
    etiqueta.text('   DATE: '+ fecha +' ', 100, 80, 'center');
    etiqueta.text('----------------------------------------------------', 100, 90, 'center');
    etiqueta.setFontSize(40);
    etiqueta.text('             03 ', 100, 110, 'center');
    etiqueta.save('Etiqueta.pdf');
  }

  /**
   * @funcion mostrar_filtro()
   *
   * - Funcion que muestra u oculta el filtro dependiendo de si se esta mostrando o no.
   */
  function mostrar_filtro()
  {
    var estado = $('.filtros_ao').css('display');
    if(estado == 'grid')
    $('.filtros_ao').css('display','none');
    else
    $('.filtros_ao').css('display','grid');
  }

  /**
   * @funcion apply_filter()
   *
   * - Descripcion General: Esta funcion toma los valores de los radio buttons dentro de cada
   *   form para obtener los criterios de busqueda.
   *
   * 1.- Definimos la matriz values, despues le asignamos los valores que representan los radiobuttons
   *     que seleccione el usuario, dependiendo de la categoria. Estos valores son los que enviaremos 
   *     hacia la funcion get_order_list() mediante variables en la URL.
   * 2.- Guardamos en 4 variables los valores de los radiobuttons buscandolos segun el nombre que tengan 
   *     y el form en el que se encuentren.
   * 3.- Posteriormente usando validaciones revisamos si es que alguno de ellos tiene valor de undefined, 
   *     en cuyo caso le asignamos un valor vacio.
   * 4.- Redirigimos la pagina hacia la misma vista admin-orders, enviando las 4 variables con sus diferentes
   *     para que el script de php ejecute el metodo geto_order_list() y haga la busqueda segun los filtros
   *     que el usuario selecciono.
   */
  function apply_filter()
  {
    var values = new Array(4);

    values[0] = ['', 'por cobrar', 'cobrado'];
    values[1] = ['', 'me'];
    values[2] = ['', 'wc-on-hold', 'wc-processing', 'wc-processing', 'wc-processing', 'wc-pending', 'wc-completed', 'wc-completed', 'wc-cancelled'];
    values[3] = ['', 'Por resover con el comprador', 'resueltos con el comprador', 'mediacion de mercadolibre', 'resueltoscon mediacion de mercadolibre'];
    
    var op1 = values[0][$('input[name=cobros]:checked', '.sup_2').val()];
    var op2 = values[1][$('input[name=envio]:checked', '.sup_3').val()];
    var op3 = values[2][$('input[name=estados]:checked', '.s4_2').val()];
    var op4 = values[3][$('input[name=reclamos]:checked', '.s5_2').val()];
    
    if(typeof op1 == 'undefined'){op1 = '';} 
    if(typeof op2 == 'undefined'){op2 = '';} 
    if(typeof op3 == 'undefined'){op3 = '';} 
    if(typeof op4 == 'undefined'){op4 = '';} 

    location.href = '?page=mkf-product-orders&keyword=&op1='+op1+'&op2='+op2+'&op3='+op3+'&op4='+op4;
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
    
    border-color: #dee2e6;
    border-width: 0px;
    border-top-width: 0px;
    border-style: solid;
    border-radius: 0px 0px 3px 3px;
    padding: 0px 0px;
    background-color: white;    
    margin-right: 2%; margin-bottom: 0px; margin-top: 20px;
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
      grid-template-columns: 10% 100%;
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
      display: grid;
      text-align: right;
      padding: 5px 40px;
      grid-template-columns: 100%;
      grid-template-rows: 50% 25% 25%;
    }
    .fr2_1{
      /*display: grid;*/
    }
    .fr2_2{
      display: grid;
    }
    .fr3
    {
      overflow: hidden;
      position: relative;

      display: grid;
      grid-template-columns: 40% 60%;
      grid-template-rows: 100%;
      font-size: 85%;
    }
    .acomodo
    {
     vertical-align: middle;
     display: auto;
     justify-content: center;
     align-items: center;
    
    }
    .pruebaespacio{
      /*min-width: 500px;*/
      min-height: 200px;
    }
      .fr3_1
      {
        text-align: center;
      }
      .fr3_2
      {
        display: grid;
        grid-template-columns: 100%;
        grid-template-rows: 50% 25% 25%;
        padding: 2px;
      }
        .fr3_2_1
        {
          color: blue;
          font-size: 14px;
        }


        .contenedor-div{
          position:relative;
        }
        .mi-imagen-abajo-derecha{
          position:relative;
          bottom:5px;
          left: 10px;
        }
        
        .alinear-izquierda{
          text-align: right;
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


  .filtros_ao
  {
    border-color: #DEDDDE; border-style: solid; border-width: 1px; border-radius: 5px;
    background-color: white;
    position: absolute;
    margin: 100px 20%; padding: 0px;
    width: 60%; height: 300px;
    display: none;
    grid-template-rows: 80% 20%;
    grid-template-columns: 100%;
    -webkit-box-shadow: 1px 2px 0px 600px rgba(0,0,0,0.65);
    -moz-box-shadow: 1px 2px 0px 600px rgba(0,0,0,0.65);
    box-shadow: 1px 2px 0px 600px rgba(0,0,0,0.65);
  }
    .sup_f
    {
      margin-top: 10px;
      overflow-y: scroll;
      padding: 10px; padding-left: 20px;
      font-size: 60%;
    }
      .sup_1
      {
        padding-top: 10px;
        font-size: 220%;
      }
      .sup_2
      {
        padding: 20px 0px;
        display: grid;
        grid-template-columns: 25% 25% 25% 25%;
        grid-template-rows: 100%;
        border-bottom: 1px solid #DEDDDE;
      }
      .sup_3
      {
        padding: 20px 0px;
        display: grid;
        grid-template-columns: 25% 25% 50%;
        grid-template-rows: 100%;
        border-bottom: 1px solid #DEDDDE;
      }
      .sup_4
      {
        padding: 20px 0px;
        display: grid;
        grid-template-columns: 25% 75%;
        border-bottom: 1px solid #DEDDDE;
      }
        .s4_2
        {
          display: grid;
          grid-template-columns: 1fr 1fr 1fr;
          grid-template-rows: 1fr 1fr 1fr;
          grid-row-gap: 10px;
        }
      .sup_5
      {
        padding: 20px 0px;
        display: grid;  
        grid-template-columns: 25% 75%;
        grid-template-rows: 100%;
      }
        .s5_2
        {
          display: grid;
          grid-template-columns: 1fr 1fr 1fr;
          grid-template-rows: 1fr 1fr 1fr;
          grid-row-gap: 5px;
        }
    .inf_f
    {
      padding: 15px;
      background-color: #DEDDDE;
      border-radius: 0px 0px 5px 5px;
      font-size: 80%;
    }

/****Estilos Dropdown*****/
  .dropbtn {
    background-color: #3498DB;
    color: white;
    padding: 16px;
    font-size: 16px;
    border: none;
    cursor: pointer;
}

.dropbtn:hover, .dropbtn:focus {
    background-color: #2980B9;
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    right: 0;
    display: none;
    position: absolute;
    background-color: #f1f1f1;
    min-width: 120px;
    overflow: auto;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 6px 16px;
    text-decoration: none;
    display: block;
}

.dropdown a:hover {background-color: #ddd;}

.show {display: block;}

a span.description {
    pointer-events: none;
}
</style>

<!-- JS del dropdown -->
<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>

<!-- Filtros de busqueda. -->
<div class="filtros_ao">
  <div class="sup_f">
    <div class="sup_1">
      Filtros
    </div>
    <!--form class="sup_2">
        <div class="s2_1">
          Cobros
        </div>
        <div class="s2_2">
          <input type="radio" name="cobros" value="0"> Todos<br>
        </div>
        <div class="s2_3">
          <input type="radio" name="cobros" value="1"> A Cobrar<br>
        </div>
        <div class="s2_4">
          <input type="radio" name="cobros" value="2"> Cobrados<br>  
        </div>
    </form-->
    <form class="sup_3">
        <div class="s3_1">
          Servicios de envio
        </div>
        <div class="s3_1">
          <input type="radio" name="envio" value="0"> Todas<br>
        </div>
        <div class="s3_1">
          <input type="radio" name="envio" value="1"> Mercado Envios<br>
        </div>
    </form>
    <div class="sup_4">
      <div class="s4_1">
        Estados
      </div>
      <form class="s4_2">
          <div class="s42_1">
            <input type="radio" name="estados" value="0"> Todas<br>
          </div>
          <div class="s42_2">
            <input type="radio" name="estados" value="1"> Lo Retira<br>
          </div>
          <div class="s42_3">
            <input type="radio" name="estados" value="2"> Etiquetas para imprimir<br>
          </div>
          <div class="s42_4">
            <input type="radio" name="estados" value="3"> Etiquetas para imprimir de FEDEX<br>
          </div>
          <div class="s42_5">
            <input type="radio" name="estados" value="4"> Etiquetas para imprimir de DHL<br>
          </div>
          <div class="s42_6">
            <input type="radio" name="estados" value="5"> Pendientes<br>
          </div>
          <div class="s42_7">
            <input type="radio" name="estados" value="6"> En Camino<br>
          </div>
          <div class="s42_8">
            <input type="radio" name="estados" value="7"> Entregados<br>
          </div>
          <div class="s42_9">
            <input type="radio" name="estados" value="8"> No Enntregados<br>
          </div>
      </form>
    </div>
    <div class="sup_5">
      <div class="s5_1">
        Reclamos
      </div>
      <form class="s5_2">
          <div class="s52_1">
            <input type="radio" name="reclamos" value="0"> Todos<br>
          </div>
          <div class="s52_2">
            <input type="radio" name="reclamos" value="1"> Por Resolver con el Comprador<br>  
          </div>
          <div class="s52_3">
            <input type="radio" name="reclamos" value="2"> Resueltos con el Comprador<br>
          </div>
          <div class="s52_4">
            <input type="radio" name="reclamos" value="3"> En Mediacion con Mercado Libre<br>
          </div>
          <div class="s52_5">
            <input type="radio" name="reclamos" value="4"> Resueltos con Mediacion de Mercado Libre<br>
          </div>
      </form>
    </div>
  </div>
  <div class="inf_f">
    <button type="button" class="btn btn-primary btn-sm" onclick="apply_filter()">Aplicar Filtros</button>
    <a href="#" onclick="mostrar_filtro()">Cancelar</a>
  </div>  
</div>


<!-- Contenedor general -->
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
    <div class="opciones_ord">
      <input id="check_master" type="checkbox"  style="display: none;" onclick="checkbox_select_all('o')">
      <input type="text" class="input_ord" placeholder="comprador o venta" name="" onkeypress="checar_enter(event)" value="<?php echo $keyword; ?>"  id="i_search" />
      <button class="boton_ord" onclick="buscar_orden()">Buscar</button>
    </div>
    <div class="opciones_ord_down" >
      <button class="boton_ord" onclick="mostrar_filtro()">Filtros</button>
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
            $order_val = get_post($order->id);
            $order_info = wc_get_order($order->id);
            $items = $order_info->get_items();
            $primer_producto = reset($items);
            $item_quantity = $primer_producto['qty'];
            $item_total = $primer_producto['line_total'];
            intval($item_quantity) > 0;
            $item_subtotal = 0;
            if(intval($item_quantity) > 0){
              $item_subtotal = (intval($item_total) / intval($item_quantity));
            }
            

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
            
            $product_post_id = $primer_producto['product_id'];
            global $imagen_orden;
            $imagen_orden[ 0 ] = array(
                'width'  => 70,
                'height' => 70,
                'crop'   => $crop,
            );
            $images =& get_children( array (
              'post_parent' => $product_post_id,
              'post_type' => 'attachment',
              'post_mime_type' => 'image'
            ));
            if ( empty($images) ) {
              // no attachments here
            } else {
              foreach ( $images as $attachment_id => $attachment ) {
                //echo ' Imagen 1 : '.wp_get_attachment_image( $attachment_id, 'thumbnail' );
                $path = wp_get_attachment_image( $attachment_id, 'thumb');
                break;
              }
            }
            if(!$path) $path = '<img src="https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg" width="150" height="110">';

            echo '
             <div class="caja_orden pruebaespacio">
              <div class="fr1">
                <div class="fr1_1">
                  <input type="checkbox" style="display: none;" id="checkbox_open_'.$order->id.'"name="checkbox_open">
                </div>
                <div class="fr1_2" id="'.$etiquetas.'">
                  '.$texto_titulo.' status_ml : '.$order->id.'
                </div>
                <div class="fr1_3">
                </div>
                <div class="fr1_4">
                  Fecha de orden: '.$order_val->post_date.'
                </div>
              </div>
              <div class="fr2">
              <div class="alinear-derecha">
                <input type="button" class="ch-btn" value="Imprimir Etiqueta"/>
                </div>
                <div class="alinear-derecha">
                  <a href="?page=mkf-product-orders-details&id='.$order->id.'&pid='.$order->item_product_id.'" target="_blank"> Ver Detalles </a>
                  <div class="dropdown">
                    <button onclick="myFunction()" class="dropbtn" >
                      <span class="myml-ui-dropdown-actions__icon" style="pointer-events: none;">
                        <svg width="8" height="14" viewBox="0 0 8 35" xmlns="http://www.w3.org/2000/svg">
                        <title>A9B9EA24-301D-48AB-ADBC-23CE01B1CCE1</title><g fill="#333" fill-rule="evenodd">
                        <path d="M4 7.838c2.21 0 4-1.754 4-3.919C8 1.755 6.21 0 4 0S0 1.755 0 3.92c0 2.164 1.79 3.918 4 3.918z" ></path>
                        <ellipse cx="4" cy="17.458" rx="4" ry="3.919"></ellipse><ellipse cx="4" cy="30.998" rx="4" ry="3.919" ></ellipse></g>
                        </svg>
                      </span>
                    </button>
                    <div id="myDropdown" class="dropdown-content">
                      <a href="#home">Home</a>
                      <a href="#about">About</a>
                      <a href="#contact">Contact</a>
                    </div>
                  </div>
                </div>
                <div class="alinear-derecha">
                
                </div>
              </div>
              <div class="fr3">
                <div class="fr3_1">
                  '.$path.'
                </div>

                <div class="fr3_2">
                  <div class="fr3_2_1">
                    <a href="'.$link_publicacion.'">'.$primer_producto['name'].'</a>
                  </div>
                  <div class="fr3_2_2">
                    $'.$item_subtotal.' x '.$primer_producto['qty'].' unidad(es) = $'.$primer_producto['line_total'].'
                  </div>
                  <div class="fr3_2_3">
                    SKU: '.$primer_producto['product_id'].'  
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
                  
                </div>
                <div class="fr4_3" style="display:none;">
                  <i class="fas fa-ellipsis-v opciones" onclick=""></i> 
                </div>
              </div> 
            </div>
            '.$order->id.' : '.$order->valor_prueba.' : 
             ';
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
       ?>
    </div>
  </div>
</div>