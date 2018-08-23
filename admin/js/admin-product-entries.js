/********************************************************************************************
 * @Funciones y @Scripts de admin-product-entries.php 
 * admin-product-entries.js
 * 
 */


/*
 * - @Función JQuery/Ajax: cambioStatus(@string,@string)
 * Esta función recibe dos @parámetros que son el id del producto y el tipo de
 * metadato que modificara.
 * La @función console log muestra en la consola del navegador la información del objeto
 * product_id.
 *
 * Se crea una variable con el valor del select que se modificó, se obtiene dicha
 * información obteniendo el id del select con el tipo de metadato que se modificara
 * más guion bajo más el id del producto.
 *
 * Se envía con console.log el valor de key
 * Se crea una función AJAX que pide el tipo de solicitud que se hace 'POST'
 * y se envían los @parámetros además que se manda a llamar a la función de PHP 
 * my_theme_ajax_submit. Se le envían los @parámetros: product_id, value y key .
 *
 * La @función Ajax que nombramos response nos responde a la solicitud con un archivo Json.
 *
 * En caso de que la @función haya resultado exitosa, la reflejamos en consola con
 * console.log y lo mostramos en el @boton #fire cambiando su texto a "Cambio
 * correcto".
 * En caso de que la @función Ajax no haya resultado exitosa, reflejamos en
 * consola el error y actualizamos el @boton #fire cambiando su texto a "error".
 */
function cambioStatus(product_id, key)
{
    console.log(product_id)
    var value = $('#' + key + "_" + product_id).val()
    console.log(key)
    // registrar la tarea 
    var tarea_id = "task_" + Math.random()
    tareas[tarea_id] = false
    $('#cambios_guardados').text("Guardando cambios...");
    jQuery.ajax(
    {
        type: 'post',
        url: ajaxurl,
        dataType: 'json',
        data: 
        { 
            product_id: product_id, 
            value: value, 
            key: key, 
            tarea_id: tarea_id,
            action: 'foobar'
        },
        success: function(response) 
        { 
            console.log("exito")
            console.log(response)
            console.log(tareas)
            delete tareas[response.data["tarea_id"]]
            console.log(tareas.size)
            if(tareas.size == null)
            {
                $('#cambios_guardados').text("Cambios guardados");
            }     
        },
        error: function(response) 
        { 
            console.log("fracaso")
            console.log(response)   
        },
    });
};

/**
 * @Función buscarResultados()
 * Recarga la pagina enviando como parametro 
 * el texto dentro del input #keyword_input.
 */
function buscarResultados()
{
    var keyword = jQuery('#keyword_input').val();
    var url = "?page=mkf-product-entries&keyword=" + keyword
    window.location.href = url;
}

/**
 * @Función selectTodos()
 * Primero obtiene el numero de checkboxes que existen 
 * en la pagina.
 * Despues mediante un for que va de cero hasta el numero
 * de checkboxes, va agregando la propiedad checked a 
 * cada uno.
 */
function selectTodos()
{
    console.log("entramos en select otodos")
    checkboxes = document.getElementsByName('checkboxes');
    var source = $('#checkbox_master')
    console.log(source)
    for(var i=0, n=checkboxes.length;i<n;i++) 
    {
        checkboxes[i].checked = source.is(":checked");
        console.log(i)
        // checkboxes[i].checked = true;
    }
}

/**
 * @función statusMasivo(@string, @string, @string)
 * Recibe los @parametros del atributo a modificar, 
 * el valor que asignara y el id del elemento.
 */
