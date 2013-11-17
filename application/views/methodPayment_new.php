<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('methodPayment/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar Forma de Pago</th>
		</tr>
		<tr>
			<td>
				Abreviatura Principal
			</td>
			<td>
				<?php echo form_input(array('name' => 'fpg_abreviatura', 'id' => 'fpg_abreviatura', 'width' => '20', 'size' => '5', 'class' => 'caja', 'style' => 'text-transform:uppercase;', 'maxlength' => '3', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value' =>set_value('fpg_abreviatura') )); ?>
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
				Nombre de la Forma de Pago <strong>*</strong>
			</td>
			<td width='75%' colspan="3">
				<?php echo form_input(array('name' => 'fpg_nombre', 'id' => 'fpg_nombre', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  set_value('fpg_nombre') )); ?>
			</td>
			
			
		</tr>
		<tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('fpg_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>