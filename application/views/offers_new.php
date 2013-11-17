<script language="text/javascript">
	$(document).on('ready',function (){
		cargarContactos();
		$('#cli_id').change(cargarContactos);
	});
	
	function cargarContactos(){
		var codCliente = $('#cli_id').val();
		$.getJSON('offer/loadContact', {id: codCliente}, function (resp) {
			$.('#ccl_id').empty();
			$.each(resp, function(indice, valor){
				option = $('<option></option>', {
					value: indice,
					text: valor
				});
				$('#ccl_id').append(option);
			});
		});
	}
	
</script>


<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('offer/newItem'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="6">
				Nueva Oferta Comercial
			</th>
		</tr>
		<tr>
			<td width="15%">
				Ejecutivo de Cuenta: 
			</td>
			<td colspan="3">
				<?php echo form_dropdown('evt_id', $ejecutivoActivo, $evap); ?>
			</td>
		<tr>
			<td>
				INCOTERM
			</td>
			<td colspan="3">
				<?php echo form_dropdown('inc_id', $incotermActivo, $incp); ?>
			</td>
		</tr>
		<!--
		<tr>
			<td>
				Cliente:
			</td>
			<td colspan="3">
				<?php echo form_dropdown('cli_id', $clienteActivo, 1, "id='cli_id'"); ?>
			</td>
		</tr>
		<tr>
			<td>Contacto Comercial:</td>
			<td colspan="3">
				<?php echo form_dropdown('ccl_id', array(), null, "id='ccl_id'"); ?>
			</td>
		</tr>
		-->
		<tr>
			<td>
				Cliente / Contacto:
			</td>
			<td colspan="3">
				<?php echo form_dropdown('ccl_id', $contactoActivo, $cclp); ?>
			</td>
		</tr>
		<tr>
			<td>Ciudad Cliente:</td>
			<td colspan="3"><?php echo form_dropdown('ciu_id', $ciudadActivo, $ciup); ?></td>
		</tr>
		<tr>
			<td>Vigencia de la Oferta:</td>
			<td>
				<?php echo form_dropdown('ofc_vigencia', $cmbVigenciaNum, $ovnp); ?>
				<?php echo form_dropdown('ofc_vigenciatexto', $cmbVigenciaTxt, $ovtp); ?>
			</td>
			<td>Plazo de Entrega:</td>
			<td>
				<?php echo form_dropdown('ofc_plazoentrega', $cmbVigenciaNum, $opnp); ?>
				<?php echo form_dropdown('ofc_plazoentregatexto', $cmbVigenciaTxt, $optp); ?>
			</td>
		</tr>
		<tr>
			<td>Forma de Pago:</td>
			<td><?php echo form_dropdown('fpg_id', $formaPagoActivo, $fpgp); ?></td>
			<td>Lista de Precios:</td>
			<td><?php echo form_dropdown('lpr_id', $cmbListaPrecios, $lprp); ?></td>
		</tr>
		<tr></tr>
			<td>Elaborado por:</td>
			<td colspan="3">
				<?php echo form_input(array('name' => 'usuario', 'id' => 'usuario', 'width' => '20', 'size' => '40', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  $this->session->userdata('nombrePilaUsuario') )); ?>
			</td>
		</tr>
		<tr>
			<td colspan="4">
				<table id='dataTable'>
					<tr>
						<td align="center">Código <?php echo form_input(array('name' => 'ofp_codigonuevo', 'id' => 'ofp_codigonuevo', 'size' => '15', 'class' => 'caja', 'value'=>  "" )); ?> Cantidad <?php echo form_input(array('name' => 'ofp_nuevoCantidad', 'id' => 'ofp_nuevoCantidad', 'size' => '4', 'class' => 'caja', 'value'=>  "", "onblur" => "compruebaValidoEntero()" )); ?> <?php echo form_submit(array('name'=> 'addProd', 'value'=>'+', 'class' => 'boton')); ?></td>
					</tr>
				</table>
				<table id='dataTable' class='bordeGris'>
					<tr>
						<th width='10%'>Serie</th>
						<th width='15%'>Código</th>
						<th width="30%">Nombre / Descripción Producto</th>
						<th width="20%">Valor Unitario</th>
						<th width="5%">Cantidad</th>
						<th width="20%">Valor Total</th>
						<th width="3%">Opciones</th>
					</tr>
					<?php echo $productosRegistrados; ?>
				</table>
				<br>
					<table id='dataTable' class='bordeGris'>
					<tr>
						<th align="center" width='20%'>Subtotal</th>
						<th align="center" width='20%'>IVA (16%)</th>
						<th align="center" width='20%'>% Comision</th>
						<th align="center" width='20%'>% Descuento</th>
						<th align="center" width='20%'>Valor Total</th>
					</tr>
					<tr>
						<td align="center"><?php echo form_input(array('name' => 'ofc_valor', 'id' => 'ofc_valor', 'width' => '20', 'size' => '25', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  $this->basics->convertirMoneda($ofc_valor) )); ?></td>
						<td align="center"><?php echo form_input(array('name' => 'ofc_iva', 'id' => 'ofc_iva', 'width' => '20', 'size' => '25', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  $this->basics->convertirMoneda($ofc_iva) )); ?></td>
						<td align="center"><?php echo form_input(array('name' => 'ofc_comision', 'id' => 'ofc_comision', 'width' => '20', 'size' => '8', 'class' => 'caja', 'value'=>  $ofc_comision)); ?></td>
						<td align="center"><?php echo form_input(array('name' => 'ofc_descuento', 'id' => 'ofc_descuento', 'width' => '20', 'size' => '8', 'class' => 'caja', 'value'=>  $ofc_descuento )); ?></td>
						<td align="center"><?php echo form_input(array('name' => 'ofc_total', 'id' => 'ofc_total', 'width' => '20', 'size' => '25', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  $this->basics->convertirMoneda($ofc_total) )); ?></td>
					</tr>
				</table>
				<br>
			</td>
		</tr>
		<tr>
			<td colspan="4"><?php echo $observacionesPredef; ?></td>
		</tr>
		<tr>
			<td>Adicionales:</td>
			<td colspan="3">
				<?php echo form_textarea(array('name' => 'lcm_campos', 'value' => set_value('lcm_campos'), 'cols' => '100', 'rows' => '5', 'class' => 'caja')); ?>
			</td>
		</tr>
		<tr>
			<td colspan="6" align='center'>
				<?php echo form_hidden('cntProd', $cntProd); ?>
				<?php echo form_hidden('sess_id', $this->session->userdata('session_id')); ?>
				<?php echo form_submit(array('name'=> 'crearOferta', 'value'=>'Crear Oferta', 'class' => 'boton')); ?>
			</td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>