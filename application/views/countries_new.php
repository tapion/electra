<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('countries/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar País</th>
		</tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
		<tr>
			<td width="25%">
				Nombre del País <strong>*</strong>
			</td>
			<td width='25%'>
				<?php echo form_input(array('name' => 'pai_nombre', 'id' => 'pai_nombre', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  set_value('pai_nombre') )); ?>
			</td>
			<td width="25%">
				Estado
			</td>
			<td width="25%">
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
		</tr>
		<tr>	
			<td>
				Abreviatura Principal
			</td>
			<td>
				<?php echo form_input(array('name' => 'pai_abreviatura', 'id' => 'pai_abreviatura', 'width' => '20', 'size' => '5', 'class' => 'caja', 'style' => 'text-transform:uppercase;', 'maxlength' => '3', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value' =>set_value('pai_abreviatura') )); ?>
			</td>
			<td>
				Abreviatura Auxiliar
			</td>
			<td>
				<?php echo form_input(array('name' => 'pai_abreviatura2', 'id' => 'pai_abreviatura2', 'width' => '20', 'size' => '5', 'maxlength' => '3', 'class' => 'caja', 'value'=>set_value('pai_abreviatura2') )); ?>
			</td>
			
		</tr>
        <tr>
        	<td colspan="6">&nbsp;</td>
        </tr>
		<tr>
			<td colspan="6" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Almacenar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('pai_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>