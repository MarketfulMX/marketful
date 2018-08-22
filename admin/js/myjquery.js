console.log("entramos en myjquery.js")


function getDescription( product_id){
	console.log('entramos en get descripcion')
	var descripcion = $('#footer_mostrar_texto');
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
         
      },
      error: function(response) 
      { 
          console.log("fracaso")
          console.log(response)   
      },
  }); // cierra ajax
        
}
