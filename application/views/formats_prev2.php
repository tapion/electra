<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('formats/newItem'); ?>
	<table id='dataTable' class="bordeGris" width="100%">
		<tr>
			<th colspan="8">Formato de Soporte / Mantenimiento</th>
		</tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="5"><strong>Nuevo Formato >> Información de la Visita (Paso 2 de 4)</strong></td>
        </tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        <td rowspan="5" class="bordeGris" width="20%">
            <strong>Código de Negocio</strong>
            <br />
            <?php echo $this->input->post('evs_codigonegocio'); ?>
            <br />
            <strong>Usuario de Registro</strong>
            <br />
			<?php echo $this->session->userdata('nombrePilaUsuario'); ?>
            <br />
            <strong>Tipo de Formato</strong>
            <br />
            <?php echo $this->home_model->obtenerCampo("formatoevidencia", "fev_codigo", "fev_id", 
														$this->input->post('fev_id')); ?> - 
            <?php echo $this->home_model->obtenerCampo("formatoevidencia", "fev_nombre", "fev_id", 
														$this->input->post('fev_id')); ?>
            <br />
            <strong>Notas / Comentarios</strong>
            <br />
            <?php echo $this->input->post('evs_notaformato'); ?>         
        </td>
           	<td>Fecha Soporte</td>
            <td>
            <input type="text" name='evs_fechasoporte' id='evs_fechasoporte' value="<?php echo $evs_fechasoporte; ?>" readonly='1' size='12'>
				<img src=<?php echo base_url()."js/jscalendar-1.0/img.gif"; ?> id="f_trigger_c">
				<script type="text/javascript">
					Calendar.setup({
						inputField		:"evs_fechasoporte",
						ifFormat		:"%Y-%m-%d",
						button			:"f_trigger_c",
						align			:"T1",
						singleClick		:true
					});
				</script>
            </td>
            <td>Cliente</td>
            <td><?php echo form_dropdown('cli_id', $clienteActivo); ?></td>

        </tr>	
        <tr>
        	<td>Ciudad</td>
            <td><?php echo form_dropdown('ciu_id', $ciudadActivo); ?></td>
            <td>Lugar / Sitio</td>
            <td><?php echo form_input(array('name' => 'evs_sitio', 'id' => 'evs_sitio', 'value'=>  set_value('evs_sitio') ));
			?></td>
        </tr>
        <tr>
        	<td>Supervisor</td>
            <td><?php echo form_input(array('name' => 'evs_contacto', 'id' => 'evs_contacto', 
			'value'=>  set_value('evs_contacto') )); ?></td>
            <td>Teléfono Contacto</td>
            <td><?php echo form_input(array('name' => 'evs_telefono', 'id' => 'evs_telefono', 
			'value'=>  set_value('evs_telefono') )); ?></td>
        </tr>
        <tr>
        	<td>Hora Inicio</td>
            <td><?php echo form_dropdown('evs_horainicio', $cmbHoras); ?></td>
            <td>Hora Finalización</td>
            <td><?php echo form_dropdown('evs_horafin', $cmbHoras); ?></td>
        </tr>
        <tr>
        	<td>Descripción / Detalles</td>
            <td colspan="3">
            <?php echo form_textarea(array('name' => 'evs_descripcion', 'value' => set_value('evs_descripcion'), 
			'cols' => '125', 'rows' => '5', 'class' => 'caja')); ?>
            </td>
        </tr>
        
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="8" align="right">
            <?php echo form_submit(array('name'=> 'enviar', 'value'=>'Descartar')); ?>
			<?php echo form_submit(array('name'=> 'enviar', 'value'=>'Siguiente', 'class' => 'btn btn-primary')); ?>
            </td>
        </tr>
        
	</table>
	<?php 
		echo form_hidden('evs_codigonegocio', $this->input->post('evs_codigonegocio'));
		echo form_hidden('fev_id', $this->input->post('fev_id'));
		echo form_hidden('evs_notaformato', $this->input->post('evs_notaformato')); 
	?>
	<?php echo form_close(); ?>
</div>