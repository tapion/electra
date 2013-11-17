<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('priceList/edit'); ?>
	<table id='dataTable' align="center">
		<tr>
			<th colspan="2">Editar Lista de Precios</th>
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<td>
				Línea Comercial
			</td>
			<td>
				<?php echo form_dropdown('lcm_id', $lineaComercialActivo, $lineaComercialPredef, 'readonly = true'); ?>
			</td>
        </tr>
        <tr>
			<td>
				INCOTERM
			</td>
			<td>
				<?php echo form_dropdown('inc_id', $incotermActivo, $incotermPredef, 'readonly = true'); ?>
			</td>
        </tr>
        <tr>
			<td>Estado</td>
			<td><?php echo form_dropdown('est_id', $estadoActivo); ?></td>
		</tr>
        <tr>
        	<td>Carga al camión</td>
            <td><?php echo form_dropdown('lpr_carcom', $porcentaje, $lpr_carcom); ?></td>
        </tr>
        <tr>
        	<td>Pago de tasas de exportación</td>
            <td><?php echo form_dropdown('lpr_tasexp', $porcentaje, $lpr_tasexp); ?></td>
        </tr>
        <tr>
        	<td>Transporte al puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_pueexp', $porcentaje, $lpr_pueexp); ?></td>
        </tr>
        <tr>
        	<td>Descarga en el puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_desexp', $porcentaje, $lpr_desexp); ?></td>
        </tr>
        <tr>
        	<td>Embarque en el puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_embexp', $porcentaje, $lpr_embexp); ?></td>
        </tr>
        <tr>
        	<td>Transporte al puerto de importación</td>
            <td><?php echo form_dropdown('lpr_traimp', $porcentaje, $lpr_traimp); ?></td>
        </tr>
        <tr>
        	<td>Desembarque en el puerto de importación</td>
            <td><?php echo form_dropdown('lpr_desimp', $porcentaje, $lpr_desimp); ?></td>
        </tr>
        <tr>
        	<td>Carga en camiones desde el puerto de importación</td>
            <td><?php echo form_dropdown('lpr_carimp', $porcentaje, $lpr_carimp); ?></td>
        </tr>
        <tr>
        	<td>Transporte al destino</td>
            <td><?php echo form_dropdown('lpr_trades', $porcentaje, $lpr_trades); ?></td>
        </tr>
        <tr>
        	<td>Seguros</td>
            <td><?php echo form_dropdown('lpr_seguro', $porcentaje, $lpr_seguro); ?></td>
        </tr>
        <tr>
        	<td>Paso de Aduanas</td>
            <td><?php echo form_dropdown('lpr_pasadu', $porcentaje, $lpr_pasadu); ?></td>
        </tr>
        <tr>
        	<td>Impuestos de importación</td>
            <td><?php echo form_dropdown('lpr_impimp', $porcentaje, $lpr_impimp); ?></td>
        </tr>
		<tr>
        	<td colspan="6">&nbsp;</td>
        </tr>
		
        <tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('lpr_id', $lpr_id); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>