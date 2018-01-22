/**
 * Created by fidelfuentes on 22/01/18.
 */


/**
 * Created by fidelfuentes on 14/11/17.
 */

$(function(){
    OBJ_DATOS.INIT()
    //if($('#data-table-listado-empleados').length){ OBJ_DATOS.INIT();}
    //if($('#info-empleados').length){ OBJ_DATOS.INIT();}
});

var OBJ_DATOS = {
    DATA:{
    },

    INIT:function(){
        this.EVENTS();
        //this.LOGIC.actualiza_tabla();
        this.LOGIC.perfilId();
        this.LOGIC.resposive();
    },
    EVENTS:function(){

        //@TODO nuevoproducto

        $('#formularionuevoproducto').on('submit', function(e){
            e.preventDefault();
            var datosFormulario = new FormData($('#formularionuevoproducto')[0]);

            //OBJ_CONJUNTO.LOGIC.guardarNConjunto(this);

            alert('hola nuevoproducto');

        });
        $('#formularionuevoproductoreferencia').on('click',function(){


            var nombreProducto = document.getElementById('nombreproducto').value;
            var descripcionProducto = document.getElementById('descripcion').value;
            var referenciaNombre = document.getElementById('referencianombre').value;
            var referenciaPrecio = document.getElementById('referenciaprecio').value;
            var idnuevoproducto = document.getElementById('idnuevoproducto').value;

            OBJ_DATOS.LOGIC.nuevoProducto(nombreProducto,descripcionProducto,referenciaNombre,referenciaPrecio,idnuevoproducto);

            return false;
        });

        //TODO NUEVA TABLA CON PAGINACION Y FILTRO

        $('#table').DataTable({
            "responsive": true,
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "../services/Cineleco/ajax_listar",
                "type": "POST"
            },



            //Set column definition initialisation properties.
            "columnDefs": [
                {
                    "targets": [ -1 ], //last column
                    "orderable": false, //set not orderable
                },
            ],

        });

        //@TODO Editar Empleado

        $('body').on('click','.editar_empleado',function(){

            var id = $(this).attr('idEmpleado');
            var idEmpleado = $(this).attr('idEmpleado');
            var nomEmpleado = $(this).attr('nomEmpleado');
            var corrEmpleado = $(this).attr('corrEmpleado');
            var fotoEmpleado = $(this).attr('fotoEmpleado');
            var imagenSuccess='';

            imagenSuccess+='<div class="form-group"><label for="peril_foto_empleado" id="imagenEmpleado"><img style="width: 20%; height: 20%;" src="'+BASE_URL+'webroot/upload/'+fotoEmpleado+'" alt=""></label></div>';
            $('#imagenPerfil').html(imagenSuccess);

            $('[name="id"]').val(id);
            $('[name="idEmpleado"]').val(idEmpleado);
            $('[name="fotoEmpleado"]').val(nomEmpleado);
            $('[name="nomEmpleado"]').val(nomEmpleado);
            $('[name="corrEmpleado"]').val(corrEmpleado);


            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Editar Empleado: '+nomEmpleado); // Set title to Bootstrap modal title

            //alert(idPost);
            //OBJ_DATOS.LOGIC.loadPerfil(idPost);
            return false;
        });


//@TODO ACTUALIZAR



        $('body').on('click','.formularioEmpleadoActualizar',function(){

            var datosFormulario = new FormData($('#formularioEmpleadoActualizar')[0]);
            console.log(datosFormulario);
            var id= document.getElementById('id').value;
            var nombre= document.getElementById('nomEmpleado').value;
            var correo= document.getElementById('corrEmpleado').value;

            OBJ_DATOS.LOGIC.actualizarDatosEmpleado(nombre,correo,id);


            return false;
        });


        //@TODO INFORMACION EMPLEADO

        $('body').on('click','.editarEmpleado',function(){
            var idPost = $(this).attr('idPost');
            alert(idPost);
            OBJ_DATOS.LOGIC.loadPerfil(idPost);
            return false;
        });


        $('#nuevoConjunto').on('submit', function(e){
            e.preventDefault();
            OBJ_CONJUNTO.LOGIC.guardarNConjunto(this);
        });

        $('#loadImagen').on('click',function(){
            $('#foto').trigger('click');
            return false;
        });

        $('#foto').on('change',function(e){
            //alert('Envia Ajax');
            e.preventDefault();
            var idfoto=0;
            OBJ_DATOS.LOGIC.upload_imagen(idfoto);
        });

//@TODO Agregar imagenes al producto
        $('#loadf_producto_1').on('click',function(){
            alert('hola 1');
            $('#foto_producto_1').trigger('click');
            return false;
        });
        $('#loadf_producto_2').on('click',function(){
            alert('hola 2');
            $('#foto_producto_2').trigger('click');
            return false;
        });
        $('#loadf_producto_3').on('click',function(){
            alert('hola 3');
            $('#foto_producto_3').trigger('click');
            return false;
        });

        $('#foto_producto_1').on('change',function(e){
            //alert('Envia Ajax');
            e.preventDefault();
            var idfoto=1;
            OBJ_DATOS.LOGIC.upload_imagen(idfoto);
        });

        $('#foto_producto_2').on('change',function(e){
            //alert('Envia Ajax');
            e.preventDefault();
            var idfoto=2;
            OBJ_DATOS.LOGIC.upload_imagen(idfoto);
        });

        $('#foto_producto_3').on('change',function(e){
            //alert('Envia Ajax');
            e.preventDefault();
            var idfoto=3;
            OBJ_DATOS.LOGIC.upload_imagen(idfoto);
        });

    },
    LOGIC:{
        nombre_de_la_funcion:function(This){
            var nformulario = $(This).serialize();
            console.log('formulario');
        },
//@TODO nuevoProducto
        nuevoProducto:function(nombreProducto,descripcionProducto,referenciaNombre,referenciaPrecio,idnuevoproducto){

            var formulario = { 'nombreProducto':nombreProducto,'descripcionProducto':descripcionProducto,
                'referenciaNombre':referenciaNombre,'referenciaPrecio':referenciaPrecio ,'idnuevoproducto':idnuevoproducto};

            var  AlertSuccess='';
            Ajax('services/Cineleco/nuevo_producto',formulario, function(msg){
                console.log(msg);
                if(msg.dataObj > 0){
                    AlertSuccess+='<div class="alert alert-success"> <strong></strong> Informacion con exito.</div>';

                    var id= document.getElementById("idnuevoproducto").value=msg.dataObj;

                }
                $('#alertActualizacionDatos').html(AlertSuccess);

            });
        },

//@TODO Actualizar datos del empleado
        actualizarDatosEmpleado:function(nombre,correo,id){
            var formulario = {'id':id, 'nombre':nombre,'correo':correo };
            AlertSuccess='';
            Ajax('services/Cineleco/actualizar_datos_empleado',formulario, function(msg){
                console.log(msg);
                if(msg.dataObj > 0){
                    AlertSuccess+='<div class="alert alert-success"> <strong></strong> Informacion con exito.</div>';
                }
                $('#alertActualizacionDatos').html(AlertSuccess);
                var tiempo = 1000;

                setTimeout(function() {
                    window.location.href = "http://preproduccionsitios2.info/tmp43/cineleco/inicio/listado";
                }, tiempo);
            });
        },

        upload_imagen:function(idfoto){
            //var datosFormulario = new FormData(This);
            // var datosFormulario = new FormData($('#fotos')[0]);


            if (idfoto == 0){
                var foto=document.getElementById("foto").value;
                var datosFormulario = new FormData($('#fotos')[0]);
                console.log(datosFormulario);
                if(!foto){
                    console.log('Foto nula')
                }else{
                    console.log(foto);

                    AjaxFile('services/Cineleco/upload_imagen',datosFormulario, function(msg){
                        console.log(msg);

                        var idEmpleado= document.getElementById("idEmpleado").value;
                        OBJ_DATOS.LOGIC.actualiza_htmlFoto(idEmpleado);
                    });
                }

            }
            if (idfoto ==1){
                var foto=document.getElementById("foto_producto_1").value;
                var datosFormulario = new FormData($('#fotos1')[0]);
                console.log(datosFormulario);
                if(!foto){
                    console.log('Foto nula')
                }else{
                    console.log(foto );

                    AjaxFile('services/Cineleco/upload_imagen_producto',datosFormulario, function(msg){
                        console.log(msg);
                    });
                }

            }
            if (idfoto ==2){
                var foto=document.getElementById("foto_producto_2").value;
                var datosFormulario = new FormData($('#fotos2')[0]);
                console.log(datosFormulario);

            }
            if (idfoto ==3){
                var foto=document.getElementById("foto_producto_3").value;
                var datosFormulario = new FormData($('#fotos3')[0]);
                console.log(datosFormulario);

            }


            if(!foto){
                console.log('Foto nula')
            }else{
                console.log(foto+'fotossss');

                AjaxFile('services/Cineleco/upload_imagen',datosFormulario, function(msg){
                    console.log(msg);

                    var idEmpleado= document.getElementById("idEmpleado").value;
                    OBJ_DATOS.LOGIC.actualiza_htmlFoto(idEmpleado);
                });
            }

        },



        //@TODO ID USUARIO
        perfilId:function(This){
            var formulario = {'id':6};
            //console.log(formulario);
            Ajax('services/Cineleco/perfil_get_id',formulario, function(msg){
                console.log(msg);
                $.each(msg.dataObj,function(i,j){
                });

            });
        },
//TODO ACTUALIZAR EN EL HTML LA FOTO DEL EMPLEADO
        actualiza_htmlFoto:function(idEmpleado){
            var formulario = {'id':idEmpleado};

            console.log(formulario);
            Ajax('services/Cineleco/perfil_get_foto_empleado',formulario, function(msg){
                console.log(msg);

                var imagenSuccess='';
                var alert='';
                $.each(msg.dataObj,function(i,j){
                    imagenSuccess+='<div class="form-group"><label for="peril_foto_empleado" id="imagenEmpleado"><img style="width: 20%; height: 20%;" src="'+BASE_URL+'webroot/upload/'+j.usu_url_foto+'" alt=""></label></div>';
                    imagenSuccess+='<div class="alert alert-success"> <strong></strong> Nueva foto con exito.</div>';
                });

                $('#imagenPerfil').html(imagenSuccess);


                $('#alertFoto').html(alert);

            });
        },

//TODO Render loadPerfil
        loadPerfil:function(This){
            var formulario = {'id':6};
            //console.log(formulario);
            Ajax('services/Cineleco/perfil_get_id',formulario, function(msg){
                console.log(msg);
                var vista =  OBJ_DATOS.VIEWS.render_table(msg.dataObj);
                $('#render_informacionEmpleado').html(vista);

            });
        },

        actualiza_tabla:function(This){
            var formulario = $(This).serialize();
            console.log(formulario);
            Ajax('services/Cineleco/octenerListadoEmpleados',formulario, function(msg){
                console.log(msg);
                var vista =  OBJ_DATOS.VIEWS.render_table(msg.dataObj);
                $('#popularTabla').html(vista);

            });
        },
        resposive:function() {
            $('#data-table, #data-table1, #data-table2').DataTable({
                responsive: true
            });
        },
    },
    VIEWS:{
        render_table:function(obj){
            var html='';

            $.each(obj,function(i,j){
                html+='<tr>';
                html+='<td>';
                html+='<div class="profile-img" style="background: url('+BASE_URL+'webroot/upload/'+ j.usu_url_foto+');"></div>';
                html+='</td>';
                html+='<td>'+ j.usu_nombre+'</td>';
                html+='<td>'+ j.usu_correo+'</td>';
                html+='<td>123456</td>';
                html+='<td>';
                //html+='<a href="'+BASE_URL+'Inicio/editarUsuario"><button type="button" class="btn btn-danger">Editar <span class="fa fa-pencil"></span></button></a>';
                html+='<a class="btn btn-sm btn-primary" href="actualizar/'+ j.usu_id+'"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
                //html+= 	'<button  idPost="'+ j.usu_id+'" class="btn btn-sm btn-primary editarEmpleado">Editar</button>';
                html+='</td>';
                html+='</tr>';
            })

            return html;
        },

        render_informacionEmpleado:function(obj){
            var html='';

            $.each(obj,function(i,j){
                //html+= '<li>'+j.nombre+' </li>';
                //html+= 	'<li>'+j.fechar+'</li>';
                //html+= 	'</ul>';
                //html+= 	'<li><img src="'+BASE_URL+'corte/images/share1.png" alt=""></li>';
                html+='<tr>';
                html+='<td>';
                html+='<div class="profile-img" style="background: url('+BASE_URL+'webroot/upload/'+ j.usu_url_foto+');"></div>';
                html+='</td>';
                html+='<td>'+ j.usu_nombre+'</td>';
                html+='<td>'+ j.usu_correo+'</td>';
                html+='<td>123456</td>';
                html+='<td>';
                //html+='<a href="'+BASE_URL+'Inicio/editarUsuario"><button type="button" class="btn btn-danger">Editar <span class="fa fa-pencil"></span></button></a>';
                html+='<a class="btn btn-sm btn-primary" href="actualizar/'+ j.usu_id+'"><i class="glyphicon glyphicon-pencil"></i> Editar</a>';
                html+='</td>';
                html+='</tr>';
            })

            return html;
        },
    },
    LIBRARY:function(){

    }
};

