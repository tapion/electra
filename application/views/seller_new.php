<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('seller/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Agregar Ejecutivo de Venta</th>
		</tr>
		<tr>
			<td width="20%">
				Usuario del Sistema
			</td>
			<td width="75%" colspan="3">
				<?php echo form_dropdown('usr_id', $usuarioActivo); ?>
			</td>
		</tr>
		<tr>
			<td width="15%">
				Estado
			</td>
			<td width="15%">
				<?php echo form_dropdown('est_id', $estadoActivo); ?>
			</td>
			<td width="18%">
				Línea Comercial
			</td>
			<td width="18%">
				<?php echo form_dropdown('lcm_id', $lineaComercialActivo); ?>
			</td>
		</tr>
		<tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('evt_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>