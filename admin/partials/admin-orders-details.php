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
$id = ""; $id = $_REQUEST['id']; echo $id.' : ';
$pid = ""; $pid = $_REQUEST['pid']; echo $pid;
// Tomar las ordenes
$det = MKF_ProductEntry::GetInstance()->get_order_details($id, $pid);
echo $det;
$details = $det[0];
echo $details->fecha;
 ?>

<script type="text/javascript"></script>
<style type="text/css"></style>

<div class="container">
	<div class="cabecera_od">
		<div class="imagen_c">
			<?php

				$path = $details->item_content;
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

				echo '<img src="'.$direc.'" width="200px" height="145px">';
			?>
		</div>
		<div class="nombre_c">
			<?php
				echo $details->item_name;
			?>
		</div>
	</div>
	<div class="cuerpo">
	</div>
</div>