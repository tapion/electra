<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('observation/newItem'); ?>
	<table id='dataTable' align='center'>
		<tr>
			<th colspan="8">Agregar Observación Comercial</th>
		</tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
		<tr>
			<td width="40%">
				Estado
			</td>
			<td width="60%">
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
		</tr>
		<tr>
			<td width="25%">
				Nombre / Descripción <strong>*</strong>
			</td>
			<td width="75%">
				<?php echo form_textarea(array('name' => 'obs_detalle', 'value' => set_value('obs_detalle'), 'cols' => '110', 'rows' => '10', 'class' => 'caja')); ?>
			</td>
		</tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
		<tr>
			<td colspan="4" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('obs_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>