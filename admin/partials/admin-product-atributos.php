<?php
/*
 * Archivo: admin-product-atributos.php
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
	#top
	{
		border-color: #dee2e6;
		border-width: .5px;
		border-radius: 3px;
		border-style: solid;
		width: 95%; margin-left: 2%;
		padding: 1%;
	}
	#buttom
	{
		border-color: #dee2e6;
		border-width: .5px;
		border-radius: 3px;
		border-style: solid;
		width: 95%; margin-left: 2%;
		padding: 1%;
	}
	.tabla_atr
	{
		margin: 20px;
		text-align: center;
		width: 100%;
	}
	tr:nth-child(even) 
	{
		background-color:#f2f2f2;
	}
	tr:nth-child(odd) 
	{
		background-color:#fbfbfb;
	}
	.boton_atr
	{
		background-color:#E2E5C4; 
        border-style: solid; 
        border-color: #7E7F6D; 
        border-radius: 3px;
        cursor: pointer;
	}
		.boton_atr:hover
		{
			border-color: #7E7F6D;
            background-color: #BCBFA3;
		}
		.boton_atr:active
		{
			border-color: #3F4036;
            background-color: #BCBFA3;
		}
</style>

<div class="head_ord">
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
  <h3> Agrega y modifica los atributos de tus publicaciones </h3>
</div>

<div class="contenedor">
	<table class="tabla_atr" id="top">
		<tr>
			<th>
				PASO
			</th>
			<th>
				HERRAMIENTA
			</th>
		</tr>
		<tr>
			<td>
				Generar un nuevo formato
			</td>
			<td>
				<button class="boton_atr"> Nuevo Formato</button>
			</td>
		</tr>
		<tr>
			<td>
				Descargar el formato para modificarlo
			</td>
			<td>
				<a href="#">Descargar Formato</a>
			</td>
		</tr>
		<tr>
			<td>
				Cargar el formato con las modificaciones
			</td>
			<td>
				<input class="boton_atr" type="file" name="Cargar">
			</td>	
		</tr>
	</table>	
	<table clas="tabla_atr" id="buttom">
		<tr>
			<th>
				PUBLICACION
			</th>
			<th>
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