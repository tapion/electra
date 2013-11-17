<div id="cuerpo">
<?php echo anchor("typeID/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Tipos de Identificación</th>
    </tr>		
    <tr>
			<th width='4%'>Opc.</th>
			<th width='10%'>Símbolo</th>
			<th width='10%'>Estado</th>
			<th width='76%'>Nombre / Detalle / Descripción</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>
