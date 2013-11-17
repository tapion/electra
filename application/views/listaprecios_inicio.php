<div id="cuerpo">
<?php echo anchor("priceList/newItem/", img(array('src' => 'multimedia/images/newItem.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo', 'border' => '0')), array('title' => 'Agregar Nuevo')); ?>
<div id="demo">
<table cellpadding="0" cellspacing="0" border="0" class="bordeGris" id="mainTable" width="100%">
	
    <thead>
    <tr>
    	<th colspan="17">Listas de Precios</th>
    </tr>
    <tr>
			<th width='4%'>Opc.</th>
			<th width='10%'>Estado</th>
			<th width='10%'>Incoterm</th>
			<th width='25%'>Línea Comercial</th>
                        <th width="3%">CAC</th>
                        <th width="3%">PTE</th>
                        <th width="3%">TPE</th>
                        <th width="3%">DPE</th>
                        <th width="3%">EPE</th>
                        <th width="3%">TPI</th>
                        <th width="3%">DPI</th>
                        <th width="3%">CPI</th>
                        <th width="3%">TAD</th>
                        <th width="3%">SEG</th>
                        <th width="3%">PDA</th>
                        <th width="3%">IIM</th>
                        <th width="15%">Total Importes</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $tableData; ?>
	</tbody>
	</table>
	</div>


	<br><br>
</div>