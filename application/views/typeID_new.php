<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('typeID/newItem'); ?>
	<table id='dataTable' align='center'>
		<tr>
			<th colspan="8">Agregar Tipo de Identificación</th>
		</tr>
        <tr><td colspan="8">&nbsp;</td></tr>
		<tr>
			<td width="40%">
				Abreviatura <strong>*</strong>
			</td>
			<td width='60%'>
				<?php echo form_input(array('name' => 'tid_simbolo', 'id' => 'tid_simbolo', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  set_value('tid_simbolo'))); ?>
			</td>
            </tr>
            <tr>
			<td>
				Estado
			</td>
			<td>
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
		</tr>
		<tr>
			<td>
				Nombre / Descripción <strong>*</strong>
			</td>
			<td>
				<?php echo form_input(array('name' => 'tid_nombre', 'id' => 'tid_nombre', 'width' => '20', 'size' => '120', 'class' => 'caja', 'value'=>  set_value('tid_nombre') )); ?>
			</td>
		</tr>
        <tr><td colspan="8">&nbsp;</td></tr>
		<tr>
			<td colspan="4" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Almacenar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('tid_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>