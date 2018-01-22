/**
 * Created by fidelfuentes on 22/01/18.
 */





/**
 * Created by fidelfuentes on 16/11/17.
 */


var BASE_URL = window.origin+'/tmp43/cineleco/';


function Ajax(urlSnd, datos, cb) {
    if (!datos) {
        datos = {};
    }
    $.ajax({
        url: BASE_URL + urlSnd,
        type: "POST",
        dataType: 'json',
        data: datos,
        success: function (msg) {
            cb(msg);
        }
    });
}

//Ajax Load data from ajax

function AjaxTable(url,type){

    $.ajax({
        url: "/services/Cineleco/octenerListadoEmpleados" ,
        type: "GET",
        dataType: "JSON",
        success: function (data) {

            $('[name="id"]').val(data.id);
            $('[name="firstName"]').val(data.usu_nombre);
            $('[name="lastName"]').val(data.usu_correo);
            //$('[name="gender"]').val(data.gender);
            //$('[name="address"]').val(data.address);
            //$('[name="dob"]').val(data.dob);
            //
            //$('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            //$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

        },
        error: function (jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
        }
    });

}




function AjaxFile(url, datos, funcionmensaje){
    $.ajax({
        type: "POST",
        url: BASE_URL + url,
        dataType: 'json',
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function(msg){
            funcionmensaje(msg);
        },
        error: function(msg){
            funcionmensaje(msg);
        }
    });
}


// function reload_table()
// {
//   table.ajax.reload(null,false); //reload datatable ajax
// }