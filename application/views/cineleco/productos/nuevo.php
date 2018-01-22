<div id="page-nuevo">
	<h3 class="title-page">Agregar nuevo producto</h3>

	<form action="" id="formularionuevoproducto">
		<div class="form-group">
			<label for="">Nombre del producto:</label>
			<input type="text" id="nombreproducto" required class="form-control">
		</div>

		<div class="form-group">
			<label for="">Descripción:</label>
			<textarea name="" id="descripcion" cols="30" rows="10" class="form-control"></textarea>
		</div>

		<label for="">Referencia del producto:</label>
		<div class="row">
			<div class="col-xs-6">
				<div class="form-group">
					<input type="text" id="referencianombre" required class="form-control" placeholder="Nombre ref">
				</div>
			</div>
			<div class="col-xs-6">
				<div class="form-group">
					<input type="text" id="referenciaprecio" required class="form-control" placeholder="Precio ref">
				</div>
			</div>
			<div class="col-xs-12">
				<div class="form-group">
					<button type="button" id="formularionuevoproductoreferencia" class="btn btn-danger pull-right">Añadir mas Referencias</button>
                    <input  type="hidden" id="idnuevoproducto" name="idnuevoproducto"   value="">
                    <div class="clearfix"></div>
				</div>
			</div>
            <div id="alertActualizacionDatos"></div>
		</div>


		<div class="form-group">
			<p class="label">Foto del producto 1:</p>
			<input type="file" id="loadf_producto_1" class="form-control">
			<label for="foto_producto_1"><span class="fa fa-upload"></span> Cargar foto 1</label>
		</div>
		<div class="form-group">
			<p class="label">Foto del producto 2:</p>
			<input type="file" id="loadf_producto_2" class="form-control">
			<label for="foto_producto_2"><span class="fa fa-upload"></span> Cargar foto 2</label>
		</div>
		<div class="form-group">
			<p class="label">Foto del producto 3:</p>
			<input type="file" id="loadf_producto_3" class="form-control">
			<label for="foto_producto_3"><span class="fa fa-upload"></span> Cargar foto 3</label>
		</div>
        <div style="display:none">
            <form enctype="multipart/form-data"  id="fotos1" >
                <input  type="hidden" id="idfotonuevoproducto" name="idfotonuevoproducto"   value="1">
                <input  type="hidden" id="fotonuevoproducto" name=" fotonuevoproducto"   value="producto">
                <input  type="file" id="foto_producto_1" name="foto_producto_1" class="hidden"><label for="foto"><img src="<?php echo base_url()?>webroot/images/profile.png" alt=""></label>

            </form>
            <form enctype="multipart/form-data"  id="fotos2" >
                <input  type="hidden" id="idfotonuevoproducto" name="idfotonuevoproducto"   value="2">
                <input  type="hidden" id="fotonuevoproducto" name="fotonuevoproducto"   value="producto">
                <input  type="file" id="foto_producto_2" name="foto_producto_2" class="hidden"><label for="foto"><img src="<?php echo base_url()?>webroot/images/profile.png" alt=""></label>
            </form>
            <form enctype="multipart/form-data"  id="fotos3" >
                <input  type="hidden" id="idfotonuevoproducto" name="idfotonuevoproducto"   value="3">
                <input  type="hidden" id="fotonuevoproducto" name="fotonuevoproducto"   value="producto">
                <input  type="file" id="foto_producto_3" name="foto_producto_3" class="hidden"><label for="foto"><img src="<?php echo base_url()?>webroot/images/profile.png" alt=""></label>
            </form>
        </div>

		<div class="form-group">
			<button type="submit" class="btn btn-danger btn-block">Guardar</button>
		</div>
	</form>
</div>