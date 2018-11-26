<!-- 
 * Archivo: admin-dashboard.php
 * Ultima edición : 30 de agosto de 2018
 *
 * @autor: Adolfo Yanes (adolfo@marketful.mx)
 * @autor: Administrador de Proyecto: Mauricio Alcala (mauricio@marketful.mx)
 * @versión: 1.01
 * 
 * @package    mkf
 * @subpackage mkf/admin/partials
 *
 *
 * Descripcion general:
 * Este archivo contiene la seccion dashbord y se enfoca en mostrar al usuario un breve
 * resumen de las duncionalidades del plugin, asi como la version que es. Le permite 
 * realizar la introduccion u "onboarding" de manera sencilla, le presenta una seccion
 * de preguntas y respuestas y otra de soporte.
-->
<?php
    /** 
     * @Script 
     *
     * Aqui validamos que el onboarding no se haya completado aun, lo logramos haciendo 
     * una query en la cual buscamos el valor de post_name en el producto de marketful_
     * descripcion_comun en caso de que el valor sea finished, mostramos el dashboard 
     * en caso de que sea unfinished se redirige automaticamente hacia el onboarding.
     */
    // $products = wc_get_products( array(
    //             'title' => 'marketful_descripcion_comun',
    //             'name' => 'unfinished',
    //             ));
    $keyword = 'marketful_descripcion_comun';
    $products = MKF_ProductEntry::GetInstance()->get_product_list(1, 0, $keyword);
    //echo '<script> console.log("estamos en eso '.$products.'"); </script>';
    if (get_post_meta($products[0]->ID, "name", $single = true ) == 'unfinished')
    // if($products[0])
    {
        //echo '<script>console.log("Entramos a unfinished");</script>';
        header('Location: ?page=mkf-onboarding');
    }
?>
<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script>
    /**
     * @función clic(@string: numero entero de 1 a 5)
     * 
     * Esta funcio de JS al recibir el @parametro muestra cierto div relacionado con un tab y oculta los demas.
     */
    function clic(num)
    {
        switch (num)
            {   
                case 1:
                    $('#1').attr('class','nav-link active'); $('#dashboard').css('display','inline');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#onboarding').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 2:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link active'); $('#activacion').css('display','inline');
                    $('#3').attr('class','nav-link'); $('#onboarding').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 3:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link active'); $('#onboarding').css('display','inline');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 4:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#onboarding').css('display','none');
                    $('#4').attr('class','nav-link active'); $('#preguntas_frecuentes').css('display','inline');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 5:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#onboarding').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link active'); $('#soporte').css('display','inline');
                    break;
                default :
                    break;
            }
    }

    /**
     * @Funcion tomar_url()
     * 
     * Funcion que toma el URL y lo asigna como value en el input #texto_ac
     */ 
    function tomar_url()
    {
        var url = $(location).attr('href');
        $('#texto_ac').attr('value',url);
    }
    
</script>

