<?php
/*
 * Archivo: admin-orders-details.php
 * Ultima edición : 16 de octubre de 2018
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
 * Vista a detalle de las ordenes con todos sus metadatos a la vista.
 *
 */

$id = ""; $id = $_REQUEST['id']; 
$pid = ""; $pid = $_REQUEST['pid']; 
?>

<h3>Vista Detallada</h3>
<?php
// Hacemos la busqueda del producto de la orden
$product = MKF_ProductEntry::GetInstance()->get_order_details($id, $pid); 
foreach ($product[0]['data'] as $key => $detail) 
{
	$path = $detail->item_content;
	$img = strpos($path, 'src="http');
	if($img > 0)
	{
		$jpeg = strrpos($path, '.jpeg" alt="" width="'); 
		$jpg = strrpos($path, '.jpg" alt="" width="'); 
		$inicio = $img + 5; 
		if($jpg > 0)
		{
		  $fin = $jpg - $inicio + 4; 
		  $direc = substr($path, ($inicio), ($fin)); 
		  $jpg = 0;
		}
		elseif($jpeg > 0)
		{
		  $fin =  $jpeg - $inicio + 5;  
		  $direc = substr($path, ($inicio), ($fin)); 
		  $jpeg = 0;
		}
	}
	else
	{
		$inicio = '';
		$fin = '';
		$direc = 'https://www.eu-rentals.com/sites/default/files/default_images/noImg_2.jpg';
	}

	echo '
	<div class="container">
		<div class="cabecera_od">
			<div class="imagen_c">
				<img src="'.$direc.'" width="320px" height="210px">
			</div>
			<div class="main_c">
				<div class="main_name">
					<b> PRODUCTO: </b>'.$detail->item_name.'
				</div>
				<div class="main_orderid">
					<b> NUMERO DE ORDEN: </b>'.$detail->id.'
				</div>
				<div class="main_customername">
					<b> COMPRADOR: </b>'.$detail->customer_name.' '.$detail->customer_lastname.'
				</div>
			</div>
		</div>
		<div class="cuerpo">
		</div>
	</div>
	';
}

 ?>

<script type="text/javascript"></script>
<style type="text/css">
	.container
	{
		padding: 10px;
		margin: 20px 10px;
		border-color: #dee2e6; border-width: .5px; border-style: solid; border-radius: 5px;
	}
		.cabecera_od
		{
			display: grid;
			grid-template-rows: 100%;
			grid-template-columns: 35% 65%;
		}
			.main_c
			{
				border-style: solid; border-color: #dee2e6; border-width: .5px;
			}
</style>
