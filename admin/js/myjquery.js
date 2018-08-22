console.log("entramos en myjquery.js")


function getDescription(descripcion, product_id){
  jQuery.ajax(
  {
      type: 'post',
      url: ajaxurl,
      dataType: 'json',
      data: 
      { 
          descripcion: descripcion, 
          product_id: product_id, 
          action: 'desc_comun_ajax'
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
