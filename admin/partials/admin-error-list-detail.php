<?php
/*
 * Archivo: admin-error-list-detail.php
 * Ultima edición : 3 de septiembre de 2018
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
 * Pagina que muestra en detalle la informacion relacionada a un error que se recibe
 * desde la vista admin-error-list.php.
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

</script>

<style type="text/css">
	body{
		font-family: sans-serif;
	}
	.boton_eld
    {
    	background-color:#E2E5C4; 
        height: 25px; 
        width: auto; 
        border-style: solid; 
        border-color: #7E7F6D; 
        border-width: 2px;
        border-radius: 3px;
        font-size: 14px;
        padding: 5px;
        color: black;
        text-decoration: none;
        cursor: pointer;
        font-family: sans-serif;
    }
    	.boton_eld:hover
    	{
    		border-color: #7E7F6D;
        	background-color: #BCBFA3;
        	text-decoration: none;
    	}
    	.boton_eld:active
    	{
    		border-color: #7E7F6D;
        	background-color: #BCBFA3;
        	text-decoration: none;
    	}
</style>

<div>
	<div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> <a class="boton_eld" href="?page=mkf-error-list">Volver</a> </div>
	<div class="er_titulo">
		<h3>Error: <?php echo $_GET['error']; ?></h3>
	</div>
	<div class="contenedor_eld">
		<div class="informacion_eld">
			<h3>Tipo de error: 200</h3>
			<h3>ID de Error en WooCommerce: 586499<?php echo $_GET['error']; ?></h3>
			<h3>ID del producto en WooCommerce: <?php echo $_GET['error']; ?> </h3>
			<h3>Fecha de Error: 09/03/2018 12:05:13</h3>
			<h3><a class="boton_eld" href='http://localhost/wp/wp-admin/post.php?post=<?php echo $_GET['error']; ?>&action=edit' target='_blank'> Ver en WooCommerce </a><a class="boton_eld" href=''> Ver en Mercado Libre</a></h3>
		</div>
		<div class="detalles_eld">

		</div>
	</div>
</div>