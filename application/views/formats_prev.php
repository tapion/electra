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
        	<td colspan="4"><strong>Nuevo Formato >> Información de Validación (Paso 1 de 4)</strong></td>
        </tr>
        <tr>
        	<td colspan="8">&nbsp;</td>
        </tr>
        <tr>
        	<td>Código Negocio</td>
            <td>
            <?php echo form_input(array('name' => 'evs_codigonegocio', 'id' => 'evs_codigonegocio', 'width' => '20', 'size' => '30', 'class' => 'caja', 'style' => 'text-transform:uppercase;', 'onkeyup'=> 'javascript:this.value=this.value.toUpperCase();', 'value'=>  set_value('evs_codigonegocio') )); ?>
            </td>
           	<td>Tipo de Formato</td>
            <td><?php echo form_dropdown('fev_id', $formatosDisponibles); ?></td>
		</tr>
        <tr>
         	<td>Notas / Comentarios</td>
            <td colspan="3"><?php echo form_textarea(array('name' => 'evs_notaformato', 
			'value' => set_value('evs_notaformato'), 'cols' => '125', 'rows' => '5', 'class' => 'caja')); ?></td>
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
		echo form_hidden('sed_id', ""); 
	
	?>
	<?php echo form_close(); ?>
</div>