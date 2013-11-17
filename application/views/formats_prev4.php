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
        	<td colspan="4"><strong>Nuevo Formato >> Observaciones y Registro Fotográfico (Paso 4 de 4)</strong></td>
        </tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        	<td rowspan="4" class="bordeGris" width="35%">
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
            <br />
            <strong>Fecha de Soporte</strong>
            <br />
            <?php echo $this->input->post('evs_fechasoporte'); ?>
            <br />
            <strong>Cliente</strong>
            <br />
            <?php echo $this->home_model->obtenerCampo("cliente", "cli_nombrecomercial", "cli_id", $this->input->post('cli_id')); ?>
            <br />
            <strong>Ciudad</strong>
            <br />
            <?php 
				echo $this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id",$this->input->post('ciu_id')); 
				echo ", ";
				echo $this->home_model->obtenerCampo("departamento", "dep_nombre", "dep_id", $this->home_model->obtenerCampo
				("ciudad", "dep_id", "ciu_id", $this->input->post('ciu_id')));
				echo " (";
				echo $this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", $this->home_model->obtenerCampo
				("departamento", "pai_id", "dep_id", $this->home_model->obtenerCampo
				("ciudad", "dep_id", "ciu_id", $this->input->post('ciu_id'))));
				echo ")";
			?>
            <br />
            <strong>Sitio / Locación</strong>
            <br />
            <?php echo $this->input->post('evs_sitio'); ?>
            <br />
            <strong>Contacto Supervisor</strong>
            <br />
            <?php echo $this->input->post('evs_contacto'); ?>
            <br />
            <strong>Teléfono Contacto</strong>
            <br />
            <?php echo $this->input->post('evs_telefono'); ?>
            <br />
            <strong>Hora Inicio / Hora Fin</strong>
            <br />
            <?php echo $this->input->post('evs_horainicio'); ?>:00 -
            <?php echo $this->input->post('evs_horainicio'); ?>:00
            <br />
            <strong>Descripción / Detalles</strong>
            <br />
            <?php echo $this->input->post('evs_descripcion'); ?>
			<br /><br />
            </td>
            <td colspan="4">
            <table id="dataTable" width="100%">
                <?php echo $actividadesVigentes; ?>
            </table>
            </td>
            </tr>
            <tr>
            	<td colspan="4">&nbsp;</td>
            </tr>
            <tr>
        	<td>Notas / Observaciones</td>
            <td colspan="3">
            <?php echo form_textarea(array('name' => 'evs_notaselectro', 'value' => set_value('prd_nombre'), 'cols' => '40', 'rows' => '5', 'class' => 'caja')); ?>
            </td>
        </tr>
        <tr>
        	<td>Observaciones del Cliente</td>
            <td colspan="3">
            <?php echo form_textarea(array('name' => 'evs_notascliente', 'value' => set_value('prd_nombre'), 'cols' => '40', 'rows' => '5', 'class' => 'caja')); ?>
            </td>
        </tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        	<td colspan="8" align="right">
			<?php echo form_submit(array('name'=> 'enviar', 'value'=>'Descartar')); ?>
			<?php echo form_submit(array('name'=> 'enviar', 'value'=>'Almacenar y Exportar', 'class' => 'btn btn-primary')); ?>
            </td>
        </tr>
        
	</table>
	<?php 	echo $varGenerales; 
    		echo form_hidden('evs_codigonegocio', $this->input->post('evs_codigonegocio'));
            echo form_hidden('fev_id', $this->input->post('fev_id'));
            echo form_hidden('evs_notaformato', $this->input->post('evs_notaformato')); 
            echo form_hidden('evs_fechasoporte', $this->input->post('evs_fechasoporte')); 
            echo form_hidden('cli_id', $this->input->post('cli_id')); 
            echo form_hidden('ciu_id', $this->input->post('ciu_id')); 
            echo form_hidden('evs_sitio', $this->input->post('evs_sitio')); 
            echo form_hidden('evs_contacto', $this->input->post('evs_contacto')); 
            echo form_hidden('evs_telefono', $this->input->post('evs_telefono')); 
            echo form_hidden('evs_horainicio', $this->input->post('evs_horainicio')); 
            echo form_hidden('evs_horafin', $this->input->post('evs_horafin')); 
            echo form_hidden('evs_descripcion', $this->input->post('evs_descripcion')); 
            echo form_hidden('eas_id', $this->input->post('eas_id'));
	?>
	<?php echo form_close(); ?>
</div>