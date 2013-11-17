<div id="contenedorPrincipal"> 
	<div id="alerts">
    	<table id='userProfile'>
    		<tr>
    			<th colspan="2">
    				<?php echo $this->session->userdata('nombrePilaUsuario')." (".$this->session->userdata('nombreUsuario').")"; ?>
    			</th>
    		</tr>
    		<tr><td rowspan="3" align='center'><?php echo anchor('?', img( array('src' => 'multimedia/images/userProfile.png', 'width' => '50', 'height' => '50','title' => 'Mi Perfil', 'border' => '0')), array('title' => 'Mi Perfil')); ?></td>
    			<td><?php echo $this->session->userdata('cargo'); ?></td></tr>
    		<tr><td><?php echo $this->session->userdata('hora'); ?></td></tr>
    		<tr><td align="center">
    			<?php echo anchor('home/index', img( array('src' => 'multimedia/images/home.png', 'width' => '16', 'height' => '16','title' => 'Inicio', 'border' => '0')), array('title' => 'Inicio')); ?>
    				<?php echo anchor('home/logout', img( array('src' => 'multimedia/images/exit.png', 'width' => '16', 'height' => '16','title' => 'Cerrar Sesión', 'border' => '0')), array('title' => 'Cerrar Sesión')); ?>
    		</td></tr>
    		
    	</table>
		
		<br>
		<!--
		<table id='alertProfile'>
			<tr>
				<th>Alertas / Notificaciones</th>
			</tr>
    		<tr>
    			<td align='center'>
    			<br><br>
    			Aquí cargarán todas las notificaciones y alertas del sistema en los módulos disponibles...
    			<br><br><br>
    			</td>
    		</tr>
    	</table>
		-->
	</div>
    
