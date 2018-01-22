<?php
	/**
	 * Created by PhpStorm.
	 * User: fidelfuentes
	 * Date: 16/11/17
	 * Time: 11:00 AM
	 */


	$input_nombre = array(
		'name'        => 'nombre',
		'id'          => 'nombre',
		'maxlength'   => '100',
		'class'       =>'form-control',
		'placeholder' =>'Nombre completo',
		'value'		  => set_value('nombre',@$dataProvider['data'][0]['usu_nombre'])
	);


	$input_correo = array(
		'name'        => 'correo',
		'id'          => 'correo',
		'maxlength'   => '100',
		'type'        => 'email',
		'class'       =>'form-control',
		'placeholder' =>'Correo',
		'value'		  => set_value('correo',@$dataProvider['data'][0]['usu_correo'])
	);

	$input_telefono = array(
		'name'        => 'telefono',
		'id'          => 'telefono',
		'maxlength'   => '100',
		'class'       =>'form-control',
		'placeholder' =>'Telefono',
		'value'		  => set_value('telefono',@$dataProvider['data'][0]['telefono'])
	);

	$input_password= array(
		'name'        => 'password',
		'id'          => 'password',
		'maxlength'   => '100',
		'type'       => 'password',
		'class'       =>'form-control ',
		'placeholder' =>'Password',
		'value'		  => set_value('password',@$dataProvider['data'][0]['password'])
	);

    $input_foto= array(
		'name'        => 'foto',
		'id'          => 'foto',
		'maxlength'   => '100',
 		'class'       =>'form-control',
		'placeholder' =>'foto',
		'value'		  => set_value('password', $dataProvider['data'][0]['usu_url_foto'])
	);
?>


<div id="EMP_nuevo">
    <?php
        $sessionActiva= $this->session->userdata('logged_in');
        if ( !isset($sessionActiva)) : ?>
        <h1 class="title-page">Agregar nuevo empleado: </h1>
    <?php endif ; ?>
    <?php if ( isset($sessionActiva)) : ?>
        <h1 class="title-page">Información del emplead@: <?php echo $dataProvider['data'][0]['usu_nombre'];?></h1>
    <?php endif ; ?>
    <?php if (isset($alertaFormulario)) : ?>
        <div class="alert alert-danger">Erro de usuario o clave</div>
    <?php endif ; ?>

    <?php echo form_open() ?>
		<div class="row">
<!--            --><?php
//                if (isset($sessionActiva)) : ?>
<!--                    <div class="col-xs-12 col-sm-6">-->
<!--                        <div class="form-group">-->
<!--                            <button id="loadImagen" class="btn btn-sm btn-primary">cargar imagen</button>-->
<!--                                <div id="imagenPerfil">-->
<!--                                    <div class="form-group">-->
<!--                                        <label for="peril_foto_empleado" id="imagenEmpleado"><img style="width: 20%; height: 20%;" src="--><?php //echo base_url();?><!--webroot/upload/--><?php //echo $dataProvider['data'][0]['usu_url_foto'];?><!--" alt=""></label>-->
<!--                                    </div>-->
<!--                                    <div id="alertFoto"></div>-->
<!--                                </div>-->
<!--<!--                            <p class="label">Foto de perfil:</p>-->
<!--<!--                            <input type="file" class="form-control" id="foto_perfil">-->
<!--<!--                            <label for="foto_perfil"><span class="fa fa-upload"></span> Foto de perfil</label>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                --><?php //endif ; ?>
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label for="">Nombre:</label>
<!--					<input type="text" class="form-control">-->
					<?php   echo form_error('nombre'); ?>
					<?php	echo form_input($input_nombre); ?><br>
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="form-group">
					<label for="">Correo:</label>
<!--					<input type="email" class="form-control">-->
					<?php   echo form_error('correo'); ?>
					<?php	echo form_input($input_correo); ?><br>
				</div>
			</div>
                         <div class="col-xs-12 col-sm-6">
                            <div class="form-group">
                                <label for="">Contraseña:</label>
            <!--					<input type="password" class="form-control">-->
                                <?php   echo form_error('password'); ?>
                                <?php	echo form_input($input_password); ?><br>
                            </div>
                        </div>

            <div class="col-xs-12">
                <?php if (isset($exito_actualizacion)) : ?>
                    <div class="alert alert-success">Actualizacion Exitosa </div>
                <?php endif ; ?>
				<div class="form-group">
<!--					<button type="button" class="btn btn-danger pull-right">Guardar <span class="fa fa-save"></span></button>-->
                    <?php if ( isset($sessionActiva)) : ?>
                        <input  type="input" id="idEmpleado" name="idEmpleado" class="hidden" value="<?php echo $dataProvider['data'][0]['usu_id']; ?>">
                        <?php echo form_submit('btn_enviar','Guardar', 'class="btn btn-danger pull-right"' ) ?>
                    <?php endif ; ?>
                    <?php if ( !isset($sessionActiva)) : ?>
                    <?php echo form_submit('btn_enviar','Registrarme', 'class="btn btn-danger pull-right"' ) ?>
                    <?php endif ; ?>


                </div>
			</div>
		</div>

	</form>


    <div style="display:none">
        <form enctype="multipart/form-data"  id="fotos" >

            <input  type="input" id="idEmpleado" name="idEmpleado" class="hidden" value="<?php echo $dataProvider['data'][0]['usu_id']; ?>">

            <input  type="file" id="foto" name="foto" class="hidden"><label for="foto"><img src="<?php echo base_url()?>webroot/images/profile.png" alt=""></label>
        </form>
    </div>
</div>























