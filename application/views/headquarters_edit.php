<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('headquarters/edit'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Editar Sede Corporativa</th>
		</tr>
		
		<tr>
			<td width="25%">
				Nombre <strong>*</strong>
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'sed_nombre', 'id' => 'sed_nombre', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_nombre )); ?>
			</td>
			<td width="25%">
				Estado
			</td>
			<td width="25%">
				<?php echo form_dropdown('est_id', $estadoActivo, $estadoActivoPredef); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Ciudad 
			</td>
			<td width='25%'>
				<?php echo form_dropdown('ciu_id', $ciudadActivo, $ciudadActivoPredef); ?>
			</td>
			<td width="25%">
				Encargado
			</td>
			<td width="25%">
				<?php echo form_dropdown('usr_idSupervisor', $responsableActivo, $responsableActivoPredef); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Dirección <strong>*</strong>
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'sed_direccion', 'id' => 'sed_direccion', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_direccion )); ?>
			</td>
			<td width="25%">
				Teléfono(s) <strong>*</strong>
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'sed_telefono', 'id' => 'sed_telefono', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_telefono )); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Fax 
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'sed_fax', 'id' => 'sed_fax', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_fax )); ?>
			</td>
			<td width="25%">
				Correo Contacto
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'sed_correocorporativo', 'id' => 'sed_correocorporativo', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_correocorporativo )); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Página Web
			</td>
			<td width='75%' colspan="3">
				<?php echo form_input(array('name' => 'sed_paginaweb', 'id' => 'sed_paginaweb', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $sed_paginaweb )); ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('sed_id', $sed_id); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>