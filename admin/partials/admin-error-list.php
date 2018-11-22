<?php
/*
 * Archivo: admin-error-list.php
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
 * Pagina que mostrara la lista de errores que emergen cuando hay alguna discordancia
 * entre la informacion de Mercado Libre y la del plugin de WooCommerce.
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
	function ver_detalles(id)
	{
		var url = "?page=mkf-error-list-detail&error=" + id;
    	window.location.href = url;
	}
</script>

<style type="text/css">
	body{
		font-family: sans-serif;
	}
	.imagen{margin: 15px;}
	.er_titulo{
		text-align: left;
		margin: 20px;
	}
	.er_titulo
	{
		width: 30%;
		margin: 0% 35%;
		text-align: center;	
	}
	.contenedor_el
	{
		text-align: center;
		border-color:  #dee2e6;
		border-width: 1px;
		border-top-width: 5px;
		border-style: solid;
		width: 40%;
		margin: 0px 30%;
		border-radius: 5px;
	}
	.table
    {            
        font-family: sans-serif; 
        font-size: 10px;
        width: 100%;
        text-align: center;
        vertical-align: middle;
    }
    td .input
    {
        width: 50px; height: 25px;
        border-radius: 3px; 
        border-color: #7E7F6D;
    }
    .boton_el
    {
    	background-color:#E2E5C4; 
        height: 25px; 
        width: auto; 
        border-style: solid; 
        border-color: #7E7F6D; 
        border-radius: 3px;
        font-size: 12px;
        cursor: pointer;
        font-family: sans-serif;
    }
    	.boton_el:hover
    	{
    		border-color: #7E7F6D;
        	background-color: #BCBFA3;
        	text-decoration: none;
    	}
    	.boton_el:active
    	{
    		border-color: #7E7F6D;
        	background-color: #BCBFA3;
        	text-decoration: none;
    	}
    	.boton_el:focus
    	{
    		text-decoration: none;
    	}
</style>

<div >
	<div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?> </div>
	<div class="er_titulo">
		<h3>Error List Log</h3>
	</div>
	<div class="contenedor_el">
		<div class="table">
			<table>
				<tr>
					<th> Tipo de Error
					</th>
					<th> Fecha de Error
					</th>
					<th> Id WooCommerce
					</th>
					<th> Ver Error
					</th>
				</tr>
				<?php
					$i = 0;
					for($i =13; $i < 30; $i++)
					{
						echo '
						<tr>
							<td>
								200
							</td>
							<td>
								09/03/2018 12:05:13
							</td>
							<td>
								586499'.$i.'
							</td>
							<td>
								<a style="text-decoration: none;" href="?page=mkf-error-list-detail&error='.$i.'" target="_blank"><button class="boton_el" id="detalles_'.$i.'""> Ver detalles </button></a>
							</td>
						</tr>
						';
					}
				?>
			</table>
		</div>
	</div>
</div>