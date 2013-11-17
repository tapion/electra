<div id="cuerpo">
<?php echo anchor("headquarters/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Sedes Corporativas</th>
    </tr>
    <tr>
			<th width='4%'>Opc.</th>
			<th width='28%'>Ciudad</th>
			<th width='28%'>Nombre</th>
			<th width='18%'>Direccion</th>
			<th width='13%'>Teléfono(s)</th>
			<th width='9%'>Estado</th>										
		</tr>

	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>