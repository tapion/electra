<div id="cuerpo">
<?php echo anchor("formats/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Formatos de Soporte / Mantenimiento</th>
    </tr>
		<tr>
			<th width='4%'>Opc.</th>
			<th width='10%'>Nro. Soporte</th>
			<th width='10%'>Fecha Soporte</th>
			<th width='20%'>Cliente / Compañía</th>
			<th width='31%'>Tipo de Formato</th>
			<th width='25%'>Responsable Electroequipos</th>
			
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>