<?php
$attributes = array(
                'width'     =>  '1000',
                'height'    =>  '600',
                'screenx'   =>  '\'+((parseInt(screen.width) - 1000)/2)+\'',
                'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
                'scrollbars' => 'yes',
                'status'     => 'yes',
                'resizable'  => 'yes',
            );
?>
<div id="cuerpo">
	<p class="tituloSeccion">Oferta Comercial Nro. <strong>PHY001</strong></p>
	<br>
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('commercialLine/edit'); ?>
	Exportar documento 
	<?php echo anchor("offer/edit/PHY001/pdf", 
                img(array('src' => 'multimedia/images/copy.png', 'width' => '16','title' => 'Clonar Oferta Comercial', 'border' => '0')), 
            $attributes); 
    ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="8">Información General</th>
		</tr>
		<tr>
			<td width="20%"><strong>Línea Comercial</strong></td>
			<td width="30%">
				<?php echo $lineaComercial; ?>
			</td>
			<td width="20%"><strong>Fecha de Registro</strong></td>
			<td width="30%">
				<?php echo $lineaComercial; ?>
			</td>
		</tr>
		<tr>
			<td><strong>Usuario de Registro</strong></td>
			<td>
				<?php echo $lineaComercial; ?>
			</td>
			<td><strong>Ejecutivo de Venta</strong></td>
			<td>
				<?php echo $lineaComercial; ?>
			</td>
		</tr>
		<tr>
			<td><strong>Cliente</strong></td>
			<td>
				<?php echo $lineaComercial; ?>
			</td>
			<td><strong>Contacto</strong></td>
			<td>
				<?php echo $lineaComercial; ?>
			</td>
			
		</tr>
		<tr>
			<th colspan="8">Detalle / Descripción</th>
		</tr>
		<tr>
			<td colspan="8">
				<table id="dataTable">
					<tr>
						<td><strong>Ítem</strong></td>
						<td><strong>Código / Referencia</strong></td>
						<td><strong>Nombre / Descripción</strong></td>
						<td><strong>Valor Unitario</strong></td>
						<td><strong>Cantidad</strong></td>
						<td><strong>Valor Total</strong></td>
					</tr>
					<tr>
						<td>Ítem</td>
						<td>Código Producto</td>
						<td>Nombre / Descripción</td>
						<td>Valor Unitario</td>
						<td>Cantidad</td>
						<td>Valor Total</td>
					</tr>
					
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="8">Condiciones Comerciales</th>
		</tr>
		<tr>
			<td><strong>Vigencia</strong></td>
			<td>sdfgsdfsdfsdf</td>
			<td><strong>Forma de Pago</strong></td>
			<td>werfwerwerwer</td>
		</tr>
		<tr>
			<td><strong>Plazo de Entrega</strong></td>
			<td>sdfgsdfsdfsdf</td>
			<td><strong>INCOTERM</strong></td>
			<td>werfwerwerwer</td>
		</tr>
		<tr>
			<td><strong>Descuento Aplicado</strong></td>
			<td>sdfgsdfsdfsdf</td>
			<td><strong>Comisión Referenciada</strong></td>
			<td>werfwerwerwer</td>
		</tr>
		<tr>
			<td><strong>Valor antes de IVA</strong></td>
			<td>sdfgsdfsdfsdf</td>
			<td><strong>Valor con IVA</strong></td>
			<td>werfwerwerwer</td>
		</tr>
		<tr>
			<th colspan="8">Observaciones / Notas</th>
		</tr>
	</table>
	<br>
	