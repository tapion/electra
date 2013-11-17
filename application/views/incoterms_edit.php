<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('incoterms/edit'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Editar INCOTERM</th>
		</tr>
		<tr>
			<td width="25%">
				Abreviatura <strong>*</strong>
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'inc_abreviatura', 'id' => 'inc_abreviatura', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $inc_abreviatura )); ?>
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
				Nombre / Descripción
			</td>
			<td width="75%" colspan="3">
				<?php echo form_input(array('name' => 'inc_nombre', 'id' => 'inc_nombre', 'width' => '20', 'size' => '120', 'class' => 'caja', 'value'=>  $inc_nombre )); ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('inc_id', $inc_id); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>