<style>
    a{text-decoration: none;}
    #nuevov
    {
        background-color: #44BBFF;
    }
    .nav-item:active
    {
        border-bottom-color: white;
    }
    .head
    {
        margin: 20px;
    }
    #activacion, #onboarding, #preguntas_frecuentes, #soporte
    {
        display: none;
    }
        #mensaje_ac
        {
            height: 260px; width: 40%;
            border-radius: 5px;
            background-color: dimgray;
            text-align: center;
            padding-left: 30px; padding-right: 30px;
            color: white;
            position: fixed;
            z-index: 10;
            margin-left: 20%;
            display: none;
        }
        #mensaje_ac h3
        {
            padding-top: 50px;
            cursor: default;
        }
    #dashboard
    {
        display: inline;
        vertical-align: middle;
        margin-top: 20px;
        margin: 10px;
        font-size: 14px;
        vertical-align: middle;
        
    }
        .maximo
        {
            border-color: #dee2e6;
            border-width: .5px;
            border-top-width: 0px;
            border-style: solid;
            border-radius: 0px 0px 3px 3px;
            padding: 40px;
            background-color: white;    
            margin-right: 2%;
        }
            #db_1, #db_2, #pf_1, #tc_1, #tc_2, #tc_3, #tc_4, #tc_5, #tc_6, #tc_7, #tc_8, #tc_9
            {
                margin: 20px;
                margin-top: -20px;
                border-color: #dee2e6;
                border-style: solid;
                border-width: 1px;
                border-radius: 3px;
                background-color: white;
            }
            #db_3, #db_4
            {
                margin: 20px;
                border-color:#dee2e6;
                border-style: solid;
                border-width: 1px;
                border-radius: 3px;
                background-color: white;
            }
    #activacion
    {
        font-size: 13px;
    }
    #onboarding
    {
        padding: 20px:;
    }
        #ob
        {
            margin: 20px; padding: 10px;
            border-color: #dee2e6;
            border-style: solid;
            border-width: 1px;
            border-radius: 3px;
            background-color: white;
            font-size: 13px;
            align-content: center;
        }
        #muestra_ob
        {
            width: 90%;
            border-radius: 3px;
            border-color: black; border-width: 1px; 
        }
        #flotante_db
        {
            margin-top: -100px;
            position: fixed;
            width: 220px; height: 100px;
            margin-right: 0px;
            margin-left:68%;
            background-color: dimgray;
            border-radius: 5px;
            z-index: 1;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.25);
            text-align: center;
        }
    #tc, #tc_1, #tc_2, #tc_3, #tc_4, #tc_5, #tc_6, #tc_7, #tc_8, #tc_9
    {
        margin: 20px;
    }
    #tc
    {
        padding-bottom: 20px;
    }
    .boton_db
    {
        background-color:#E2E5C4; 
        height: 25px; 
        width: auto; 
        border-style: solid; 
        border-color: #7E7F6D; 
        border-radius: 3px;
        border-width: 1px;
        font-size: 12px;
        text-decoration: none;
        cursor: pointer;
        padding: 3px;
        vertical-align: middle;
        box-shadow: 0 2px 2px rgba(0, 0, 0, 0.25);
        color: black;
    }
        .boton_db:hover
        {
            border-color: #7E7F6D;
            background-color: #BCBFA3;
        }
        .boton_db:active
        {
            border-color: #3F4036;
            background-color: #BCBFA3;
        }
        .boton_db:visited
        {
            color: black;
        }
        .boton_db a
        {
            color: black;
        }
    .nav-item:focus, .nav-link:focus, .active:focus
    {
        border: none;
    }
</style>

<div class="head"> <h3> Dashboard </h3> </div>
    <ul class="nav nav-tabs tab-superior" id= tab-superior style="max-width: 98%;">
        <li class="nav-item"><a href="#" id="1" class="nav-link active" onclick="clic(1)" >Inicio</a></li>
        <li class="nav-item"><a href="#" id="2" class="nav-link" onclick="clic(2)" >Activacion</a></li>
        <li class="nav-item"><a href="#" id="3" class="nav-link" onclick="clic(3)" >OnBoarding </a></li>
        <li class="nav-item"><a href="#" id="4" class="nav-link" onclick="clic(4)" >Preguntas Frecuentes</a></li>
        <li class="nav-item"><a href="#" id="5" class="nav-link" onclick="clic(5)" >Soporte</a></li>
    </ul>
