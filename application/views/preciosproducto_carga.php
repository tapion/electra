<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open_multipart('priceList/current/imports'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Cargar / Actualizar Precios Vigentes</th>
		</tr>
		<tr>
			<td width="33%" align="center">
				Archivo de Datos:
			</td>
			<td width="33%" align="center">
				<input type="file" name="userfile" size="40" />
			</td>
			<td width="34%" align="center">
				<?php echo form_submit(array('name'=> 'enviar', 'value'=>'Cargar / Actualizar Precios', 'class' => 'boton')); ?>
			</td>
			<?php echo $resultadoImportacion; ?>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>