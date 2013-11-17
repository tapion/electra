<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('user/edit'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Editar Usuario</th>
		</tr>
		<tr>
			<td width="25%">
				Nombres <strong>*</strong>
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'usr_nombres', 'id' => 'usr_nombres', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_nombres )); ?>
			</td>
			<td width="25%">
				Apellidos <strong>*</strong>
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'usr_apellidos', 'id' => 'usr_apellidos', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_apellidos )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Ciudad de Nacimiento
			</td>
			<td>
				<?php echo form_dropdown('ciu_idnacimiento', $ciudadDisponible, $cNacimientoUsuarioPredef); ?>
			</td>
			<td>
				Ciudad de Residencia
			</td>
			<td>
				<?php echo form_dropdown('ciu_idresidencia', $ciudadDisponible, $cResidenciaUsuarioPredef); ?>
			</td>
		</tr>
		<tr>
			<td>
				Género 
			</td>
			<td>
				<?php echo form_dropdown('gen_id', $generoUsuario, $generoUsuarioPredef); ?>
			</td>
			<td>
				Estado Civil
			</td>
			<td>
				<?php echo form_dropdown('ecv_id', $estadoCivilDisponible, $estadoCivilDisponiblePredef); ?>
			</td>
		</tr>
		<tr>
			<td>
				Dirección de Residencia
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_direccionresidencia', 'id' => 'usr_direccionresidencia', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_direccionresidencia )); ?>
			</td>
			<td>
				Teléfono Fijo
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_telefonofijo', 'id' => 'usr_telefonofijo', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_telefonofijo )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Teléfono Celular
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_telefonocelular', 'id' => 'usr_telefonocelular', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_telefonocelular )); ?>
			</td>
			<td>
				Teléfono Corporativo 
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_extensiontelefono', 'id' => 'usr_extensiontelefonica', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_extensiontelefono )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Correo Personal
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_correopersonal', 'id' => 'usr_correopersonal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_correopersonal )); ?>
			</td>
			<td>
				Correo Corporativo
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_correocorporativo', 'id' => 'usr_correocorporativo', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_correocorporativo )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Sede Corporativa
			</td>
			<td>
				<?php echo form_dropdown('sed_id', $sedeDisponible, $sedeDisponiblePredef); ?>
			</td>
			<td>
				Cargo Desempeñado
			</td>
			<td>
				<?php echo form_dropdown('crg_id', $cargoDisponible, $cargoDisponiblePredef); ?>
			</td>
		</tr>
		<tr>
			<td>
				Nombre de Usuario <strong>*</strong>
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_nombreusuario', 'id' => 'usr_nombreusuario', 'width' => '20', 'size' => '30', 'class' => 'caja', 'style' => 'text-transform:lowercase;', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value'=>  $usr_nombreusuario )); ?>
			</td>
			<td>
				Contraseña
			</td>
			<td>
				<?php echo form_password(array('name' => 'usr_contrasena', 'id' => 'usr_contrasena', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_contrasena )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Fecha de Ingreso <strong>*</strong>
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_fechaingreso', 'id' => 'usr_fechaingreso', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_fechaingreso )); ?>
			</td>
			<td>
				Fecha de Retiro
			</td>
			<td>
				<?php echo form_input(array('name' => 'usr_fecharetiro', 'id' => 'usr_fecharetiro', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $usr_fecharetiro )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Estado
			</td>
			<td colspan="3">
				<?php echo form_dropdown('est_id', $estadoActivo, $estadoActivoPredef); ?>
			</td>
			
		</tr>
		<tr>
			<td colspan="4" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('usr_id', $usr_id); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>