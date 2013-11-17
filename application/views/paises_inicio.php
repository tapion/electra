<div id="cuerpo">
<?php echo anchor("countries/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Países</th>
    </tr>
		<tr>
			<th width='4%'>Opc.</th>
			<th width='14%'>Abrev. Ppal.</th>
			<th width='14%'>Abrev. Aux.</th>
			<th width='18%'>Estado</th>
			<th width='60%'>Nombre / Descripción / Detalle</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>