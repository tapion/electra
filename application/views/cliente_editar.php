<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('customer/edit'); ?>
	<table width=100% id='dataTable'>
		<tr>
			<td width="45%" valign="top">
							
				<table id='dataTable' class="bordeGris">
				<tr>
					<th colspan="8">Actualizar Cliente</th>
				</tr>
                <tr>
                <td colspan="8">&nbsp;</td>
                </tr>
				<tr>
					<td width="30%">
						Número Identificación<strong>*</strong>
					</td>
					<td width='70%'>
						<?php echo form_dropdown('tid_id', array("1" => "TI", "2" => "CC", "3" => "CE", "4" => "NIT"), $tid_id); ?> 
						<?php echo form_input(array('name' => 'cli_nui', 'id' => 'cli_nui', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  $cli_nui )); ?>
					</td>
				</tr>
				<tr>
					<td>
						Estado Cliente
					</td>
					<td>
						<?php echo form_dropdown('est_id', $estadoActivo, $estadoActivoPredef); ?>
					</td>
				</tr>
				<tr>
					<td>
						Nombre Comercial <strong>*</strong>
					</td>
					<td>
						<?php echo form_input(array('name' => 'cli_nombrecomercial', 'id' => 'cli_nombrecomercial', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $cli_nombrecomercial )); ?>
					</td>
				</tr>
				<tr>
					<td>
						Razón Social
					</td>
					<td>
						<?php echo form_input(array('name' => 'cli_razonsocial', 'id' => 'cli_razonsocial', 'width' => '20', 'size' => '50', 'class' => 'caja', 'value'=>  $cli_razonsocial )); ?>
					</td>
				</tr>
				<tr>
					<td>
						Sector Productivo
					</td>
					<td>
						<?php echo form_dropdown('spr_id', $sectorProductivoActivo, $sectorProductivoActivoPredef); ?>
					</td>
				</tr>
		
				<tr>	
					<td>
						Dirección Principal
					</td>
					<td>
						<?php echo form_input(array('name' => 'cli_direccionprincipal', 'id' => 'cli_direccionprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value' => $cli_direccionprincipal )); ?>
					</td>
				</tr>
				<tr>
					<td>
						Dirección Correspondencia
					</td>
					<td>
						<?php echo form_input(array('name' => 'cli_direccioncorrespondencia', 'id' => 'cli_direccioncorrespondencia', 'width' => '20', 'size' => '30', 'class' => 'caja',  'value'=> $cli_direccioncorrespondencia )); ?>
					</td>
				</tr>
				<tr>
					<td>Ciudad</td>
					<td>
						<?php echo form_dropdown('ciu_id', $ciudadActivo, $ciudadActivoPredef); ?>
					</td>
				</tr>
				<tr>
					<td>Representante Legal</td>
					<td><?php echo form_input(array('name' => 'cli_representantelegal', 'id' => 'cli_representantelegal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_representantelegal )); ?></td>
				</tr>
				<tr>
					<td>Página Web</td>
					<td><?php echo form_input(array('name' => 'cli_paginaweb', 'id' => 'cli_paginaweb', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_paginaweb )); ?></td>
				</tr>
				<tr>
					<td>Teléfono Principal</td>
					<td><?php echo form_input(array('name' => 'cli_telefonoprincipal', 'id' => 'cli_telefonoprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_telefonoprincipal )); ?></td>
				</tr>
				<tr>
					<td>Teléfono Auxiliar</td>
					<td><?php echo form_input(array('name' => 'cli_telefonoauxiliar', 'id' => 'cli_telefonoauxiliar', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_telefonoauxiliar )); ?></td>
				</tr>
				<tr>
					<td>Correo Electrónico</td>
					<td><?php echo form_input(array('name' => 'cli_correoprincipal', 'id' => 'cli_correoprincipal', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_correoprincipal )); ?></td>
				</tr>
				<tr>
					<td>Correo Auxiliar</td>
					<td><?php echo form_input(array('name' => 'cli_correoauxiliar', 'id' => 'cli_correoauxiliar', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=> $cli_correoauxiliar)); ?></td>
				</tr>
				<tr>
					<td>Observaciones</td>
					<td colspan="3">
						<?php echo form_textarea(array('name' => 'cli_observaciones', 'value' => $cli_observaciones, 'cols' => '50', 'rows' => '5', 'class' => 'caja')); ?>
					</td>
				</tr>
				<tr>
					<td colspan="6" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Actualizar Registro', 'class' => 'btn btn-primary')); ?></td>
				</tr>
			</table>
			<?php echo form_hidden('cli_id', $cli_id); ?>
			

			</td>
			<td width="40%" valign="top">
				<table id="dataTable" width="100%" class='bordeGris'>
					<tr>
						<th colspan="4">Contactos Asociados</th>
					</tr>
                    <tr>
                    	<td colspan="4">&nbsp;</td>
                    </tr>
					<tr>
						<td>
							<?php echo $contactosAsociados; ?>
							<table id="dataTable" class="bordeGris">
								<tr>
									<td width="3%">
										<?php echo img(array('src' => 'multimedia/images/usuario.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?>
									</td>
									<td width="97%">
										<?php echo form_input(array('name' => 'ccl_nombre', 'id' => 'ccl_nombre', 'width' => '20', 'size' => '45', 'class' => 'caja', 'value'=> $ccl_nombre )); ?>
									</td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/rol.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_input(array('name' => 'ccl_cargo', 'id' => 'ccl_nombre', 'width' => '20', 'size' => '45', 'class' => 'caja', 'value'=> $ccl_cargo )); ?></td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/phone.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_input(array('name' => 'ccl_telefono', 'id' => 'ccl_telefono', 'width' => '20', 'size' => '45', 'class' => 'caja', 'value'=> $ccl_telefono )); ?></td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/mail.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_input(array('name' => 'ccl_correo', 'id' => 'ccl_correo', 'width' => '20', 'size' => '45', 'class' => 'caja', 'value'=> $ccl_correo)); ?></td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/lineacomercial.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_dropdown('lcm_idC', $lineaComercialActivo, $lcm_idPredef); ?></td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/ciudad.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_dropdown('ciu_idC', $ciudadActivo, $ciudadActivoPredef); ?></td>			
								</tr>
								<tr>
									<td><?php echo img(array('src' => 'multimedia/images/estado.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
									<td><?php echo form_dropdown('est_idC', $estadoActivo, $estadoActivoPredef); ?></td>			
								</tr>
								<tr>
									<td colspan="2" align="center">
										<?php echo form_hidden('ccl_id', $ccl_id); ?>
										<?php echo form_submit(array('name'=> $action, 'value'=>$labelBTN, 'class' => 'btn btn-primary')); ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>	
				</table>
				<?php echo form_close(); ?>
			</td>
			
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<td colspan="2">
				<table id="dataTable" width="100%" >
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/usuario.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="15%"><i>Nombres Apellidos</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/rol.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="15%"><i>Cargo Desempeñado</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/phone.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="8%"><i>Teléfono</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/mail.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="7%"><i>Correo</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/lineacomercial.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="11%"><i>Linea Comercial</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/ciudad.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="7%"><i>Ciudad</i></td>
					<td width="3%"><?php echo img(array('src' => 'multimedia/images/estado.png', 'width' => '20', 'height' => '20','title' => 'Agregar Nuevo Contacto', 'border' => '0')); ?></td>
					<td width="10%"><i>Estado</i></td>
					
					
				</table>
			</td>
		</tr>
	</table>
	
	<br>
	
</div>