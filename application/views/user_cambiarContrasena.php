<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('user/changepwd'); ?>
	<table width='50%' id='dataTable' class="bordeGris"  align="center">
    	<tr>
        	<th colspan="2">Cambiar Contraseña</th>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<td>
				Contraseña Anterior
			</td>
			<td>
				<?php echo form_password(array('name' => 'oldpwd', 'id' => 'oldpwd', 'width' => '20', 'size' => '20', 'value'=>  set_value('usuario') )); ?>
			</td>
        </tr>
        <tr>
			<td>
				Contraseña Nueva
			</td>
			<td>
				<?php echo form_password(array('name' => 'newpwd', 'id' => 'newpwd', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  set_value('usuario') )); ?>
			</td>
       </tr>
       <tr>
			<td width="48%">
				Verifique Nueva Contraseña
			</td>
			<td width="52%">
				<?php echo form_password(array('name' => 'renewpwd', 'id' => 'renewpwd', 'width' => '20', 'size' => '20', 'class' => 'caja', 'value'=>  set_value('usuario') )); ?>
			</td>
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		
		<tr>
			<td colspan="6" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Cambiar Contraseña', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>