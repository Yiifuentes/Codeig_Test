<?php
    /**
     * Created by PhpStorm.
     * User: fidelfuentes
     * Date: 16/11/17
     * Time: 11:00 AM
     */





    $input_correo = array(
            'name'        => 'correo',
            'id'          => 'correo',
            'maxlength'   => '100',
            'class'       =>'form-control',
            'placeholder' =>'Correo',
            'value'		  => set_value('correo',@$dataProvider['data'][0]->correo)
    );



    $input_password= array(
            'name'        => 'password',
            'id'          => 'password',
            'maxlength'   => '100',
            'type'       => 'password',
            'class'       =>'form-control',
            'placeholder' =>'Password',
            'value'		  => set_value('password',@$dataProvider['data'][0]->password)
    );
?>

<div id="EMP_nuevo">
    <h1 class="title-page">Inicio de sesion empleado</h1>
    <?php if (isset($error_login)) : ?>
        <div class="alert alert-danger">Erro de usuario o clave</div>
    <?php endif ; ?>
    <?php echo validation_errors(); ?>

            <?php echo form_open() ?>
                    <div class="row">
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
                            <div class="form-group">
                                <!--					<button type="button" class="btn btn-danger pull-right">Guardar <span class="fa fa-save"></span></button>-->
                                <?php echo form_submit('btn_enviar','Registrarme', 'class="btn btn-danger pull-right"' ) ?>

                            </div>
                        </div>
                    </div>
            </form>
</div>
