<div id="cuerpo">
	<?php echo $infoVista; ?>
	<br>
	<?php echo form_open('offer/generalVars'); ?>
	<table width='50%' id='dataTable' class="bordeGris"  align="center">
    	<tr>
        	<th colspan="2">Cambiar Variables del Sistema</th>
        </tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		<tr>
			<td>
				Moneda Base
			</td>
			<td>
				<?php echo form_dropdown('monedaBase', $monedas, $monedaPredef); ?>
			</td>
        </tr>
        <tr>
			<td>
				Relación al Dólar (USD)
			</td>
			<td>
				<?php echo form_input(array('name' => 'USD', 'id' => 'USD', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $USD )); ?>
			</td>
       </tr>
       <tr>
			<td>
				Relación al Peso Colombiano (COP)
			</td>
			<td>
				<?php echo form_input(array('name' => 'COP', 'id' => 'COP', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $COP )); ?>
			</td>
       </tr>
       <tr>
                        <td>
				Relación al Franco Suizo (SFR)
			</td>
			<td>
				<?php echo form_input(array('name' => 'SFR', 'id' => 'SFR', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $SFR )); ?>
			</td>
       </tr>
       <tr>
			<td width="48%">
				Relación al Euro (EUR)
			</td>
			<td width="52%">
				<?php echo form_input(array('name' => 'EUR', 'id' => 'EUR', 'width' => '20', 'size' => '30', 'class' => 'caja', 'value'=>  $EUR )); ?>
			</td>
		</tr>
        <tr>
        	<td colspan="2">&nbsp;</td>
        </tr>
		
		<tr>
			<td colspan="6" align='right'><?php echo form_submit(array('name'=> 'enviar', 'value'=>'Cambiar Variables', 'class' => 'btn btn-primary')); ?></td>
		</tr>
	</table>
	<?php echo form_close(); ?>
	<br>
	
</div>