<div id="cuerpo">
<?php echo anchor("user/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="7">Usuarios</th>
    </tr>
    
		<tr>
			<th width='4%'>Opc.</th>
			<th width='10%'>Estado</th>
			<th width='10%'>Login</th>
			<th width='18%'>Nombre(s)</th>
			<th width='18%'>Apellidos</th>
			<th width='20%'>Cargo</th>
			<th width='20%'>Sede</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>