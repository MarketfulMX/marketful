<!-- 
 * Archivo: admin-onboarding.php
 * Ultima edición : 4 de septiembre de 2018
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
 * Vista con el contenido del onboardig introductorio al WooCommerce Seller Center
 * 
-->
<?php
	error_reporting(E_ERROR | E_WARNING | E_PARSE); // Suprime errores de prueba
	/**
	 * @script En caso de que el onboarding ya se haya completado, se recibira como parametro 
	 * 'fin' el cual al valer 1 buscara el producto marketful_descripcion_comun y le actualizara
	 * el campo post_name a finished para identificar que el usuario ya ha completado el 
	 * onboarding.
	 */
	$fin = $_GET['fin'];
	if($fin == 1)
	{
		$products = wc_get_products( array(
        'title' => 'marketful_descripcion_comun',
	    ));
	    if(isset($products[0]))
	    {
	        $producto = $products[0]->get_id();
	        $actualizar = array(
	      	'ID' => $products[0]->get_id(),
	      	'post_name' => 'finished',
	  		);
	   	}
		$ready = wp_update_post($actualizar);
		echo '<script> console.log("Actualizado '.$ready.'"); </script>';
	}
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
     * @funcion create_test_product()
     * Crea el producto de prueba.
     */    
     function create_test_product()
     {
        console.log('Estamos creando el producto de prueba');
        jQuery.ajax(
            {
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data:
                {
                    action: 'test'
                },
                success: function(response)
                {
                    console.log('Hecho, se creo el producto de prueba.');
                },
                error: function(response)
                {
                    console.log('No se pudo crear el producto de prueba.');
                }
            });
     }
    /**
     * @funcion delete_test_product()
     * Borra el producto de prueba
     */
     function delete_test_product()
     {
        console.log('Estamos borrando el producto de prueba');
        jQuery.ajax(
            {
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data:
                {
                    action: 'test_delete'
                },
                success: function(response)
                {
                    console.log('Hecho, se borro el producto de prueba.');
                },
                error: function(response)
                {
                    console.log('No se pudo borrar el producto de prueba.');
                }
            });
     }

    /**
	 * @funcion display(@parametro: pagina)
	 * 
	 * Recibe el numero de pagina que se quiere mostrar en pantalla
	 */
	 function display(numero)
	 {
	 	$('.panel_'+(numero - 1)).css('display','none');
	 	window.setTimeout("temp("+numero+")", 500);
	 }
	 	/**
	 	 * @funcion temp(@parametro: numero)
	 	 * Muestra un panel dependiendo el parametro que se le envia
	 	 */
		 function temp(numero)
	 	 {
	 		$('.panel_'+numero).css('display','grid');	
	 	 }
</script>

<style type="text/css">
	.onb
	{
		border-color:#707070;
		border-style: solid;
		border-width: 1px;
		border-radius: 5px;
		margin-left: 50px; margin-right: 50px; margin-top: 50px;

		display: grid;
  		grid-template-columns: 65% 35%;
	}
		.left_container
		{
			padding-left: 40px; padding-right: 150px;
			display: grid;
  			grid-template-columns: 100%;
  			grid-template-rows: 30% 40% 30%;
		}
			.lc_titulo
			{
				line-height: 1;	
				margin-top: 30px;
				font-size: 60px;
			}
			.lc_tc
			{
				padding-top: 30px;
				font-size: 20px; 
			}
			.lc_boton
			{
				padding: 40px;
				padding-top: 50px;
			}
		.right_container
		{
			padding-right: 40px;
			display: grid;
			grid-template-columns: 100%;
			grid-template-rows:30% 60%;
		}
			.rc_lc
			{
				margin-top: -10px;
				font-size: 12px;
			}
	.panel_1
	{

	}
	.panel_2
	{
		display: none;
	}
	.panel_3
	{
		display: none;
	}
	.panel_4
	{
		display: none;
	}
	.boton_onb
	{
		font-size: 25px;
		background-color: #B82053;
		border-color: #540C24;
		border-radius: 5px;
		border-width: 1px;
		border-style: solid;
		color: white;
		padding: 10px;
		box-shadow: 0 5px 5px rgba(0, 0, 0, 0.25);
		cursor: pointer;
	}
		.boton_onb:hover
		{
			background-color: #9C1B46;
		}
	.img_footer
	{
		float: right;
		margin-right: 7%;
	}
	.titulo
