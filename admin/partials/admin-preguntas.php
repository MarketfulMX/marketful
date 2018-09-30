<?php
/*
 * Archivo: admin-ppreguntas.php
 * Ultima edición : 27 de septiembre de 2018
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
 * Vista general de los mensajes entre los clientes y el seller.
 * Puede ver los mensajes que ha enviado y recibido en una interfaz
 * amigable en forma de chat.
 */
 $imgSrc   = plugins_url( '../img/Marketful.png', __FILE__ );
?>

<!-- Mandamos llamar a las libreruas que utilizaremos -->
<script type = "text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 

<!-- Bootstrap CSS and JS-->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<!-- Fonstawesome -->
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

<script type="text/javascript">
	/** 
	 * @funcion que de manera automatica hace scroll hacia abajo en el div mensajes
	 * para mostrar los mensajes mas nuevos
	 */
	jQuery(function()
    {
        $(".mensajero").animate({ scrollTop: $('.mensajero')[0].scrollHeight}, 500);
    });

	function add_msj()
	{
		var d = new Date();
		$('.mensajero').append('<div><div class="mensaje_r">'+$("#textarea").val()+'</div><div class="meta_mensaje_r">Lunes 10 de Mayo de 2018 13:06:08 </div></div>')
		$('#textarea').val('');
		$(".mensajero").animate({ scrollTop: $('.mensajero')[0].scrollHeight}, 300);

	}
</script>

<style type="text/css">
	.contenedor
	{
		padding: 10px;
		display: grid;
	    grid-template-columns: 70% 30%;
	    grid-template-rows: 90% 10%;
	}
		.mensajero
		{
			height: 100%;
			margin: 5px 20px;
			padding: 20px 10px;
			border-color: #7E7F6D; border-width: 1px; border-style: solid; border-radius: 10px 0px 0px 0px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
			background-color: #EFF2EF;

			display: grid;
			grid-template-columns: 100%;
			grid-template-rows: auto;

			overflow-y: scroll; 
			max-height: 55vh;
		}
			.mensaje_r
			{
				border-color: #878787; border-radius: 40px 0px 40px 40px; border-style: solid; border-width: 1px;
				background-color: #878787;
				box-shadow: 0 1px 2px rgba(0,0,0,0.20);
				color: white; text-shadow: 0px 0px 1px #fff;
				float: right;
				padding: 5px 20px 5px 10px;
				margin-right: 10px;	
				margin-bottom: 10px;
				margin-left: 20%;
				text-align: right;
			}
				.meta_mensaje_r
				{
					float: right;
					font-size: 50%; 
					margin-right: 10px;	
					margin-bottom: 10px;
					margin-left: 80%;
					text-align: right;
				}
			.mensaje_l
			{
				border-color: #6E4E6D; border-radius: 0px 40px 40px 40px; border-style: solid; border-width: 1px;
				background-color: #6E4E6D;
				box-shadow: 0 1px 2px rgba(0,0,0,0.20);
				color: white; text-shadow: 0px 0px 1px #fff;
				float: left;
				padding: 5px 10px 5px 20px;
				margin-left: 10px;
				margin-right: 20%;
				margin-bottom: 10px;
				text-align: left;
			}
				.meta_mensaje_l
				{
					float: left;
					font-size: 50%; 
					margin-left: 10px;
					margin-right: 80%;
					margin-bottom: 10px;
					text-align: left;
				}
		.informacion
		{
			margin: 5px 10px 5px 5px;
			border-color: #7E7F6D; border-width: 1px; border-style: solid; border-radius: 0px 10px 10px 0px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
			background-color: #EFF2EF;
			padding: 5px;
			height: 100%;	
		}
			.inf_titulo
			{
				font-size: 200%;
				color: #444544;
			}
			.inf_cuerpo
			{
				display: grid;
				grid-template-columns: 50% 50%;
				grid-template-rows: 40% 30% 30%;
				margin: 10px;
				font-size: 80%;
			}
		.nuevo_msj
		{
			border-color: #7E7F6D; border-width: 1px; border-style: solid; border-radius: 0px 0px 0px 10px;
			box-shadow: 0 2px 10px rgba(0, 0, 0, 0.25);
			background-color: #EFF2EF;
			height: auto;
			margin: 5px 20px;
			padding: 0px;
			padding-top: 4px;
			padding-left: 4px;
			display: grid;
			grid-template-rows: 100%;
			grid-template-columns: 92% 8%;
		}
	.boton
	{
		border-color: #6E4E6D;border-radius: 25px 25px 25px 25px; border-style: solid;
		background-color: #6E4E6D;
		color: white;
		height: 50px;
		width: 50px;
		margin-top: 5px;
	}
		.boton:hover
		{
			background-color: #402D3F;
			border-color: #402D3F;
			cursor: pointer;
		}
</style>
<div class="head_ord">
  <div class="imagen"><?php echo "<img src='{$imgSrc}' > "; /*Se hace echo de la imagen*/?></div>
  <h3> Preguntas</h3>
</div>
<div class="contenedor">
	<div class="mensajero">

		<?php 
		$mensaje = 'Hola este es un mensaje de prueba muy largo para mostrar que el mensajero se ve de manera correcta en esta situacion en la cual los mensajes seran muy largos.';
		$meta = 'Lunes 20 de Mayo de 2018 13:00:03 ';
		for($c =0; $c <100; $c++)
		{
			if($tipo == 'r')
			{
				$tipo = 'l';
			}
			else
			{
				$tipo = 'r';
			}
			echo'
			<div>
				<div class="mensaje_'.$tipo.'">
					'.$mensaje.' 
				</div>
				<div class="meta_mensaje_'.$tipo.'">
					'.$meta.'
				</div>
			</div>
			';
			echo'
			<div>
				<div class="mensaje_'.$tipo.'">
					'.$mensaje.' 
				</div>
				<div class="meta_mensaje_'.$tipo.'">
					'.$meta.'
				</div>
			</div>
			';
			echo'
			<div>
				<div class="mensaje_'.$tipo.'">
					:)
				</div>
				<div class="meta_mensaje_'.$tipo.'">
					'.$meta.'
				</div>
			</div>
			';
		}
		?>
	</div>
	<div class="informacion">
		<div class="inf_titulo">
			<?php echo 'Nombre Muy Largo del Cliente'; ?>
		</div>
		<div class="inf_cuerpo">
			<div class="inf_1">
				Dato 1
			</div>
			<div class="inf_1">
				Dato 2
			</div>
			<div class="inf_1">
				Dato 3
			</div>
			<div class="inf_1">
				Dato 4
			</div>
		</div>
	</div>
	<div class="nuevo_msj">
		<div>
			<textarea id="textarea"rows="2" cols="94"> </textarea>
		</div>
		<div>
			<button class="boton" onclick="add_msj()"><i class="fas fa-location-arrow"></i></button>
		</div>
	</div>
</div>