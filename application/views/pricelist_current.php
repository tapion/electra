<div id="cuerpo">
	<p class="tituloSeccion">Administrador de Precios Vigentes</p>
	<br>
	<?php echo $infoVista; ?>
	<br>
	<tr>
		<td colspan="6">
			<?php //echo anchor("priceList/current/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
			<?php echo anchor("priceList/current/imports/", img(array('src' => 'multimedia/images/import.png', 'width' => '20', 'height' => '20','title' => 'Cargar Nuevos Precios...', 'border' => '0')), array('title' => 'Cargar Nuevos Precios...')); ?>
		</td>
	</tr>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	<thead>
		<tr>
			<th width='4%'>No.</th>
			<th width='16%'>Línea Comercial</th>
			<th width='20%'>Lista de Precios</th>
			<th width='15%'>Código Producto</th>
			<th width='30%'>Nombre Producto</th>
			<th width='16%'>Valor / Costo</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>