<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('contactLine/edit'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Editar Línea de Contacto</th>
		</tr>
		<tr>
			<td>
				Abreviatura Principal
			</td>
			<td>
				<?php echo form_input(array('name' => 'lnc_abreviatura', 'id' => 'lnc_abreviatura', 'width' => '20', 'size' => '5', 'class' => 'caja', 'style' => 'text-transform:uppercase;', 'maxlength' => '3', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value' =>$lnc_abreviatura )); ?>
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
				Nombre de línea de Contacto <strong>*</strong>
			</td>
			<td width='75%' colspan="3">
				<?php echo form_input(array('name' => 'lnc_nombre', 'id' => 'lnc_nombre', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $lnc_nombre )); ?>
			</td>
			
			
		</tr>
		<tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('lnc_id', $lnc_id); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>