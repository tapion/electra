<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('schedule/newEvent'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="4">Detalles del Evento <?php echo $tituloEvento; ?></th>
		</tr>
		<tr>
			<td width="50%" valign="top">
				<table id='dataTable'>
					<tr>
						<td><strong>Fecha Inicio</strong></td>
						<td>sdfsdfsdfsdfdsf</td>
						<td><strong>Hora Inicio</strong></td>
						<td>23e2e332e23e23e</td>
					</tr>
					<tr>
						<td><strong>Fecha Fin</strong></td>
						<td>sdfsdfsdfsdfdsf</td>
						<td><strong>Hora Fin</strong></td>
						<td>23e2e332e23e23e</td>
					</tr>
					<tr>
						<td><strong>Cliente</strong></td>
						<td colspan="3">sdsdfsdfsdfdsfsdfsdf</td>
					</tr>
					<tr>
						<td><strong>Contacto</strong></td>
						<td colspan="3">sdsdfsdfsdfdsfsdfsdf</td>
					</tr>
					<tr>
						<td><strong>Ciudad</strong></td>
						<td colspan="3">sdsdfsdfsdfdsfsdfsdf</td>
					</tr>
					<tr>
						<td><strong>Detalles</strong></td>
						<td colspan="3">sdsdfsdfsdfdsfsdfsdf</td>
					</tr>
					<tr>
						<td><strong>Responsable</strong></td>
						<td colspan="3">sdsdfsdfsdfdsfsdfsdf</td>
					</tr>
				</table>
			</td>
			<td width='50%' valign="top">
				<table id='dataTable' class="bordeGris">
					<tr><th colspan='3'>Trazabilidad / Seguimiento</th></tr>
					<tr>
						<th width='40%'>F. Movimiento</th>
						<th width='40%'>Usuario Registro</th>
						<th width='20%'>Estado</th>
					</tr>
				</table>		
			</td>
		</tr>
		
	</table>
	<?php echo form_hidden('evc_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>