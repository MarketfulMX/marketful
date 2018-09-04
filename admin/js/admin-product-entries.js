/********************************************************************************************
 * @Funciones y @Scripts de admin-product-entries.php 
 * admin-product-entries.js
 * 
 */


/*
 * - @Funci�n JQuery/Ajax: cambioStatus(@string,@string)
 * Esta funci�n recibe dos @par�metros que son el id del producto y el tipo de
 * metadato que modificara.
 * La @funci�n console log muestra en la consola del navegador la informaci�n del objeto
 * product_id.
 *
 * Se crea una variable con el valor del select que se modific�, se obtiene dicha
 * informaci�n obteniendo el id del select con el tipo de metadato que se modificara
 * m�s guion bajo m�s el id del producto.
 *
 * Se env�a con console.log el valor de key
 * Se crea una funci�n AJAX que pide el tipo de solicitud que se hace 'POST'
 * y se env�an los @par�metros adem�s que se manda a llamar a la funci�n de PHP 
 * my_theme_ajax_submit. Se le env�an los @par�metros: product_id, value y key .
 *
 * La @funci�n Ajax que nombramos response nos responde a la solicitud con un archivo Json.
 *
 * En caso de que la @funci�n haya resultado exitosa, la reflejamos en consola con
 * console.log y lo mostramos en el @boton #fire cambiando su texto a "Cambio
 * correcto".
 * En caso de que la @funci�n Ajax no haya resultado exitosa, reflejamos en
 * consola el error y actualizamos el @boton #fire cambiando su texto a "error".
 */
