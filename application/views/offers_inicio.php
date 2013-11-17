<div id="cuerpo">
	<p class="tituloSeccion">Administrador de Ofertas Comerciales</p>
	<br>
	<?php echo $infoVista; ?>
	<br>
<tr><td colspan="6"><?php echo anchor("offer/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?></td></tr>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	<thead>
		<tr>
			<th width='7%'>Opciones</th>
      <th width='20%'>Estado</th>
			<th width='15%'>Última Actualización</th>
			<th width='10%'>Nro. Oferta</th>
			<th width='23%'>Ejecutivo de Venta</th>
			<th width='25%'>Línea Comercial</th>		
    </tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>