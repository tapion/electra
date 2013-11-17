<div id="cuerpo">
<?php echo anchor("seller/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Ejecutivos Comerciales / Ejecutivos de Ventas</th>
    </tr>
    
		<tr>
			<th width='4%'>Opc.</th>
			<th width='10%'>Estado</th>
			<th width='13%'>Nombre de Usuario</th>
			<th width='23%'>Nombres y Apellidos</th>
			<th width='20%'>Sede de Usuario</th>
			<th width='20%'>Línea Comercial</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>