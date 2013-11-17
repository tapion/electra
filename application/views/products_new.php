<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('products/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar Producto</th>
		</tr>
		<tr>
			<td width="17%">
				Línea Comercial
			</td>
			<td width='17%'>
				<?php echo form_dropdown('lcm_id', $lineaComercial); ?>
			</td>
			<td width="17%">
				Código ID <strong>*</strong>
			</td>
			<td width="17%">
				<?php echo form_input(array('name' => 'prd_codigo', 'id' => 'prd_codigo', 'maxlength' => '14', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  set_value('prd_codigo') )); ?>
			</td>
			<td width="17%">Producto Padre</td>
			<td width="17%"><?php echo form_input(array('name' => 'prd_idpadre', 'id' => 'prd_idpadre', 'maxlength' => '14', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  set_value('prd_idpadre') )); ?></td>
		</tr>
		<tr>
			<td>
				Estado
			</td>
			<td>
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
			<td>Dimensiones</td>
			<td align='center'><?php echo form_input(array('name' => 'prd_dimensiones', 'id' => 'prd_dimensiones', 'maxlength' => '10', 'width' => '20', 'size' => '5', 'class' => 'caja', 'value'=>  set_value('prd_dimensiones') )); ?></td>
			<td>Peso</td>
			<td align='center'><?php echo form_input(array('name' => 'prd_peso', 'id' => 'prd_peso', 'maxlength' => '10', 'width' => '20', 'size' => '5', 'class' => 'caja', 'value'=>  set_value('prd_peso') )); ?></td>
			
		</tr>
		<tr>
			<td>
				Foto / Imagen 
			</td>
			<td colspan="5">
				<input type="file" name="prd_foto" size="80" />	
			</td>
		</tr>
		<tr>
			<td>
				Nombre <strong>*</strong>
			</td>
			<td colspan="5">
				<?php echo form_input(array('name' => 'prd_titulo', 'id' => 'prd_titulo', 'maxlength' => '100', 'width' => '20', 'size' => '125', 'class' => 'caja', 'value'=>  set_value('prd_titulo') )); ?>
			</td>
			
		</tr>
		<tr>
			<td>
				Descripción 
			</td>
			<td colspan="7">
				<?php echo form_textarea(array('name' => 'prd_nombre', 'value' => set_value('prd_nombre'), 'cols' => '125', 'rows' => '10', 'class' => 'caja')); ?>
			</td>
		</tr>
		
		<tr>
			<td colspan="8" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('prd_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>