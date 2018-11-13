/* 
       * * * * * * * * * * * * * * * * * * * * * * * * * *
     * * Copyleft(C)  2018 GNU General Public License V3 * * 
   * * *         Made with love in Colombia!!!           * * *
     * *         @Author:... ==>BEANSWALKER<==           * *
       * * * * * * * * * * * * * * * * * * * * * * * * * *
~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
var table;

function initial()
    {

        show_form(false);
        show_records();
        //establecer la acción al presionar el botón submit ...
        $("#insert").on("submit",function(e) 
                            {
                                save_edit(e);
                            }
                        );
    }   

function clean_fields()
    {
        //limpiamos el contenido de los elementos html mediante JQery...
        $("#id_ctgry").val("");
        $("#nm").val("");
        $("#dscrptn").val("");

    }

function show_form(signal)
    {
        clean_fields(); // limpiamos los elementos
        if(signal === true)
        {
            
            //oculto el div contenedor que muestra los registros
            $("#list_records").hide();
            //muestro el div contenedor que muestra el formulario
            $("#new_record").show();
            $("#show_btt_form").hide();

            //este botón los podemos activar de forma interactiva con las cajitas de texto
            $("#save").prop("disabled",false);
        }
        else
        {
            //muestro el div contenedor que muestra los registros
            $("#list_records").show();
            $("#show_btt_form").show();
            //oculto el div contenedor que muestra el formulario
            $("#new_record").hide();
        }
    }

function cancel_form()
    {
        clean_fields();
        show_form(false);
    }

//the Ajax funcrion to get records...
function show_records()
    {
        table=$("#table_show_records").dataTable
                                    (
                                        {
                                               "aProcessing":true, //prcesamiento de datos activo
                                               "aServerSide":true,//paginación y filtrado activo desde el servidor
                                               dom: 'Bfrtip',//definir elementos de control de la tabla
                                               buttons:
                                                       [
                                                         'copyHtml5',
                                                         'excelHtml5',
                                                         'csvHtml5',
                                                         'pdf'
                                                       ],
                                               "ajax":
                                                       {
                                                         url:'../Ajax/Category.php',
                                                         type:"POST",
                                                         dataType:"json",
                                                         data:{"option":'select_all'},
                                                         error:function(e) //en caso de presentarse algún error
                                                             {
                                                                 console.log(e.responseText);                                                
                                                             }

                                                       },
                                                "bDestroy":true,
                                                "iDisplayLength":5,//paginación limitada a  5 registros
                                                "order":[[0,"asc"]]//organizar registros dede el primer campo
                                         }
                                     ).DataTable();
                        
    
    }

function save_edit(e)
    {
        e.preventDefault();//desactriva la ejecución normal del evento del botón
        $("#save").prop("disabled",true);
        var form_data = new FormData($("#insert")[0]);
        $.ajax(
                {
                  url:'../Ajax/Category.php?option=save_edit',
                  type:"POST",
                  data:form_data,
                  contentType: false,
                  processData: false,
                  //cuando todo se ejecuta correctamente, recibo la respuesta del servidor...
                    success: function (response) 
                    {
                        if(response === 'successful')
                        {

                            $.toast({
                                        heading: 'Succes',
                                        text: 'Proceso Exitoso!!!...',
                                        textAlign: 'center',
                                        icon: 'success',
                                        loader: true,        // Change it to false to disable loader
                                        position: 'mid-center',
                                        showHideTransition: 'slide',
                                        hideAfter: 2000
                                        //loaderBg: '#9EC600'  // To change the background    
                                    });
                            //bootbox.alert("Proceso exitoso!!!...");
                        }
                        else
                        {
                           //$.toast('Error!!!... '+response);
                           $.toast({
                                        heading: 'Warning',
                                        text: response,
                                        textAlign: 'center',
                                        icon: 'error',
                                        loader: true,        // Change it to false to disable loader
                                        position: 'mid-center',
                                        showHideTransition: 'slide',
                                        hideAfter: 5000
                                        //loaderBg: '#9EC600'  // To change the background    
                                    });
                            //bootbox.alert(response); //muestro la respuesta 
                        }

                                
                        show_form(false);
                                        table.ajax.reload();
                    }

                }
             );
        clean_fields();  //limpiar los campos del formulario
        }
function show_record_by_id(id_ctgry)
    {
   
        //alert("id... "+id_ctgry);
    $.post(
            "../Ajax/Category.php",
            {option:'by_id',id_cat:id_ctgry},
            function (data,status) 
            //data es el valor obtenido del servidor mediante POST
            //contiene el estado de la solicitudstatus("success", "notmodified", "error", "timeout", or "parsererror")
            {
                //alert("Hooolas.. "+data);                
              data = JSON.parse(data); //formateamos la respuesta como tipo json
              
                show_form(true);
              //mostramos los valores respectivos en cada elemento html:...
              $("#nm").val(data.name);
              $("#dscrptn").val(data.description);
              $("#id_ctgry").val(data.idcategory);
            }
           );
    }
    
function mensaje(nm_cat)
   {         
          
                $.post(
                    "../Ajax/Category.php",
                    {option:'repeat',word:nm_cat,search_field:'name'},
                    function (data,status) 
                    //data es el valor obtenido del servidor mediante POST
                    //contiene el estado de la solicitudstatus("success", "notmodified", "error", "timeout", or "parsererror")
                    {
                        data = JSON.parse(data); // Por alguna razón tengo que parsear el sato a JSON
                        if(data.numb >= 1)
                        {
                            $.toast({
                                            heading: 'Warning',
                                            text: 'Esta Categoría ya existe !!!...',
                                            textAlign: 'center',
                                            icon: 'error',
                                            loader: true,        // Change it to false to disable loader
                                            position: 'mid-center',
                                            showHideTransition: 'slide',
                                            hideAfter: 2000
                                            //loaderBg: '#9EC600'  // To change the background    
                                        });
                        }

                        //alert("Hooolas.. "+data.numb);                

                    }
                  );
           }

function enable_disable(id_ctgry,status)
{
    if(status === 1){ estado = ' Desactivar ';} else{ estado = ' Activar ';}
    bootbox.confirm(  "¿Desea "+estado+" la categoría? ...",
                        function(flag)
                            {
                                if(flag)
                                {
                                    if(status === 1)
                                    {
                                        //                                  $.post(
                                  $.post(
                                            "../Ajax/Category.php",
                                            {option:'update_state',id_cat:id_ctgry, new_state:0},
                                            function (e) // en la var e está la respuesta dle servidor
                                            {
                                                $.toast({
                                                        heading: 'success',
                                                        text: 'Categoría Desactivada !!!...',
                                                        textAlign: 'center',
                                                        icon: 'success',
                                                        loader: true,        // Change it to false to disable loader
                                                        position: 'mid-center',
                                                        showHideTransition: 'slide',
                                                        hideAfter: 2500
                                                        //loaderBg: '#9EC600'  // To change the background    
                                                        });
                                                table.ajax.reload();
                                            }
                                            
                                    
                                        );   
                                    }
                                    else
                                    {
                                         $.post(
                                            "../Ajax/Category.php",
                                            {option:'update_state',id_cat:id_ctgry, new_state:1},
                                            function (e) // en la var e está la respuesta dle servidor
                                            {
                                                $.toast({
                                                        heading: 'success',
                                                        text: 'Categoría Activada !!!...',
                                                        textAlign: 'center',
                                                        icon: 'success',
                                                        loader: true,        // Change it to false to disable loader
                                                        position: 'mid-center',
                                                        showHideTransition: 'slide',
                                                        hideAfter: 2500
                                                        //loaderBg: '#9EC600'  // To change the background    
                                                    });
                                                table.ajax.reload();
                                            }
                                            
                                    
                                        );   
                                    }
//                                  $.post(
//                                            "../Ajax/Category.php",
//                                            {option:'update_state',id_cat:id_ctgry, new_state:1},
//                                            function (e) // en la var e está la respuesta dle servidor
//                                            {
//                                                bootbox.alert(status);
//                                                //bootbox.alert(status);
//                                                table.ajax.reload();
//                                            }
//                                            
//                                    
//                                        );
                                    
                                }
                                else
                                {
                                    
                                }
                            }
                    );
}
        
//ejecutamos en primera instancia la fx initial
initial();

