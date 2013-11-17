<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('commercialLine/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar Línea Comercial</th>
		</tr>
		<tr>
			<td width="25%">
				Abreviatura <strong>*</strong>
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'lcm_abreviatura', 'id' => 'lcm_abreviatura', 'width' => '20', 'size' => '5', 'class' => 'caja', 'style' => 'text-transform:uppercase;', 'maxlength' => '3', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value' =>set_value('lcm_abreviatura') )); ?>
			</td>
			<td width="25%">
				Nombre de Línea <strong>*</strong>
			</td>
			<td width="25%">
				<?php echo form_input(array('name' => 'lcm_nombre', 'id' => 'lcm_nombre', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  set_value('lcm_nombre') )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Estado
			</td>
			<td colspan="3">
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
		</tr>
		<tr>	
			<td>
				Descripción / Detalle
			</td>
			<td>
				<?php echo form_textarea(array('name' => 'lcm_descripcion', 'value' => set_value('lcm_descripcion'), 'cols' => '30', 'rows' => '10')); ?>
			</td>
			<td>
				Historia de la Marca
			</td>
			<td>
				<?php echo form_textarea(array('name' => 'lcm_historia', 'value' => set_value('lcm_historia'), 'cols' => '30', 'rows' => '10')); ?>
			</td>
		</tr>
		<tr>	
			<td>
				Productos o Categorías
			</td>
			<td>
				<?php echo form_textarea(array('name' => 'lcm_productos', 'value' => set_value('lcm_productos'), 'cols' => '30', 'rows' => '10')); ?>
			</td>
			<td>
				Campos de Acción
			</td>
			<td>
				<?php echo form_textarea(array('name' => 'lcm_campos', 'value' => set_value('lcm_campos'), 'cols' => '30', 'rows' => '10')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="4" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('lcm_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>