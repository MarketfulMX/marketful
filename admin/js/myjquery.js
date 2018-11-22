console.log("entramos en myjquery.js")


function getDescription( product_id){
	console.log('entramos en get descripcion');
	console.log(product_id);
	var descripcion = $('#footer_textarea').val();
	console.log(descripcion);
	$('#status_cambios').html('Guardando cambios...');
  jQuery.ajax(
  {
      type: 'post',
      url: ajaxurl,
      dataType: 'json',
      data: 
      { 
          descripcion: descripcion, 
          product_id: product_id, 
          action: 'desc_comun'
      },
      success: function(response) 
      { 
          console.log("exito")
          console.log(response)
          $('#footer_mostrar_texto').html(response.data[0]);
          $('#status_cambios').html('Cambios guardados!');
         
      },
      error: function(response) 
      { 
          console.log("fracaso")
          console.log(response)   
          $('#status_cambios').html('Error!');
      },
  }); // cierra ajax
        
}
