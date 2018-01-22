<?php
	/**
	 * Created by PhpStorm.
	 * User: fidelfuentes
	 * Date: 16/11/17
	 * Time: 2:29 PM
	 */
?>

<div id="EMP_listado">
	<h1 class="title-page">Listado de empleados</h1>
	
	<table class="table table-bordered table-general" id="data-table" width="100%">
		<thead>
		<th>Foto de perfil</th>
		<th>Nombre</th>
		<th>Correo</th>
		<th>Contraseña</th>
		<th>Acción</th>
		</thead>
		<tbody id="popularTabla">

 		</tbody>
<!--	</table>-->


    <table id="table" class=" table table-hover   table-bordered table-general" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>Foto Empleado</th>
            <th>Nombre Completo</th>
            <th>Correo</th>
            <th style="width:125px;">Accion</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>



    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h3 class="modal-title">Person Form</h3>
                </div>
                <div class="modal-body form">
                    <form action="#" id="formularioEmpleadoActualizar" class="form-horizontal">
                        <input type="hidden" value="" name="id" id="id" />
                        <div class="form-body">
                            <div class="form-group">
                                <label class="control-label col-md-3">Foto </label>
                                <div class="col-md-9">
                                    <button id="loadImagen" class="btn btn-sm btn-primary">Cargar imagen</button>

                                    <div id="imagenPerfil"></div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">First Name</label>
                                <div class="col-md-9">
                                    <input name="nomEmpleado"  id="nomEmpleado" placeholder="Nombre Empleado" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Last Name</label>
                                <div class="col-md-9">
                                    <input name="corrEmpleado" id="corrEmpleado" placeholder="Correo Empleado" class="form-control" type="text">
                                </div>
                            </div>

                        </div>
                        <div id="alertActualizacionDatos"></div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSave"  class="btn btn-primary formularioEmpleadoActualizar"> Guardar</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->

    <div style="display:none">
        <form enctype="multipart/form-data"  id="fotos" >

            <input  type="hidden" id="idEmpleado" name="idEmpleado"   value="">
            <input  type="file" id="foto" name="foto" class="hidden"><label for="foto"><img src="<?php echo base_url()?>webroot/images/profile.png" alt=""></label>
        </form>
    </div>

</div>

