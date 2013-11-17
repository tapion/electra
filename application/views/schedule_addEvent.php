<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('schedule/newEvent'); ?>
	<table id='dataTable' class="bordeGris">
		<tr>
			<th colspan="4">Programar Nuevo Evento</th>
		</tr>
		<tr>
			<td width="20%">
				Fecha de Inicio
			</td>
			<td width="30%">
				<input type="text" name='evc_fechainicio' id='evc_fechainicio' value="<?php echo $evc_fechainicio; ?>" readonly='1' size='12' class='caja'>
				<img src=<?php echo base_url()."js/jscalendar-1.0/img.gif"; ?> id="f_trigger_c">
				<script type="text/javascript">
					Calendar.setup({
						inputField		:"evc_fechainicio",
						ifFormat		:"%Y-%m-%d",
						button			:"f_trigger_c",
						align			:"T1",
						singleClick		:true
					});
				</script>
			</td>
			<td width="20%">
				Hora de Inicio
			</td>
			<td width="30%">
				<?php echo form_dropdown('evc_horainicio', $cmbHoras); ?>
			</td>
		</tr>
		<tr>
			<td>
				Fecha de Finalización
			</td>
			<td>
				<input type="text" name='evc_fechafin' id='evc_fechafin' value="<?php echo $evc_fechafin; ?>" readonly='1' size='12' class='caja'>
				<img src=<?php echo base_url()."js/jscalendar-1.0/img.gif"; ?> id="f_trigger_c">
				<script type="text/javascript">
					Calendar.setup({
						inputField		:"evc_fechafin",
						ifFormat		:"%Y-%m-%d",
						button			:"f_trigger_c",
						align			:"T1",
						singleClick		:true
					});
				</script>
			</td>
			<td>
				Hora de Finalización
			</td>
			<td>
				<?php echo form_dropdown('evc_horafin', $cmbHoras); ?>
			</td>
		</tr>
		<tr>
			<td>Cliente</td>
			<td colspan="3"><?php echo form_dropdown('ccl_id', $contactoActivo, $cclp); ?></td>
		</tr>
		<!--
		<tr>
			<td>Ejecutivo Responsable</td>
			<td colspan="3"><?php echo form_dropdown('usr_idresponsable', $ejecutivoActivo); ?></td>
		</tr>
		-->
		<tr>
			<td>Ciudad</td>
			<td colspan="3"><?php echo form_dropdown('ciu_id', $ciudadActivo); ?></td>
		</tr>
		<tr>	
			<td width="25%">
				Titulo del Evento <strong>*</strong>
			</td>
			<td colspan="3">
				<?php echo form_input(array('name' => 'evc_tituloevento', 'id' => 'evc_tituloevento', 'width' => '20', 'size' => '120', 'class' => 'caja', 'value'=>  set_value('evc_tituloevento') )); ?>
			</td>
		</tr>
		<tr>
			<td>Descripción / Detalles</td>
			<td colspan="3"><?php echo form_textarea(array('name' => 'evc_descripcionevento', 'value' => set_value('evc_descripcionevento'), 'cols' => '120', 'rows' => '10', 'class' => 'caja')); ?>	</td>
		</tr>
		<tr>
			<td colspan="6" align='center'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Agregar Registro', 'class' => 'boton')); ?></td>
		</tr>
	</table>
	<?php echo form_hidden('evc_id', ""); ?>
	<?php echo form_close(); ?>
	<br>
	
</div>