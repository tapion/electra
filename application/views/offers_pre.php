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
			<td width="25%">
				Solicitante: 
			</td>
                        <td width="25%">
				<?php echo form_input(array('name' => 'usuario', 'id' => 'usuario', 'width' => '20', 'size' => '40', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  $this->session->userdata('nombrePilaUsuario') )); ?>
			</td>
			<td width="25%">
                                Contacto / Cliente:
			</td>
                        <td width="25%">
                                <?php echo form_dropdown('ccl_id', $contactoActivo); ?>	
			</td>
                </tr>
                <tr>
                    <td>Ciudad:</td>
                    <td><?php echo form_dropdown('ciu_id', $ciudadActivo, ""); ?></td>
                    <td>Forma de Pago:</td>
                    <td><?php echo form_dropdown('fpg_id', $formaPagoActivo, ""); ?></td>
                </tr>
                <tr>
                    <td>Línea Comercial Mayoritaria:</td>
                    <td><?php echo form_dropdown('lcm_id', $lineaMayoritaria); ?></td>
                    <td>Fecha de Solicitud: </td>
                    <td><?php echo form_input(array('name' => 'fecharegistro', 'id' => 'fecharegistro', 'width' => '20', 'size' => '40', 'class' => 'caja', 'readonly'=> 'true', 'value'=>  date("Y-m-d H:i:s") )); ?></td>
                </tr>
		<tr>
                        <td>Consideraciones y productos a cotizar: <strong>*</strong></td>
			<td colspan="3">
				<?php echo form_textarea(array('name' => 'ofc_preregistro', 'value' => set_value('ofc_preregistro'), 'cols' => '100', 'rows' => '5', 'class' => 'caja')); ?>
			</td>
		</tr>
		<tr>
                    <td>Vigencia:</td>
                    <td colspan="3">
                        <?php echo form_dropdown('ofc_vigencia', $cmbVigenciaNum); ?>
                        <?php echo form_dropdown('ofc_vigenciatexto', $cmbVigenciaTxt); ?>
                    </td>
                </tr>
                <tr>
                    <td>Plazo de Entrega:</td>
                    <td colspan="3">
                            <?php echo form_dropdown('ofc_plazoentrega', $cmbVigenciaNum); ?>
                            <?php echo form_dropdown('ofc_plazoentregatexto', $cmbVigenciaTxt); ?>
                    </td>
                </tr>
                <tr>
			<td colspan="4" align='right'>

				<?php echo form_hidden('sess_id', $this->session->userdata('session_id')); ?>
				<?php echo form_submit(array('name'=> 'crearOferta', 'value'=>'Crear Preoferta', 'class' => 'btn btn-primary')); ?>
			</td>
		</tr>

	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>