<div id="cuerpo">
<?php echo anchor("customer/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="6">Clientes / Contactos</th>
    </tr>
    <tr>
			<td width='4%'><strong>Opc.</strong></td>
			<td width='10%'><strong>Estado</strong></td>
			<td width='13%'><strong>Num. Identificación</strong></td>
			<td width='23%'><strong>Nombre Comercial</strong></td>
			<td width='20%'><strong>Ciudad Principal</strong></td>
			<td width='20%'><strong>Dirección Principal</strong></td>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>
</div>