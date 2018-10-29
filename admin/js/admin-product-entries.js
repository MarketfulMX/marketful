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
    console.log(product_id+' entro en cambiostatus')
    var value = $('#' + key + "_" + product_id).val()
    valido = false 
    if(key == 'titulo_ml' && value.length > 2){
        valido = true
    }else if(key != 'titulo_ml'){
        valido = true
    }else{
        valido = false
    }
    if( valido == true)
    {
        // Validamos si seleccionan status y que sea finalizar
        if(key == 'mercadolibre' && value == 'closed')
        {
            console.log('Se va a finalizar -> Lanzar alerta para validar');
            if(!confirm('Si finalizas una publicación en MercadoLibre tendras que crear una nueva para volver a activarla, ¿Finalizar publicacion?'))
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
                if(key == 'titulo_ml')
                {
                    $('#tpml_'+product_id).text(value);
                }
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
    }
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
 * @función statusMasivo(@string, @string, @string)
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
            // Se toman los valores de exposición, categoria y tipo de envío
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
/**
 * @funcion checar_enter()
 *
 * Esta funcion envia los datos que se han escrito en el input del titulo si el usuario presiono enter.
 */
function checar_enter(e, id, tipo)
{
    if(e.which==13)
    {
        cambioStatus(id, tipo);
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
 * @función check_status(@parametro: id del producto)
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
     * @Jquery @Función 
     * Dispara el evento onLoad en los select de status para poder validar se estan habilitados o no.
     * 
     */ 
    jQuery(function()
    {
        // $('.pub_status').trigger('onload');
    });
    /**
     * @función 
     * impide que el usuario seleccione alguna opcion cuando un select_status esta deshabilitado.
     */
    function deshabilitar_select(id)
    {
        console.log('Desabilitar Select ahora');
        $('#mercadolibre_'+id).val('...');
        $('#subir_ml_'+id).attr('disabled','false');
    }
/**
 * @función redirige_cat(@parametro: id del producto)
 *
 * Funcion que redirige hacia la pagina de categorizador
 */
function redirige_cat(link)
{
    //console.log(link);
    window.location = link;    
}

/**
 * @función resize_window()
 * Re define el tamaño de la pantalla
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
 function subir_cambios(product_id){
    // console.log(product_id+' Se esta subiendo a Mkf los cambios ------------------------------------------------------------------');
    // $('#cambios_guardados').text("Guardando cambios...");

    // var values = [$('#mercadolibre_' + product_id).val(), $('#exposicion_ml_'+ product_id).val(), $('#precio_ml_'+ product_id).val(), $('#inventario_ml_'+ product_id).val(), $('#metodo_envio_ml_'+ product_id).val()];
    // var keys = ['mercadolibre', 'exposicion_ml', 'precio_ml', 'inventario_ml', 'metodo_envio_ml'];
    // var c = 0;
    // var c2 = 0;

    // // Status -- mercadolibre
    // if(values[0] == 'closed')
    // {
    //     //console.log('Se va a finalizar la publicacion -> Lanzar alerta para validar ooooooooooooooooooooooooooooooooooooooooooooooo');
    //     if(!confirm('Si finalizas una publicación en MercadoLibre tendras que crear una nueva para volver a activarla, ¿Finalizar publicacion?'))
    //     {
    //         $('#' + key + "_" + product_id).val('...');
    //         c2 = 1;
    //     }
    // }
    // for(c = c2; c<4; c++)
    // {
        // validar que este listo para subir 
        // var tipo_de_envio = $('#metodo_envio_ml_' + product_id + ' select');
        // var exposicion = $('#exposicion_ml_' + product_id).val();
        // var categoria =$('#categoria_' + product_id + ' a').text();
        var tarea_id = "task_" + Math.random()
        tareas[tarea_id] = false
        $('#cambios_guardados').text("Subiendo cambios...");
        // console.log(tipo_de_envio)
        // console.log(exposicion)
        // console.log(categoria)
        // if(tipo_de_envio.length > 0 && exposicion.length > 0 && categoria != "categorizar"){
        if(2 == 2){
            console.log("vamos con el ajax")
            jQuery.ajax(
            {
                type: 'post',
                url: ajaxurl,
                dataType: 'json',
                data: 
                { 
                    product_id: product_id, 
                    tarea_id: tarea_id,
                    action: 'act_mkf'
                },
                success: function(response) 
                { 
                    console.log(response)
                    // delete tareas[response.data["tarea_id"]];
                    // if(tareas.size == null)
                    // {
                    //     if(c == 4)
                    //     {
                        //     $('#cambios_guardados').text(" Cambios guardados. ");
                        // }
                        // else
                        // {
                            $('#cambios_guardados').text("Cambios subidos");
                    //     }
                    // }     
                },
                error: function(response) 
                { 
                    console.log("fracaso");
                },
            });
        }else{
            console.log("no entro en ajax")
        }
            
    // }
    // registrar la tarea 
    // var tarea_id = "task_" + Math.random();
    // tareas[tarea_id] = false;   
};

/** 
 * @funcion calcular_comision(@string: id del producto)
 * Calcula la comision que cobra mercado libre (13% en clásica, 17,5% en Premium)  en caso de que tenga el 
 * precio en Ml en caso contrario alerta que falta el precio.
 */
function calcular_comision(id)
{
    var key = 'costo_comision_ml';
    var expo = $('#exposicion_ml_'+id+' option:selected').text();
    var precio = $('#precio_ml_'+id).val();
    //console.log(expo+' '+precio);
    if(expo != '...' && precio > 0)
    {
        switch (expo)
        {
            case 'Gratis':
                $('#costo_comision_ml_'+id).text('0.00');
                cambioStatus(id, key);
                break;
            case 'Clasica':
                $('#costo_comision_ml_'+id).text((precio * .13).toFixed(2));
                cambioStatus(id, key);
                break;
            case 'Premium':
                $('#costo_comision_ml_'+id).text((precio * .175).toFixed(2));
                cambioStatus(id, key);
                break;
            default:
                break;
        }
    }
    else
    {
        $('#costo_comision_ml_'+id).val('0.00');
        $('#mensajes_ent2').text('No se puede calcular la comision, asigna el precio y el tipo de exposicion.');
    }
}

/**
 * @funcion calcular_costo_envio(@string: id del producto, @string: categoria del producto) "Get Costo de Envio"
 *
 * Funcion que envia a la API de MKF la categoria y el precio y recibe de vuelta cuanto cuesta el envio.
 *
 */
function calcular_costo_envio(id, categ)
{
    var precio = $('#precio_ml_'+id).val(); 
    var t_envio = $('#metodo_envio_ml_'+id+' option:selected').val();
    var key = 'costo_envio_ml';
    console.log( 'Entro a get_ce'+id+' '+categ+' '+precio+' '+t_envio);
    if(categ != 'categorizar' && (t_envio != "" || t_envio != "me_g" ) && precio > 0)
    {
        jQuery.ajax({
            type: 'GET',
            url: ajaxurl,
            dataType: 'Json',
            data:
            {
                woo_id: id,
                category_id: categ,
                price: precio,
                action: 'get_ce'
            },
            success: function(response)
            {   
                console.log("vamos con la respueta success")
                console.log(response);
                var respuesta = response.data;
                console.log(respuesta["costo_envio"])
                $('#costo_envio_ml_'+id).text(respuesta["costo_envio"]);
                cambioStatus(id, key);
                console.log(' Exito Se actualizo el valor del costo de envio es igual a : '+ respuesta["costo_envio"] );
            },
            error: function(response)
            {
                console.log('Error No se pudo obtener el costo de envio.');
                $('#costo_envio_ml_'+id).val('N/A');
                $('#mensajes_ent').text('No se puede calcular el costo de envio, intente mas tarde.');
            }
        });
    }
    else
    {
        $('#costo_envio_ml_'+id).val('N/A');
        $('#mensajes_ent').text('No se puede calcular el costo de envio, asigna el precio y el tipo de envio.');
    }
}

// **********************************************************************************
// Scripts para TABLA RESPONSIVA
// PRUEBA --
//Tabla test no borrar*******
      console.log("Se ejecuto el estilo de la tabla******");
      onload = inicia;
      window.onresize = function()
      {
          setTimeout(function()
          {
              window.location.reload()
          }, 100)
      };

      var laTabla, totalFilas, totalColumnas, horPasos, verPasos, elContenido=[]; 
      var inicioFilas = 0; 
      var inicioColumnas = 0; 
      var misColumnas = 8; // COLUMNAS QUE DEJAMOS VISIBLES
      var misFilas = 5; // FILAS QUE DEJAMOS VISIBLES

      function inicia()
      {
          console.log(" Entro a inicia 01");
          laTabla = document.querySelector("table"); 
          lasFilas = laTabla.querySelectorAll("tr"); 
          totalFilas = lasFilas.length; 
          lasColumnas = lasFilas[0].querySelectorAll("td"); 
          totalColumnas = lasColumnas.length; 

          for(r=0; r<totalFilas; r++) 
          {
            elContenido[r] = [];
            for(d=0; d<totalColumnas; d++)
            {
              elContenido[r][d] = lasFilas[r].querySelectorAll("td")[d].innerHTML;
            }
          }

          var nuevaTabla = ""; 
          for(r=0; r<misFilas; r++)
          {
            nuevaTabla += "<tr>"; 
            for(d=0; d<misColumnas; d++)
            {
              nuevaTabla += "<td></td>";
            }
            nuevaTabla += "</tr>"; 
          }

          laTabla.innerHTML = nuevaTabla; 
          horBar = document.querySelector("#hor"); 
          anchoTabla = laTabla.offsetWidth;
          horBar.style.width = anchoTabla+"px";
          horBar.scrollLeft = 0; 
          horPasos = anchoTabla / (+totalColumnas - misColumnas); 
          horBar.setAttribute("onscroll", "llenaTablaH(this.scrollLeft)"); 
          llenaTablaH(inicioFilas); 

          verBar = document.querySelector("#ver"); 
          altoTabla = laTabla.offsetHeight; 
          verBar.style.height = altoTabla+"px"; 
          verBar.scrollTop = 0;
          verBar.style.top = document.querySelector("table").offsetTop+"px"; 
          verBar.style.left = (laTabla.offsetLeft + anchoTabla) + "px";
          verPasos = altoTabla / (+totalFilas - misFilas); 
          verBar.setAttribute("onscroll", "llenaTablaV(this.scrollTop)"); 
          llenaTablaV(inicioColumnas);
      }
      function llenaTablaH(despl)
      {
          console.log("Entro a llenaTablaH 02");
          muestra = parseInt(+despl/horPasos);
          inicioColumnas = +muestra; 
          for(f=1; f<misFilas; f++)
          {
              for(c=1; c<misColumnas; c++)
              {
                  laTabla.querySelectorAll("tr")[0].querySelectorAll("td")[c].innerHTML = elContenido[0][inicioColumnas+c]; 
                  laTabla.querySelectorAll("tr")[f].querySelectorAll("td")[c].innerHTML = elContenido[inicioFilas+f][inicioColumnas+c]; 
              }
          }
      }
      function llenaTablaV(despl)
      {
          console.log("Entro a llenaTablaV 03");
          muestra = parseInt(+despl/verPasos); 
          inicioFilas = +muestra;
          for(f=1; f<misFilas; f++)
          {
              laTabla.querySelectorAll("tr")[f].querySelectorAll("td")[0].innerHTML = elContenido[inicioFilas+f][0]; 
              for(c=1; c<misColumnas; c++) 
              {
                  laTabla.querySelectorAll("tr")[f].querySelectorAll("td")[c].innerHTML = elContenido[inicioFilas+f][inicioColumnas+c]; 
              }
          }
      }

      //******
//********************************************

//******************************************************************************************************************
//  Here are only on-boarding functions ->->->
/**
 * @Funcion disabling_elements()
 */
function disabling_elements()
{
    $(".caja-de-botones").attr("disabled",true); 
    $("#status_select").attr("disabled",true); 
    $("#exposicion_ml_select").attr("disabled",true);
    $("#boton_dg").attr("disabled",true);
    $("#keyword_input").attr("disabled",true);
    $("#boton_buscar").attr("disabled",true);
}

function href_dis()
{
    $('a').attr('href','#');
}
/**
 * @funcion onboarding_1()
 *
 */
function onboarding_1()
{
    disabling_elements();
    $(".subir").attr("disabled","true");
    $("#tr_onb").attr("class","elemento_active"); 
    $('#tr_onb').attr('onClick','onboarding_2()');
    $('.container').append("<div class='caja_onb' style='margin-top: 10px; border-color: #878181; border-radius: 5px; border-width: 1px; border-style: solid; background-color: #F5F5F5; color: #878181; font-size: 25px; width: 100%; padding: 5px; padding-left: 10px;'>Da clic en el producto de prueba que se encuentra marcado en color azul.</div>");
}
/**
 * @funcion onboarding_2()
 * 
 */
 var clic_c = 0;
function onboarding_2()
{
    if(clic_c == 0)
    {
        $('.onb_flotante').css('display','inline');
        $('.onb_flotante').append('La categoria es un atributo que Mercado Libre utiliza para categorizar los productos y hacerlos mas visibles al comprador, asignale una categoria a nuestro producto de prueba para continuar.<br><button class="boton_onb" onclick="onboarding_3()"> Aceptar</button>');
        clic_c = 1;
    }
}
/**
 * @Funcion onboarding_3()
 *
 */
 function onboarding_3()
 {
    if(clic_c == 1)
    {
        $('#tr_onb').attr('class','null');
        $('#tr_onb').attr('onClick',' ');
        $(".category_field").attr('class','elemento_active');
        $('.onb_flotante').css('display','none');
        $('.caja_onb').text("Da clic en el link resaltado con azul que dice 'Categorizar' para asignar una categoria.");
        clic_c = 2;
    }
 }
/**
 * @funcion onboarding_4()
 */
function onboarding_4()
{
    disabling_elements();href_dis();
    $('.onb_flotante').css('display','inline');
    $('.onb_flotante').append('La exposicion de un producto es un atributo que indica que tan visible sera tu publicacion dentro de Mercado Libre, asigna algun tipo de exposicion para el producto de prueba.<br><button class="boton_onb" onclick="onboarding_5()"> Aceptar</button>');
}
/**
 * @funcion onboarding_5()
 */
function onboarding_5()
{
    disabling_elements();
    $('.onb_flotante').css('display','none');
    $('.expo_ml').attr('class','custom_select elemento_active expo_ml');
    var onchanges = $('.expo_ml').attr('onChange');
    $('.expo_ml').attr('onChange',onchanges+'onboarding_6();');
    $('.container').append("<div class='caja_onb' style='margin-top: 10px; border-color: #878181; border-radius: 5px; border-width: 1px; border-style: solid; background-color: #F5F5F5; color: #878181; font-size: 25px; width: 100%; padding: 5px; padding-left: 10px;'>Da clic en exposicion que esta resaltada en color azul y selecciona algun valor.</div>");
}
/**
 * @funcion onboarding_6()
 */
function onboarding_6()
{
    $('.expo_ml').attr('class','custom_select expo_ml');
    $('.onb_flotante').text(' ');
    $('.onb_flotante').append('El tipo de envio es la forma en la que se enviara tu producto y lo que se le cobrara a tu cliente, por lo cual es importante asignarle un valor, vayamos a hacerlo. <br><button class="boton_onb" onclick="onboarding_7()"> Aceptar</button>');
    $('.onb_flotante').css('display','inline'); 
}
/**
 * @funcion onboarding_7()
 */
function onboarding_7()
{
    $('#registros').scrollLeft(2000);
    $('.onb_flotante').css('display','none'); 
    $('.caja_onb').text('Da clic en tipo de envio que esta resaltado en color azul y selecciona alguna opcion.');
    $('.tipo_envi').attr('class','tipo_envi elemento_active');
    var onchanges = $('.tipo_envi').attr('onChange');
    $('.tipo_envi').attr('onChange',onchanges+'onboarding_8();');
}
/**
 * @funcion onboarding_8()
 */
function onboarding_8()
{
   $('.tipo_envi').attr('class','custom_select tipo_envi');
   $('.onb_flotante').text(' ');
   $('.onb_flotante').append('Ahora asignaremos un valor al status, en caso de que se finalize se debera confirmar ya que para activarlo de nuevo se debera hacer una nueva publicacion de Mercado Libre. <br><button class="boton_onb" onclick="onboarding_9()"> Aceptar</button>');
   $('.onb_flotante').css('display','inline'); 
}
/**
 * @funcion onboarding_9()
 */
function onboarding_9()
{
    $('#registros').scrollLeft(-2000);
    $('.onb_flotante').css('display','none'); 
    $('.caja_onb').text('Da clic en el status del producto que se encuentra marcado en color azul y selecciona algun valor.');
    $('.pub_status').attr('class',' pub_status elemento_active');
    var onchanges = $('.tipo_envi').attr('onChange');
    $('.pub_status').attr('onChange',onchanges+'onboarding_10();');
}
/**
 * @funcion onboarding_10()
 *
 */
function onboarding_10()
{
    $('.pub_status').attr('class','custom_select pub_status');
    $('.onb_flotante').text(' ');
    $('.onb_flotante').append('Los nombres de las publicaciones no deben exceder los 60 caracteres segun las especificaciones de Mercado Libre, por lo cual cuando el nombre del producto sea mayor a 60 se podra modificar directamente en la vista de publicaciones. <br><button class="boton_onb" onclick="onboarding_11()"> Aceptar</button>');
    $('.onb_flotante').css('display','inline'); 

}
/** 
 * @funcion onbozrding_11()
 */ 
function onboarding_11()
{
    $('.titulo_onb').focus()
    $('.onb_flotante').css('display','none'); 
    $('.caja_onb').text('Ingresa un nombre menor a 60 caracteres en la caja de texto resaltada, cuando termines da clic fuera de la caja.');
    var onblurs = $('.titulo_onb').attr('onblur');
    $('.titulo_onb').attr('onblur',onblurs + ';onboarding_12();');
}
/**
 * @funcion onboarding_12()
 */
function onboarding_12()
{
    $('.pub_status').attr('class','custom_select pub_status');
    $('.onb_flotante').text(' ');
    $('.onb_flotante').append('Ya hemos agregado la informacion clave para que nuestra publicacion pueda estar en Mercado Libre, Solo queda subir los cambios para eso tienes que darle clic al boton que dice "subir cambios". <br><button class="boton_onb" onclick="onboarding_13()"> Aceptar</button>');
    $('.onb_flotante').css('display','inline'); 
}
/**
 * @funcion onboarding_13()
 */
function onboarding_13()
{
    $('.onb_flotante').css('display','none'); 
    $('.caja_onb').text('Da clic en el boton "subir cambios" que esta resaltado en color azul.');
    $('.subir').attr('class','subir boton_dg elemento_active');
    var onclicks = $('.subir').attr('onclick');
    $('.subir').attr('onclick',onclicks+';onboarding_14();');
}
/**
 * @funcion onboarding_14()
 */
function onboarding_14()
{
    $('.subir').attr('class','subir boton_dg');
    $('.pub_status').attr('class','custom_select pub_status');
    $('.onb_flotante').text(' ');
    $('.onb_flotante').append('¡Hecho! has logrado subir la publicacion de prueba a Mercado Libre con todos los atributos que seleccionaste durante el onboarding. <br><a href="?page=mkf-onboarding&fin=1"><button class="boton_onb" onClick="show_spinner()"> Aceptar</button></a>');
    $('.onb_flotante').css('display','inline');
}
/**
 * @funcion onboarding_nn(@string: id)
 */
function onboarding_nn(valor)
{
    jQuery.ajax(
    {
        type: 'post',
        url: ajaxurl,
        dataType: 'json',
        data: 
        { 
            product_id: valor, 
            value: 'Nombre de prueba superior a 60 caracteres. Nombre de prueba superior a 60 caracteres. Nombre de prueba superior a 60 caracteres. Nombre de prueba superior a 60 caracteres.', 
            key: 'titulo_ml', 
            action: 'foobar'
        },
        success: function(response) 
        { 
            console.log("Se modifico el tamaño del titulo para el onb")
            delete tareas[response.data["tarea_id"]]
        },
        error: function(response) 
        { 
            console.log("fracaso, no se modifico el titulo para el onb")
        },
    });
}
/**
* @funcion Para cargar de manera automatica onboarding_4() y onboarding_nn despues de la seccion de categorizar.
* 
*/
/**
 * @funcion show_spinner()
 * Funcion que muestra el spinner mientras el usuario espera alguna accion
 */
function show_spinner()
{
    $('.loader_onb').css('display','inline');
}

/* HERE END ONBOARDING FUNCTIONS *******************************************************************************************************/
/***************************************************************************************************************************************/