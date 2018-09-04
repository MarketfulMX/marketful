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

<!-- // creo que sobra  -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script type="text/javascript"></script>

<style type="text/css">
	.contenedor_onb
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
			padding-left: 40px; padding-right: 250px;
			display: grid;
  			grid-template-columns: 100%;
  			grid-template-rows: 30% 40% 30%;
		}
			.lc_titulo
			{
				margin-top: 30px;
				font-size: 80px;
			}
			.lc_tc
			{
				padding-top: 30px;
				font-size: 25px; 
			}
			.lc_boton
			{
				padding-top: 30px;
			}
		.right_container
		{
			display: grid;
			grid-template-columns: 100%;
			grid-template-rows:30% 60%;
		}
	.boton_onb
	{
		font-size: 30px;
		background-color: #B82053;
		border-color: #540C24;
		border-radius: 5px;
		border-width: 1px;
		border-style: solid;
	}
	.img_footer
	{
		float: right;
		margin-right: 7%;
	}
	.titulo
</style>

<div class="contenedor_onb">
	<div class="left_container">
		<div class="lc_titulo">Felicidades!</div>
		<div class="lc_tc">Has llegado lejos, marketful seller center esta casi listo para funcionar, solo nos falta mostrarte la simpleza de su funcionamiento. Preparate en los siguientes minutos aprenderas a administrar tus productos de WooCommerce y poder modificar los atributos de la publicacion de ese producto dentro de Mercado Libre, ¡comenzemos!

</div>
		<div class="lc_boton"><button class="boton_onb"> Comencemos</button></div>
	</div>
	<div class="right_container">
		<div>Vacio</div>
		<div class="rc_lc">Lista de contenido	</div>
	</div>
</div>
<div class="img_footer"><img style="width: 100px; height: 38px;" src="https://raw.githubusercontent.com/Skepsis-Consulting/wcplugin/00f28e9a6a24311ff4d3aea11bd89f1c03d87a41/admin/img/Marketful.jpeg?token=Ajnc0Rrrd4YGKSbhuadXRdrqYR-le5-tks5bmAOMwA%3D%3D"></div>