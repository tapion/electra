<div id="cuerpo">
<?php echo anchor("products/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?> 
		<?php echo anchor("products/import/", img(array('src' => 'multimedia/images/import.png', 'width' => '20', 'height' => '20','title' => 'Cargar Nuevos Productos...', 'border' => '0')), array('title' => 'Cargar Nuevos Productos...')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="5">Productos</th>
    </tr>
    
		<tr>
			<th width='4%'>Opc.</th>
			<th width='14%'>Abreviatura</th>
			<th width='18%'>Estado</th>
			<th width='40%'>Nombre / Descripción / Detalle</th>
      <th width='20%'>Precio Base</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>