function statusMasivo(key, nombre_key, id)
{
    console.log("vamos a hacer un cambio masivo")
    // console.log(product_id)
    var value = $('#' + id).val()
    // var key = "mercadolibre"
    console.log(key)
    console.log(value)
    var isGood=confirm('Confirmar hacer cambio masivo de ' + nombre_key + ' a ' + value + '?');
    if (isGood) 
    {
        console.log("se prendio")
        var checkboxes = $( '[name="checkboxes"]:checked');
        for(var i=0, n=checkboxes.length;i<n;i++) 
        {
            var product_id = checkboxes[i].id.replace("checkbox_", "")
            console.log(product_id)
            var tarea_id = "task_" + Math.random()
            tareas[tarea_id] = false
            $('#cambios_guardados').text("Guardando cambios...");
            // checkboxes[i].checked = true;
            jQuery.ajax({
              url: ajaxurl,
              type: 'post',
              dataType: 'json',
              data: 
                { 
                    product_id: product_id, 
                    value: value, 
                    key: key,
                    tarea_id: tarea_id,
                    action: 'foobar'
                },
                success: function(response) 
                { 
                    console.log(response.data)
                    console.log("success")
                    var nombre = key + "_" + response.data["product_id"]
                    var el_valor = response.data["value"]
                    console.log("el nombre es")
                    console.log(nombre)
                    var element = document.getElementById(nombre);
                    element.value = el_valor;
                    delete tareas[response.data["tarea_id"]]
                    console.log(tareas.size)
                    if(tareas.size == null)
                    {
                        $('#cambios_guardados').text("Cambios guardados");
                    }
                    else
                    {
                        console.log(tareas)
                        console.log(tareas.size)
                    }
                },
                error: function(response) 
                { 
                    console.log("error")
                    console.log(response.responseText)
                    console.log(response.data)
                  // jQuery('#fire').text("...error!");
                },
            });
        }
    }
}

/**
 * @función setSelect()
 * 
 */
function setSelect()
{
    console.log("entramos en set select")
    // $('#mercadolibre_' + product_id).value = value;
    var element = document.getElementById('mercadolibre_37');
    console.log(element)
    element.value = "paused";
}

/**
 * @función enterBuscar()
 *
 */
function enterBuscar(e)
{
    if(e.which==13)
    {
        buscarResultados()
    }
}


var tareas = {}
var status_cambios = ""


/**
     * @Funciones embebidas
     **
     
    /**
     * @Función getCategory()
     * Al ser llamada,a su vez manda a llamar a una @funcion Ajax que crea el path_categoria que contiene 
     * la categoria del producto. Despues lo inserta con appenddentro de un link que lleva hacia
     * entries-categorizador con los parametros $product_id, 
     * 
     */
    function getCategory(pagina, keyword) 
    {
        var categorias = $(".category_field").map(function() 
        {
            var el_id = $(this).attr("id");
            if($(this).text().length > 1 && $(this).text() != "categorizar")
            {
                jQuery.ajax(
                {
                    type: "GET", 
                    url: "https://api.mercadolibre.com/categories/"+ $(this).text(),
                    async: false,
                    success: function(data)
                    {
                        var path_categoria = "";
                        data.path_from_root.map(function(r)
                        {
                            path_categoria = path_categoria + " > " + r.name;
                        });
                        $('#' + el_id).text("");
                        path_categoria = path_categoria.substring(3);
                        $('#' + el_id).append('<a href=?page=mkf-entries_categorizador&pagina='+pagina+'&keyword='+keyword+'&product_id=' + el_id.replace("categoria_", "") + ">" + path_categoria + "</a>");
                    }
                });
            }

        });
    }


/** 
 * @función Valida si el producto no tiene categoria, exposicion y tipo de envio, en tal caso desabilita el select pub_status
 */
window.onload = function ()
{
    
}

function check_status(id)
{
    var expo_ml = $('#exposicion_ml_'+id+' option:selected').text();
    var categoria_ml = $('#categoria_'+id).text();
    var metodo_envio_ml = $('#metodo_envio_ml_'+id+' option:selected').text();
    console.log(id +' '+expo_ml +' '+ categoria_ml +' '+ metodo_envio_ml);
    if(expo_ml == '...' || categoria_ml == 'categorizar' || metodo_envio_ml == '...')
    {
        console.log('disabled = true');
        $('#mercadolibre_'+id).prop('disabled', true);
    }
    
	
    
}
jQuery(function()
{
	$('.pub_status').trigger('onload');
});