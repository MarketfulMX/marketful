<?php
/*
 * Archivo: admin-product-atributos.php
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
	.contenedor
	{
		border-color: #dee2e6;
		border-width: .5px;
		border-radius: 3px;
		border-style: solid;
		width: 95%; margin-left: 2%;
		padding: 1%;
	}
</style>

<div class="head_ord">
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
  <h3> Atributos </h3>
</div>

<div class="contenedor">
	<table>
		<tr>
			<th style="width: 40%;">
				PASO
			</th>
			<th style="width: 60%;">
				HERRAMIENTA
			</th>
		</tr>
		<tr>
			<td>
				1
			</td>
			<td>
				2
			</td>
		</tr>
	</table>	
	<table>
		<tr>
			<th style="width: 40%;">
				PUBLICACION
			</th>
			<th style="width: 60%;">
				RESULTADO
			</th>
		</tr>
		<tr>
			<td>
				1
			</td>
			<td>
				2
			</td>
		</tr>
	</table>
</div>