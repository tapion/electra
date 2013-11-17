<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('priceList/newItem'); ?>
	<table id='dataTable' align="center">
		<tr>
			<th colspan="2">Nueva Lista de Precios</th>
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<td>
				Línea Comercial
			</td>
			<td>
				<?php echo form_dropdown('lcm_id', $lineaComercialActivo); ?>
			</td>
        </tr>
        <tr>
			<td>
				INCOTERM
			</td>
			<td>
				<?php echo form_dropdown('inc_id', $incotermActivo); ?>
			</td>
        </tr>
        <tr>
			<td>Estado</td>
			<td><?php echo form_dropdown('est_id', $estadoActivo); ?></td>
		</tr>
        <tr>
        	<td>Carga al camión</td>
            <td><?php echo form_dropdown('lpr_carcom', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Pago de tasas de exportación</td>
            <td><?php echo form_dropdown('lpr_tasexp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Transporte al puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_pueexp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Descarga en el puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_desexp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Embarque en el puerto de exportación</td>
            <td><?php echo form_dropdown('lpr_embexp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Transporte al puerto de importación</td>
            <td><?php echo form_dropdown('lpr_traimp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Desembarque en el puerto de importación</td>
            <td><?php echo form_dropdown('lpr_desimp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Carga en camiones desde el puerto de importación</td>
            <td><?php echo form_dropdown('lpr_carimp', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Transporte al destino</td>
            <td><?php echo form_dropdown('lpr_trades', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Seguros</td>
            <td><?php echo form_dropdown('lpr_seguro', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Paso de Aduanas</td>
            <td><?php echo form_dropdown('lpr_pasadu', $porcentaje, "0"); ?></td>
        </tr>
        <tr>
        	<td>Impuestos de importación</td>
            <td><?php echo form_dropdown('lpr_impimp', $porcentaje, "0"); ?></td>
        </tr>
		<tr>
        	<td colspan="6">&nbsp;</td>
        </tr>
		
        <tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('lpr_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>