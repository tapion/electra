<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('user/info'); ?>
	<table id='dataTable'>
    	<tr>
        	<th colspan="6">Información de mi Cuenta</th>
        </tr>
        <tr>
        	<td colspan="6">&nbsp;</td>
        </tr>
		
		<tr>
			<td width="25%">Nombres</td>
			<td width="25%"><?php echo form_input(array('name' => 'usr_nombres', 'id' => 'usr_nombres', 'width' => '30', 'size' => '30', 'class' => 'caja', 'value'=>$nombreUsuario)); ?></td>
			<td width="25%">Apellidos</td>
			<td width="25%"><?php echo form_input(array('name' => 'usr_apellidos', 'id' => 'usr_apellidos', 'width' => '30', 'size' => '30', 'class' => 'caja', 'value'=>$apellidosUsuario )); ?></td>
		</tr>
		<tr>
			<td>Ciudad de Nacimiento</td>
			<td><?php echo form_dropdown('ciu_idnacimiento', $ciudadDisponible, $cNacimientoUsuarioPredef); ?></td>
			<td>Ciudad de Residencia</td>
			<td><?php echo form_dropdown('ciu_idresidencia', $ciudadDisponible, $cResidenciaUsuarioPredef); ?></td>
		</tr>
		<tr>
			<td>Sede Corporativa</td>
			<td><?php echo form_dropdown('Mostrar', $sedeUsuario); ?></td>
			<td>Cargo Desempeñado</td>
			<td><?php echo form_dropdown('Mostrar', $cargoUsuario); ?></td>
		</tr>
		<tr>
			<td>Estado</td>
			<td><?php echo form_dropdown('Mostrar', $estadoUsuario); ?></td>
			<td>Género</td>
			<td><?php echo form_dropdown('gen_id', $generoUsuario, $generoUsuarioPredef); ?></td>
		</tr>
		<tr>
			<td>Correo Personal</td>
			<td><?php echo form_input(array('name' => 'usr_correoPersonal', 'id' => 'usr_correoPersonal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>$cPersonalUsuario )); ?></td>
			<td>Correo Corporativo</td>
			<td><?php echo form_input(array('name' => 'usr_correoCorporativo', 'id' => 'usr_correoCorporativo', 'width' => '25', 'size' => '30', 'class' => 'caja', 'value'=>$cCorporativoUsuario )); ?></td>
		</tr>
		<tr>
			<td>Nombre de Usuario</td>
			<td><?php echo form_input(array('name' => 'oldpwd', 'id' => 'oldpwd', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>$loginUsuario, 'disabled' => 'disabled' )); ?></td>
			<td>Teléfono(s) de Contacto</td>
			<td><?php echo form_input(array('name' => 'usr_extensionTelefono', 'id' => 'usr_extensionTelefono', 'width' => '30', 'size' => '30', 'class' => 'caja', 'value'=>$telefonoUsuario )); ?></td>
		</tr>
        <tr>
        	<td colspan="6">&nbsp;</td>
        </tr>
		<tr>
			<td colspan="4" align="right"><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar mi Cuenta', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<br>
	<?php echo form_close(); ?>
</div>