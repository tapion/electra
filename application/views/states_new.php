<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('states/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar Departamento</th>
		</tr>
		<tr>
			<td width="25%">
				País 
			</td>
			<td width='25%'>
				<?php echo form_dropdown('pai_id', $paisActivo); ?>
			</td>
			<td width="25%">
				Estado
			</td>
			<td width="25%">
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Abreviatura 
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'dep_abreviatura', 'id' => 'dep_abreviatura', 'maxlength' => '3', 'width' => '20', 'size' => '10', 'class' => 'caja', 'value'=>  set_value('dep_abreviatura') )); ?>
			</td>
			<td width="25%">
				Nombre / Descripción <strong>*</strong>
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'dep_nombre', 'id' => 'dep_nombre', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  set_value('dep_nombre') )); ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('dep_id', ''); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>