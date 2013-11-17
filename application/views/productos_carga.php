<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open_multipart('products/import'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Cargar Productos Masivos</th>
		</tr>
		<tr>
			<td width="33%" align="center">
				Archivo de Datos:
			</td>
			<td width="33%" align="center">
				<input type="file" name="userfile" size="40" />
			</td>
			<td width="34%" align="center">
				<?php echo form_submit(array('name'=> 'enviar', 'value'=>'Cargar Productos', 'class' => 'boton')); ?>
			</td>
			<?php echo $resultadoImportacion; ?>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>