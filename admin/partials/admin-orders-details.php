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
$producto = ""; $producto = $_REQUEST['id'];
// Tomar las ordenes
$details = MKF_ProductEntry::GetInstance()->get_order_details($producto);
 ?>

<script type="text/javascript"></script>
<style type="text/css"></style>

<div class="container">
	<div class="cabecera_od">
		ORDEN: <?php echo $producto; ?>
	</div>
	<div class="cuerpo">
	</div>
</div>