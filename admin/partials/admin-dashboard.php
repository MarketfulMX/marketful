<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script>
    function clic(num)
    {
        switch (num)
            {   
                case 1:
                    $('#1').attr('class','nav-link active'); $('#dashboard').css('display','inline');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 2:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link active'); $('#activacion').css('display','inline');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 3:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link active'); $('#instrucciones').css('display','inline');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 4:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link active'); $('#preguntas_frecuentes').css('display','inline');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 5:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#activacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link active'); $('#soporte').css('display','inline');
                    break;
                default :
                    break;
            }
    }
</script>

<style>

body
{background-color: #F8F5FF;}
    #alfav, #nuevov
    {
        border-radius: 3px;
        background-color: #E8612F;
        color: white;
        padding: 5px;
        font-size: 10px;
        vertical-align: middle;
    }
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
    ul a
    {
        text-decoration: none;
    }
    #activacion, #instrucciones, #preguntas_frecuentes, #soporte
    {
        display: none;
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
            #db_1, #db_2
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
    #boton_db,#boton_ac
    {
        border-color: white; border-style: solid; border-width: 2px; border-radius: 4px;
        box-shadow: 5px 10px;
        color: white; 
        background-color: #A06DE5;
        padding: 8px;
        cursor: pointer;
    }
        #boton_db
        {
            padding: 20px;
            font-size: 18px;
            margin-top: 10px;
        }
        #boton_db:hover, #boton_ac:hover
        {
            border-color: #F9F3FF;
            background-color: #8359BD;
        }
        #boton_db:active, #boton_ac:active
        {
            border-color: #F9F3FF;
            background-color: #8359BD;
        }
    #boton_ac
    {
        background-color: #44BBFF;
        padding: 5px;
        text-decoration: none;
        margin-right: 5px;
        height: 20px;
    }
        #boton_ac:hover
        {
            background-color: #4980CC;
        }
        #boton_ac:active
        {
            background-color: #4980CC;
        }
    #texto_ac
    {
        width: 150px; height: 30px;
        font-size: 24px;
        border-color: #3964A1; border-style: solid; border-width: .5px; border-radius: 2px;
        background-color: #FFFFFF;
    }
        #tecto_ac:hover
        {
            border-width: .5px;
        }
        #texto_ac:active
        {
            border-width: .5px;
        }
    
</style>
<div class="head"> <h3> Dashboard <b id="alfav"> v1.0.0 </b></h3> </div>
<ul class="nav nav-tabs tab-superior" id= tab-superior style="max-width: 98%;">
        <li class="nav-item"><a href="#" id="1" class="nav-link active" onclick="clic(1)" >Inicio</a></li>
        <li class="nav-item"><a href="#" id="2" class="nav-link" onclick="clic(2)" >Activacion</a></li>
        <li class="nav-item"><a href="#" id="3" class="nav-link" onclick="clic(3)" >Instrucciones</a></li>
        <li class="nav-item"><a href="#" id="4" class="nav-link" onclick="clic(4)" >Preguntas Frecuentes</a></li>
        <li class="nav-item"><a href="#" id="5" class="nav-link" onclick="clic(5)" >Soporte</a></li>
    </ul>
<div class="maximo">
    <div class="contenedor">
        <div id="dashboard">
            <div class="row">
                <div class="col" id="db_1">
                    <img style="max-height:20%; margin-left: 0px; margin-top:0px;"src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png"> <button id="boton_db" onclick="clic(2)"> Activa tu tienda </button>
                    <p><b>Marketful Seller Center</b>, revolucionara la manera en la que conectas con tus clientes de <i>WooCommerce</i> y <i>MercadoLibre</i>.  Te ofrecemos un entorno dedicado a hacer tu trabajo mas sencillo, eficiente y personalizado. </p>                   <img style="max-width: 100%; margin-right: auto; border-radius: 3px; padding-bottom: 20px; " src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/dfff438a4546eb0fe69fc3e01e9dba2bcccacf03/Documentacion/img/screen.gif?token=Ajnc0cgQDdX9entMvkCFqQTVH7T9bKW0ks5bjqWPwA%3D%3D">
                </div>
                <div class="col" id="db_2">
                    <h3> Version 1.0 <b id="nuevov">NUEVO</b></h3>
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
                    <li> <b>Marketful Seller Center</b> Es una poderosa herramienta open source que te ayuda a unir todos tus canales de venta en un solo lugar de la manera mas sencilla e intuitiva, lo cual facilitara tu experiencia de venta y lo mas importante la de tus clientes. </li>
                    <li> Controla todos tus canales de venta con marketful seller center puedes administrar todas tus cuentas de venta en un solo lugar.</li>
                    <li> Cambios controlados Los cambios dentro de Marketful Seller Center se reflejan en todas tus plataformas.</li>
                    <li> Adios complicaciones Con Marketful Seller Center se acabaron las horas de modificar productos iguales en plataformas diferentes. </li>
                </div>
                <div class="col" id="db_4">
                    <h3>Empieza ahora</h3>
                    <img style="max-width: 100%; margin-right: auto;"src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/df54ec67afd2c73ac1aada2c683ab07e6c1a45ff/Documentacion/img/page-01(4).jpeg?token=Ajnc0Tw_tq-2fUpCkVbukToDDkeKeoVfks5bjW8SwA%3D%3D">
                </div>
            </div>
        </div>
        <div id="activacion">
            <div>
                <h3>Bienvenido a la activacion</h3>
                <p> El proceso de activacion consiste en los siguientes 3 pasos: </p>
                <li> Da clic <a id="boton_ac" target="_blank" href="https://www.marketful.mx/login"> aqui </a> para registrate en Marketful.</li>
                <li> Ya te has registrado, ahora ingresa el link de tu tienda. <input type="text" id="texto_ac" placeholder="           tu link">.marketful.mx</li>
                <!--li> Por ultimo de manera opcional, logueate con tu pagina de Mercado Libre.</li-->
            </div>
        </div>
        <div id="instrucciones">
            <p>Contenido de instrucciones</p>
            <img src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png">
        </div>
        <div id="preguntas_frecuentes">
            <p>Contenido de preguntas frecuentes</p>
            <img src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png">
        </div>
        <div id="soporte">
            <p>Contenido de soporte</p>
            <img src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png">
        </div>
    </div>
</div>
