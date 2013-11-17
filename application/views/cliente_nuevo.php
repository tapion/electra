<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('customer/newItem'); ?>
	<table id='dataTable' width='100%'>
		<tr>
			<th colspan="8">Crear Nuevo Cliente</th>
		</tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
		<tr>
			<td >
				Número Identificación<strong>*</strong>
			</td>
			<td >
				<?php echo form_dropdown('tid_id', array("1" => "TI", "2" => "CC", "3" => "CE", "4" => "NIT"), "4"); ?> 
				
			</td>
			<td colspan="2" align="left">
				<?php echo form_input(array('name' => 'cli_nui', 'id' => 'cli_nui', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  set_value('cli_nui') )); ?>
			</td>
        </tr>
        <tr>
        	<td>Estado Cliente</td>
			<td>
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
            <td>
				Nombre Comercial <strong>*</strong>
			</td>
			<td>
				<?php echo form_input(array('name' => 'cli_nombrecomercial', 'id' => 'cli_nombrecomercial', 'width' => '20', 'size' => '109', 'class' => 'caja', 'value'=>  set_value('cli_nombrecomercial') )); ?>
			</td>
		</tr>
		<tr>
			<td>
				Razón Social
			</td>
			<td>
				<?php echo form_input(array('name' => 'cli_razonsocial', 'id' => 'cli_razonsocial', 'width' => '20', 'size' => '109', 'class' => 'caja', 'value'=>  set_value('cli_razonsocial') )); ?>
			</td>
            <td>
				Sector Productivo
			</td>
			<td>
				<?php echo form_dropdown('spr_id', $sectorProductivoActivo); ?>
			</td>
		</tr>
		<tr>
			
		</tr>

		<tr>	
			<td>
				Dirección Principal
			</td>
			<td>
				<?php echo form_input(array('name' => 'cli_direccionprincipal', 'id' => 'cli_direccionprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value' =>set_value('cli_direccionprincipal') )); ?>
			</td>
			<td>
				Dirección Correspondencia
			</td>
			<td>
				<?php echo form_input(array('name' => 'cli_direccioncorrespondencia', 'id' => 'cli_direccioncorrespondencia', 'width' => '20', 'size' => '30', 'class' => 'caja',  'value'=>set_value('cli_direccioncorrespondencia') )); ?>
			</td>
		</tr>
		<tr>
			<td>Ciudad</td>
			<td colspan="3">
				<?php echo form_dropdown('ciu_id', $ciudadActivo); ?>
			</td>
		</tr>
		<tr>
			<td>Representante Legal</td>
			<td><?php echo form_input(array('name' => 'cli_representantelegal', 'id' => 'cli_representantelegal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_representantelegal') )); ?></td>
			<td>Página Web</td>
			<td><?php echo form_input(array('name' => 'cli_paginaweb', 'id' => 'cli_paginaweb', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_paginaweb') )); ?></td>
		</tr>
		<tr>
			<td>Teléfono Principal</td>
			<td><?php echo form_input(array('name' => 'cli_telefonoprincipal', 'id' => 'cli_telefonoprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_telefonoprincipal') )); ?></td>
			<td>Teléfono Auxiliar</td>
			<td><?php echo form_input(array('name' => 'cli_telefonoauxiliar', 'id' => 'cli_telefonoauxiliar', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_telefonoauxiliar') )); ?></td>
		</tr>
		<tr>
			<td>Correo Electrónico</td>
			<td><?php echo form_input(array('name' => 'cli_correoprincipal', 'id' => 'cli_correoprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_correoprincipal') )); ?></td>
			<td>Correo Auxiliar</td>
			<td><?php echo form_input(array('name' => 'cli_correoauxiliar', 'id' => 'cli_correoauxiliar', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>set_value('cli_correoauxiliar') )); ?></td>
		</tr>
		<tr>
			<td>Observaciones</td>
			<td colspan="3">
				<?php echo form_textarea(array('name' => 'cli_observaciones', 'value' => set_value('cli_observaciones'), 'cols' => '110', 'rows' => '5', 'class' => 'caja')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="6" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Almacenar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('cli_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>