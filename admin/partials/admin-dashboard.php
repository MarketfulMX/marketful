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
                    $('#2').attr('class','nav-link'); $('#instalacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 2:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link active'); $('#instalacion').css('display','inline');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 3:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#instalacion').css('display','none');
                    $('#3').attr('class','nav-link active'); $('#instrucciones').css('display','inline');
                    $('#4').attr('class','nav-link'); $('#preguntas_frecuentes').css('display','none');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 4:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#instalacion').css('display','none');
                    $('#3').attr('class','nav-link'); $('#instrucciones').css('display','none');
                    $('#4').attr('class','nav-link active'); $('#preguntas_frecuentes').css('display','inline');
                    $('#5').attr('class','nav-link'); $('#soporte').css('display','none');
                    break;
                case 5:
                    $('#1').attr('class','nav-link'); $('#dashboard').css('display','none');
                    $('#2').attr('class','nav-link'); $('#instalacion').css('display','none');
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
    .head
    {
        margin: 20px;
    }
    ul a
    {
        text-decoration: none;
    }
    .contenedor div
    {
        display: none;
    }
    #dashboard
    {
        display:inline;
        margin-top: 20px;
        margin-left: 100px;
    }
        #dashboard p
        {
            max-width: 90%;
            margin-right: auto;
        }
        #dashboard li
        {
            font-size: 13px;   
            max-width: 90%;
            margin-right: auto;
        } 
    
</style>
<div class="head"> <h3> Dashboard </h3> </div>

<ul class="nav nav-tabs tab-superior" id= tab-superior>
    <li class="nav-item"><a href="#" id="1" class="nav-link active" onclick="clic(1)" >Inicio</a></li>
    <li class="nav-item"><a href="#" id="2" class="nav-link" onclick="clic(2)" >Instalación</a></li>
    <li class="nav-item"><a href="#" id="3" class="nav-link" onclick="clic(3)" >Instrucciones</a></li>
    <li class="nav-item"><a href="#" id="4" class="nav-link" onclick="clic(4)" >Preguntas Frecuentes</a></li>
    <li class="nav-item"><a href="#" id="5" class="nav-link" onclick="clic(5)" >Soporte</a></li>
</ul>

<div class="contenedor">
    <div id="dashboard">
        <img style="max-width: 30%; margin-left: -131px; margin-top: 20px;"src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png">
        <p>Ponemos a tu alcance una poderosa herramienta tecnológica diseñada para administrar todas tus plataformas de venta en línea y sincronizar la Información de tus publicaciones, órdenes de compra e inventario.</p>
        <h3>marketful seller center &#160;</h3>
        <li> Marketful Seller Center Es una poderosa herramienta open source que te ayuda a unir todos tus canales de venta en un solo lugar de la manera más sencilla e intuitiva, lo cual facilitara tu experiencia de venta y lo más importante la de tus clientes. </li>
        <li> Controla todos tus canales de venta con marketful seller center puedes administrar todas tus cuentas de venta en un solo lugar.</li>
        <li> Cambios controlados Los cambios dentro de Marketful Seller Center se reflejan en todas tus plataformas.</li>
        <li> Adiós complicaciones Con Marketful Seller Center se acabaron las horas de modificar productos iguales en plataformas diferentes. </li>
        <img style="max-width: 90%; margin-right: auto;" src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/df54ec67afd2c73ac1aada2c683ab07e6c1a45ff/Documentacion/img/page-02(3).jpeg?token=Ajnc0XzeluUqr5JuKkQhvLs-1kbsUyP8ks5bjW41wA%3D%3D">
        <h3> Versión 1.0</h3>
        <li>Publicaciones Con *Marketful Seller Center *simplicidad es la norma, todos tus productos en un solo lugar y esto se refleja en el poder de publicar tus productos desde un solo lugar y esto se refleje en todos tus canales de venta, con Marketful Seller Center estas en buenas manos.</li>
        <li>Ordenes Con Marketful Seller Center tus ordenes de envió jamás estuvieron en tan buenas manos. Monitorea, da seguimiento y da soporte a tus clientes desde un solo lugar, podrás monitorear envíos no importa en donde realizaste la venta, tu Seller Center lo tiene bajo control.</li>
        <li>Preguntas Imagina algo tan sencillo como un centro único de preguntas en donde podrás administrar todos tus canales de comunicación con tus clientes desde una sola pantalla, esto y más te ofrece Marketful Seller Center.</li>
        <li>Comunicación posventa Dentro de Marketful Seller Center podrás mantener contacto directo con tus clientes después de la venta y sin importar el canal por donde se haya realizado.</li>
        <img style="max-width: 90%; margin-right: auto;"src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/df54ec67afd2c73ac1aada2c683ab07e6c1a45ff/Documentacion/img/page-01(4).jpeg?token=Ajnc0Tw_tq-2fUpCkVbukToDDkeKeoVfks5bjW8SwA%3D%3D">
    </div>
    <div id="instalacion">
        <p>Contenido de instalacion</p>
        <img src="https://www.marketful.mx/assets/Logo_marketful-b973bdcabe50755f3a07dc2b2fae41c501eecb4e06756215b6735f4fd5616c81.png">
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