</style>

<div class="contenedor_onb">
	
	<div class="onb panel_<?php if($fin == 1){echo '1';}else{echo '4';} ?>">
		<div class="left_container">
			<div class="lc_titulo">Felicidades! has completado el Onboarding</div>
			<div class="lc_tc">
				Ahora estas listo para comenzar a utilizar Marketful Seller Center, si tienes alguna duda contacta a soporte.
			</div>
			<div class="lc_boton"><a style="text-decoration: none; color: white;" href="?page=mkf_dashboard"<button class="boton_onb"> Terminar</button></a></div>
		</div>
		<div class="right_container">
			<div></div>
			<div class="rc_lc">
				<p>El onboarding se centra en mostrarte las funciones princiapes per sabermos que siempre podemos querer mas informacion, en tal caso contactanos al correo mauricio@marketful.mx y te responderemos cuaquier duda.</p>
			</div>
		</div>
	</div>

	<div class="onb panel_<?php if($fin != 1){echo '1';}else{echo'2';} ?>">
		<div class="left_container">
			<div class="lc_titulo">Felicidades!</div>
			<div class="lc_tc">
				Has llegado lejos, marketful seller center esta casi listo para funcionar, solo nos falta mostrarte la simpleza de su funcionamiento. Preparate en los siguientes minutos aprenderas a administrar tus productos de WooCommerce y poder modificar los atributos de la publicacion de ese producto dentro de Mercado Libre, ¡comenzemos!
			</div>
			<div class="lc_boton"><button class="boton_onb" onclick="display(2);"> Iniciar Onboarding</button></div>
		</div>
		<div class="right_container">
			<div></div>
			<div class="rc_lc">
				<p>En este On boarding aprenderemos lo siguiente:</p>
				<li> 1) Como se visualizan los productos de WooCommerce dentro de Marketful.</li>
				<li> 2) Como asignar un status a la publicacion en Mercado Libre de un producto.</li>
				<li> 3) Como asignar una categoria valida a tus productos.</li>
				<li> 4) Como asignar el tipo de exposicion que tendra una publicacion en Mercado Libre.</li>
				<li> 5) Aprenderas ademas las diferentes validaciones que tiene un producto para poder crear una publicacion en Mercado Libre de dicho producto.</li>
				<p>Recuerda que cualquier duda adicional sera resuelta por nuestro equipo en el momento que lo solicites. Consulta nuestro sitio de SOPORTE para mas informacion.</p>
			</div>
		</div>
	</div>

	<div class="onb panel_2">
		<div class="left_container">
			<div class="lc_titulo">Vamos a crear un producto de prueba</div>
			<div class="lc_tc">
				Crearemos un producto de prueba directo en tu base de datos de WooCommerce para empezar este OnBoarding, Usaremos este producto para todo el Onboarding con datod ficticios, no te preocupes, al terminar el Onboarding podras borrarlo.
			</div>
			<div class="lc_boton"><button class="boton_onb" onclick="create_test_product();display(3);">Crear producto</button></div>
		</div>
		<div class="right_container">
			<div></div>
			<div class="rc_lc">
				
			</div>
		</div>
	</div>

	<div class="onb panel_3">
		<div class="left_container">
			<div class="lc_titulo">Lo hemos creado, ahora vamos a verlo</div>
			<div class="lc_tc">
				Ya hemos creado un producto de prueba, ahora veremos en donde podemos verlo de manera sencilla y posteriormente podremos editar todos los atributos de su publicacion.
			</div>
			<div class="lc_boton"><a style="text-decoration: none;"href="?page=mkf-product-entries&keyword=Producto+de+Prueba&onb=1"><button class="boton_onb">Ver producto</button></a></div>
		</div>
		<div class="right_container">
			<div></div>
			<div class="rc_lc">
				
			</div>
		</div>
	</div>
</div>
<div class="img_footer"><img style="width: 100px; height: 38px;" src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/00f28e9a6a24311ff4d3aea11bd89f1c03d87a41/admin/img/Marketful.jpeg?token=Ajnc0Rrrd4YGKSbhuadXRdrqYR-le5-tks5bmAOMwA%3D%3D"></div>
<!-- //Funcion para borrar producto de prueba// onclick="delete_test_product()" -->