function cambioStatus(product_id, key)
{
    console.log(product_id+' entro en cambiostatus')
    var value = $('#' + key + "_" + product_id).val()
    // Validamos si seleccionan status y que sea finalizar
    if(key == 'mercadolibre' && value == 'closed')
    {
        console.log('Se va a finalizar -> Lanzar alerta para validar');
        if(!confirm('Si finalizas una publicaci�n en MercadoLibre tendras que crear una nueva para volver a activarla, �Finalizar publicacion?'))
        {
            $('#' + key + "_" + product_id).val('...');
            return false;
        }
    }
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
 * @Funci�n buscarResultados()
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
 * @Funci�n selectTodos()
 * Primero obtiene el numero de checkboxes que existen 
 * en la pagina.
 * Despues mediante un for que va de cero hasta el numero
 * de checkboxes, va agregando la propiedad checked a 
 * cada uno.
 */
function selectTodos()
{
    //console.log("entramos en select otodos")
    checkboxes = document.getElementsByName('checkboxes');
    var source = $('#checkbox_master')
    //console.log(source)
    for(var i=0, n=checkboxes.length;i<n;i++) 
    {
        checkboxes[i].checked = source.is(":checked");
        console.log(i)
        // checkboxes[i].checked = true;
    }
}

/**
 * @funci�n statusMasivo(@string, @string, @string)
 * Recibe los @parametros del atributo a modificar, 
 * el valor que asignara y el id del elemento.
 */
function statusMasivo(key, nombre_key, id)
{
    //console.log("vamos a hacer un cambio masivo")
    // console.log(product_id)
    var value = $('#' + id).val()
    //console.log('Entramos a statusMasivo, Tipo = '+ key +' Id = '+id +' Valor = '+ value + '');
    // var key = "mercadolibre"
    //console.log(key)
    //console.log(value)
    var isGood=confirm('Confirmar hacer cambio masivo de ' + nombre_key + ' a ' + value + '?');
    if (isGood) 
    {
        //console.log("se prendio")
        var checkboxes = $( '[name="checkboxes"]:checked');
        for(var i=0, n=checkboxes.length;i<n;i++) 
        {   
            var product_id = checkboxes[i].id.replace("checkbox_", "")
            //console.log(product_id)
            // ------------------------------------------------------------------------
            // -- VALIDANDO QUE EL SELECT_STATUS ESTE DISPNIBLE PARA SER MODIFICADO ---
            // ------------------------------------------------------------------------
            // Se toman los valores de exposici�n, categoria y tipo de env�o
            var expo_ml = $('#exposicion_ml_'+product_id+' option:selected').text();
            var categoria_ml = $('#categoria_'+product_id).text();
            var metodo_envio_ml = $('#metodo_envio_ml_'+product_id+' option:selected').text();
            // En caso de que alguno de los atributos necesarios para realizar la publicacion no este definido Y se este haciendo un cambio de status (mercadolibre) omitira el cambio.
            if(!((expo_ml == '...' || categoria_ml == 'categorizar' || metodo_envio_ml == '...') && key == 'mercadolibre'))
            {
                //console.log('El producto con el ID '+product_id+' si sera modificado.');
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
}

/**
 * @funci�n setSelect()
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
 * @funci�n enterBuscar()
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
     * @Funci�n getCategory()
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
 * @funci�n check_status(@parametro: id del producto)
 * Valida si el producto no tiene categoria, exposicion y tipo de envio, en tal caso desabilita el select pub_status
 * Con el parametro del id, valida que se pueda o no habilitar el select_status
 */

function check_status(id)
{
    var expo_ml = $('#exposicion_ml_'+id+' option:selected').text();
    var categoria_ml = $('#categoria_'+id).text();
    var metodo_envio_ml = $('#metodo_envio_ml_'+id+' option:selected').text();
    var link = 'redirige_cat(\'?page=mkf-entries_categorizador&pagina=1&keyword=&product_id='+id+'\')'; // Variable link para redirigir posteriormente
    //console.log(id +' '+expo_ml +' '+ categoria_ml +' '+ metodo_envio_ml);
    if(expo_ml == '...' || categoria_ml == 'categorizar' || metodo_envio_ml == '...')
    {
        //console.log('disabled = true : '+id);
        $('#mercadolibre_'+id).val('...');
        $('#mercadolibre_'+id).attr('data-toggle','modal');
        $('#mercadolibre_'+id).attr('data-target','#modal_ad_'+id);
        $('#mercadolibre_'+id).attr('onChange','');
        cambioStatus(id, 'mercadolibre');
        $('#mercadolibre_'+id).attr('onClick','deshabilitar_select('+id+');');
        $('.boton_redirige_cat_'+id).attr('onClick',link);
        $('.boton_redirige_cat_'+id).attr('onChange','');
        $('#subir_ml_'+id).attr('disabled',true);
    }
    else
    {
        //console.log('enabled = true : '+id);
        $('#mercadolibre_'+id).prop('disabled', false);
        $('#mercadolibre_'+id).attr('data-toggle',' ');
        $('#mercadolibre_'+id).attr('data-target',' ');
        $('#mercadolibre_'+id).attr('onClick',' ');
        $('#mercadolibre_'+id).attr('onChange','cambioStatus('+id+',\'mercadolibre\')');
        $('.boton_redirige_cat_'+id).attr('onClick',' ');
        $('.boton_redirige_cat_'+id).attr('onChange','cambioStatus('+id+',\'mercadolibre\')');
        $('#subir_ml_'+id).attr('disabled',false);
    }
}
    /**
     * @Jquery @Funci�n 
     * Dispara el evento onLoad en los select de status para poder validar se estan habilitados o no.
     * 
     */ 
    jQuery(function()
    {
        $('.pub_status').trigger('onload');
    });
    /**
     * @funci�n 
     * impide que el usuario seleccione alguna opcion cuando un select_status esta deshabilitado.
     */
    function deshabilitar_select(id)
    {
        console.log('Desabilitar Select ahora');
        $('#mercadolibre_'+id).val('...');
        $('#subir_ml_'+id).attr('disabled','false');
        $('#subir_ml_'+id).attr('onClick','');
    }
/**
 * @funci�n redirige_cat(@parametro: id del producto)
 *
 * Funcion que redirige hacia la pagina de categorizador
 */
function redirige_cat(link)
{
    //console.log(link);
    window.location = link;    
}

/**
 * @funci�n resize_window()
 * Re define el tama�o de la pantalla
 */
function resize_window()
{
    var ancho = window.innerWidth;
    $('#wpbody-content').css('width',ancho - 200);
}

/**
 * @funcion subir_cambios(@string: product_id)
 * 
 * La @funcion de subir cambios a Marketful. Cuando se manda a llamar se recibe como parametro 
 * el id del producto que actualizara sus datos. Toma los valores de la exposicion, el status
 * el precio, el valor del inventario y el tipo de envio.
 */
 function subir_cambios(product_id)
{
    console.log(product_id+' Se esta subiendo a Mkf los cambios ------------------------------------------------------------------');
    $('#cambios_guardados').text("Guardando cambios...");

    var values = [$('#mercadolibre_' + product_id).val(), $('#exposicion_ml_'+ product_id).val(), $('#precio_ml_'+ product_id).val(), $('#inventario_ml_'+ product_id).val(), $('#metodo_envio_ml_'+ product_id).val()];
    var keys = ['mercadolibre', 'exposicion_ml', 'precio_ml', 'inventario_ml', 'metodo_envio_ml'];
    var c = 0;
    var c2 = 0;

    // Status -- mercadolibre
    if(values[0] == 'closed')
    {
        console.log('Se va a finalizar la publicacion -> Lanzar alerta para validar ooooooooooooooooooooooooooooooooooooooooooooooo');
        if(!confirm('Si finalizas una publicaci�n en MercadoLibre tendras que crear una nueva para volver a activarla, �Finalizar publicacion?'))
        {
            $('#' + key + "_" + product_id).val('...');
            c2 = 1;
        }
    }
    for(c = c2; c<4; c++)
    {
        jQuery.ajax(
        {
            type: 'post',
            url: ajaxurl,
            dataType: 'json',
            data: 
            { 
                product_id: product_id, 
                value: values[c], 
                key: keys[c], 
                tarea_id: tarea_id,
                action: 'act_mkf'
            },
            success: function(response) 
            { 
                delete tareas[response.data["tarea_id"]];
                if(tareas.size == null)
                {
                    if(c == 4)
                    {
                        $('#cambios_guardados').text(" Cambios guardados. ");
                    }
                    else
                    {
                        $('#cambios_guardados').text("Guardando "+(c+1)+" de 5 ");
                    }
                }     
            },
            error: function(response) 
            { 
                console.log("fracaso");
            },
        });
    }
    // registrar la tarea 
    var tarea_id = "task_" + Math.random();
    tareas[tarea_id] = false;   
};