<div class="maximo">
    <div class="contenedor">
        <!-- Tab 1 "Dashboard" ---------------------------------------------------------------------------------------------------------------------->
        <div id="dashboard">
            <div class="row">
                <div class="col" id="db_1">
                    <img style="max-height:20%; margin-left: 0px; margin-top:0px;"src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png"> <button class="boton_db" onclick="clic(2); $('#mensaje_ac').css('display','inline');"> Activa tu tienda </button>
                    <p><b>Marketful Seller Center</b>, revolucionara la manera en la que conectas con tus clientes de <i>WooCommerce</i> y <i>MercadoLibre</i>.  Te ofrecemos un entorno dedicado a hacer tu trabajo mas sencillo, eficiente y personalizado. </p><img style="max-width: 100%; margin-right: auto; border-radius: 3px; padding-bottom: 20px; " src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/a938c3c1c636e14a98eaa3b1d19df58d0f7af344/admin/img/rm/screen.gif?token=Ajnc0aoiH0YDMYTXi3g8YllbgtBRbRyzks5bnpNTwA%3D%3D">
                </div>
                <div class="col" id="db_2">
                    <h3> Version 1.0 </h3>
                    <li> <b>Publicaciones : </b> Con nuestro Seller Center maneja todos tus productos de <i>WooCommerce</i> y publicalos en <i>Mercado Libre</i> con solo un clic de <b> Marketful </b>. </li>
                    <li> <b>Practicidad :</b> Con <b> Marketful </b> la practicidad es la norma, con nuestro Seller Center en una misma pantalla podras manejar todos tus productos y publicaciones facilitando tu trabajo y suprimiendo las tareas mas repetitivas.</li>
                    <li> <b>Cambios masivos :</b> Con <b> Marketful </b> realizar cambios multiples nunca habia sido tan sencillo, con nuestras herramientas de cambios masivos actualiza el estado de tus publicaciones con tan solo un par de clics.</li>
                    <li><b> La API de Mercado Libre en tus manos: </b> Gracias a la tecnologia de <i>Mercado Libre </i> y de <b>Marketful</b> dejamos en tus manos un complemento de <i>WooCommerce</i> totalmente adaptado para trabajar junto a tu tienda de <i>Mercado Libre</i>.</li>
                    <li><b>Todo el soporte de Marketful : </b> Esta en tus manos, todo un equipo  de profesionales listos para trabajar junto a ti creando el Seller Center mas exitoso de Mexico.</li>
                </div>
            </div>
            <div class="row">
                <div class="col" id="db_3">
                    <h3>Somos Marketful &#160;</h3>
                    <p> Tenemos un Onboarding que concentra las herramientas clave que te ayudara a comprender de manera sencilla el funcionamiento de nuestro <i>Seller Center</i> da una miradita de manera gratuita. <a href="#onboarding" style="text-decoration: none;"><button class="boton_db" style=""onclick="clic(3)">Ir a onbording</button></a></p>
                </div>
                <div class="col" id="db_4">
                    <h3>Apoyo paso a paso</h3>
                    <p> Te apoyamos paso a paso para que tu tienda quede espectacular teniendo tus publicaciones de <i>Mercado Libre</i> y <i>WooCommerce</i> para lo cual te apoyamos con una guia completa para que sea sencillo y eficiente para ti controlar tus ventas a travez de nuestra plataforma. Tienes alguna duda? <a style="" href="#soporte" onclick="clic(5)" class="boton_db"> Soporte </a></p>
                </div>
            </div>
        </div>
        <!-- Tab 2 "Activacion" ------------------------------------------------------------------------------------------------------------------->
        <div id="activacion">
            <div id="mensaje_ac">
                <h3> Primero logueate en <b>marketful.mx</b> para poder enlazar tu tienda.</h3>
                <button class="boton_db" onclick="bien_ac()" 
                class="btn_msj_1"> Entendido </button>
            </div>
            <div>
                <h3>Bienvenido a la activacion</h3>
                <p> El proceso de activacion consiste en los siguientes 3 pasos: </p>
                <li> Da clic <a class="boton_db boton_ac_link" target="_blank" href="https://www.marketful.mx/login" onclick=""> aqui </a> para loguearte en Marketful.</li>
                <li style="vertical-align: middle;"> Ya te has registrado, ahora ingresa el link de tu tienda. <input type="text" id="texto_ac" placeholder="Tu Link en WooCommerce" value="">.marketful.mx <button onClick="tomar_url();" class="boton_obtener_ac boton_db"> Obtener Link </button></li>
                <!--li> Por ultimo de manera opcional, logueate con tu pagina de Mercado Libre.</li-->
            </div>
        </div>
        <!-- Tab 3 "OnBoarding" ------------------------------------------------------------------------------------------------------------------>
        <div id="onboarding">
            <div class="row">
                <div class="col">
                    <h3>Bienvenido a la nueva experiencia en E-Commerce</h3>
                </div>
            </div>
            <div class="row">
                <div class="col" id="">
                    Te damos la bievenida al <mark>onboarding</mark>, en los siguientes minutos aprenderas a administrar tus productos de <i>WooCommerce</i> y poder modificar los atributos de la publicacion de ese producto dentro de <i>Mercado Libre</i>.
                </div>
            </div>
            <div class="row">
                <div class="col" id="ob">
                    <p style="font-size: 16px"><b>Vamos a comenzar observando tus productos,</b> como leiste anteriormente <i>Marketful Seller Center</i> esta enfocado en facilitar los procedimientos que conlleva el manejar una tienda en WooCommerce y Mercado Libre. Desde dar de alta una publicacion junto con todos sus diferentes atributos hasta el pausarlas todas de una vez sin tener que hacerlo para cada producto. En esta introduccion te mostraremos lo mas basico para poder empezar a utilizarlo. Primero comenzaremos observado nuestros productos en la vista del <i>Seller Center</i>. En caso de que no tengas productos la lista no mostrara nungun elemento, en caso contrario se veran todos tus productos con su informacion propia:<i> SKU, Titulo en Mercado Libre, Status, Categoria en Mercado Libre, Precio en WooCommerce, Precio en Mercado Libre, Inventario en WooCommerce, Inventario en Mercado Libre, Tipo de envio, Ver publicacion y Ultima Actualizacion.</i> Dar tus productos de alta es muy sencillo, solo da clic en "<a target="_blank" href="http://localhost/wp/wp-admin/post-new.php?post_type=product">Productos</a>" y ahi podras dar un nuevo producto de alta.</p>
                    <img id="muestra_ob" src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/a938c3c1c636e14a98eaa3b1d19df58d0f7af344/admin/img/ob/basic.png?token=Ajnc0bCUJ_88CGTcJwrmDCHwMNoYoDzDks5bnpi6wA%3D%3D"> <a href="?page=mkf-product-entries" class="boton_db" target="_blank">Pruebalo </a>
                    <p style="font-size: 16px; margin-top:20px;"><b>Ahora veremos las opciones,</b> que tenemos disponibles en la barra de titulo del Seller Center:</p>
                    <li style="font-size: 16px"> <i>Botones <b>atras</b> y <b>adelante</b>:</i> Estan en la parte superior izquierda y te permiten navegar entre todos tus productos. Cada pantalla te muestra 50 productos, para ver los siguientes puedes presionar siguiente o para regresar puedes dar clic hacia atras.</li>
                    <li style="font-size: 16px"> <i><b>Status</b> Masivo:</i> Este boton en conjunto con el checkbox masivo, te permite cambiar el status de uno o muchos productos de una sola vez.</li>
                    <li style="font-size: 16px"> <i><b>Exposicion</b> Masiva:</i> Este boton como el anterior, permite que se cambie masivamente la exposicion de uno o muchos productos de una sola vez.</li>
                    <li style="font-size: 16px"> <i>Agregar <b>descripcion general</b>:</i> Este boton te redirige hacia la pantalla en la cual podras asignar una descripcion comun debajo de su descripcion actual a todos los productos.</li>
                    <li style="font-size: 16px"> <i><b>Buscar</b>:</i> La caja de texto en la parte superior derecha de la pantalla te permite ingresar algun nombre de algun producto, dar clic en el boton de la lupa que se encuentra a un lado y te cargara los productos que coincidan con ese nombre en caso de tener alguno.</li>
                    <img id="muestra_ob" src="https://github.com/Skepsis-Consulting/wcplugin/blob/a938c3c1c636e14a98eaa3b1d19df58d0f7af344/admin/img/ob/busquedafocus.png?raw=true">    <a href="?page=mkf-product-entries" class="boton_db" target="_blank">Pruebalo </a>
                    <p style="font-size: 16px; margin-top:20px;"><i><b>Modificando</b> la informacion de los productos :</i> Con <i>Marketful </i> cambiar los datos de tus productos de <i>WooCommerce</i> es muy sencillo. Esta es la distribucion de los datos que tiene cada producto:</p>
                    <img id="muestra_ob" src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/a938c3c1c636e14a98eaa3b1d19df58d0f7af344/admin/img/ob/tablafocus.png?token=Ajnc0RXFByWgrGDhwSzNqRz0Cf-UHrGTks5bnpkGwA%3D%3D"><a href="?page=mkf-product-entries" class="boton_db" target="_blank">Pruebalo </a>
                    <p style="font-size: 16px; margin-top: 20px;"> Puedes modificar el Status, la Exposicion, la Categoria, el precio en <i>Mercado Libre</i>, en inventario en <i>Mercado Libre </i> y el tipo de envio. Recuerda que todos los cambios que realizes se guardaran dentro de <i>WooCommerce</i> y se actualizaran en <i>Mercado Libre</i> por lo cual no es necesario realizar dichos cambios en esas aplicaciones tambien.</p>
                    <p style="font-size: 16px;"> Al ingresar un nuevo producto es importante recordar que el titulo del mismo debera de ser igual o menor a 60 caracteres, ya que <i>Mercado Libre</i> requiere un titulo de esas dimensiones.</p>
                    <p style="font-size: 16px;"> Por otro lado es importante tomar en cuenta que al momento de publicar algun producto en <i> Mercado Libre </i> se tomaran las fotografias que se ingresen en <i>WooCommerce</i> ademas de la descripcion que se ingreso ahi mismo.</p>
                    <p style="font-size: 16px;">Es preciso recordar que solo los productos con un precio menor o igual a 470 pesos tendran disponible la opcion de <i> envio gratis.</i></p>
                    <p style="font-size: 16px;">
                    <a href="?page=mkf-onboarding"> Hacer onboarding </a>   
                </div>
            </div>
            <a href="#onboarding"> Ir arriba </a> 
        </div>
        <!-- Tab 4 "Preguntas Frecuentes" ----------------------------------------------------------------------------------------------------------->
        <div id="preguntas_frecuentes">
            <h3>Preguntas Frecuentes</h3>
            <p style="font-size: 13px;"> Hemos recopilado un conjunto de preguntas dentro de las que mas nos han hecho en <i>Marketful</i>, te dejamos el indice y todas con una respuesta completa para ti. En caso de no encontrar la respuesta que estas buscando consulta nuestra seccion de <a href="#soporte" onclick="clic(5)">Soporte</a>.</p>
            <div class="row">
                <div class="col" id="tc_1">
                    <h4>Tabla de contenido</h4>
                    <li> <a href="#tc_2">Que es Marketful?</a></li>
                    <li> <a href="#tc_3">Que es Fulfillment?</a></li>
                    <li> <a href="#tc_4">Como funciona el Fulfillment?</a></li>
                    <li> <a href="#tc_5">Cuanto tiempo se tardan en recibir y enviar mis pedidos?</a></li>
                    <li> <a href="#tc_6">Que pasa si se extravia un envio?</a></li>
                    <li> <a href="#tc_7">Que pasa si el pedido llega equivocado?</a></li>
                    <li> <a href="#tc_8">Cual es el esquema de cobro?</a></li>
                    <li> <a href="#tc_9">Como me suscribo?</a></li>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_2">
                    <h4> Que es Marketful?</h4>
                    <p style="font-size: 13px;"> <b>Marketful</b> es el conjunto de herramientas (Shipping, Fulfillment y Seller-Center) que conforman el ecosistema en linea enfocado a manejar puntos criticos para los vendedores, simplificandolos y convirtiendolos en puntod fuertes de su ecosistema de ventas gracias a nuestras multiples herramientas.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_3">
                    <h4> Que es Fulfillment?</h4>
                    <p style="font-size: 13px;"> Fulfillment es un termino empleado en logistica, para definir el proceso que incluye todas las etapas de planificacion, fabricacion, almacenamiento y distribucion desde que se recibe un pedido del cliente, hasta que se le entrega el producto final.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_4">
                    <h4> Como funciona el Fulfillment?</h4>
                    <p style="font-size: 13px;"> Fulfillment es un termino empleado en logistica, para definir el proceso que incluye todas las etapas de planificacion, fabricacion, almacenamiento y distribucion desde que se recibe un pedido del cliente, hasta que se le entrega el producto final.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_5">
                    <h4> Cuanto tiempo se tardan en recibir y enviar mis productos?</h4>
                    <p style="font-size: 13px;"> Al estar dentro del Seller Center y confirmar una venta se despliegan diferentes alternativas de envio, dependiendo del tipo de envio que se haya seleccionado es el tiempo que tardara en iniciar el envio. Ademas es importante tomar en cuenta que el corte de envios es a las 13:00 hrs hora del centro de Mexico, por lo cual un envio posterior a esa hora se reflejara hasta el dia siguiente. En Marketful tus envios estan asegurados, por lo cual cuentas con el soporte de Marketful sin importar lo que pase.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_6">
                    <h4> Que pasa si se extravia un envio?</h4>
                    <p style="font-size: 13px;"> En tal caso, cuentas con nuestro respaldo en todo momento. Dependiendo la situacion podremos rembolsar hasta dar seguimiento con la empresa de envios.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_7">
                    <h4> Que pasa si el pedido llega equivocado?</h4>
                    <p style="font-size: 13px;"> En tal caso sin costo extra tendras apoyo completo para la sustitucion del producto.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_8">
                    <h4> Cual es el esquema de cobro?</h4>
                    <p style="font-size: 13px;"> El pago es mensual en el caso del Seller Center y por producto en stock en caso de Fulfillment.</p>
                </div>
            </div>
            <div class="row">
                <div class="col" id="tc_9">
                    <h4> Como me suscribo?</h4>
                    <p style="font-size: 13px;"> La suscripcion es muy sencilla, por el momento el procedimiento consiste en registrarte via telefonica a los telefonos de Marketful +52 449 392 5230 </p>
                </div>
            </div>
            <a href="#preguntas_frecuentes"> Ir arriba </a> 
        </div>
        <!-- Tab 5 "Soporte" ------------------------------------------------------------------------------------------------------------------------>
        <div id="soporte">
            <h4>Creando un Ticket en Github</h4>
            <p> Ayudanos reportando un error en nuestro repositorio en GitHub. Sigue los pasos y forma parte de esta gran comunidad. <a href="https://github.com/Skepsis-Consulting/wcplugin/wiki" target="_blank"> Clic aqui</a></p>
            <h4>Contacto directo</h4>
            <p>Estamos a tus ordenes a travez de mauricio@marketful.mx o marcanos al +52 449 392 5230</p>
        </div>
    </div>
</div>