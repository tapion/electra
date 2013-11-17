<?php $server = ROUTE_SERVER; ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>ElectroSoft 1.0.</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="<?php echo $server; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="<?php echo $server; ?>css/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
    <style type="text/css">
      html, body {
        background-color: #eee;
      }
      body {
        padding-top: 40px; 
      }
      .container {
        width: 70%;
      }
      .container > .content {
        background-color: #fff;
        padding: 20px;
        margin: 0 -20px; 
        -webkit-border-radius: 10px 10px 10px 10px;
           -moz-border-radius: 10px 10px 10px 10px;
                border-radius: 10px 10px 10px 10px;
        -webkit-box-shadow: 0 1px 2px rgba(0,0,0,.15);
           -moz-box-shadow: 0 1px 2px rgba(0,0,0,.15);
                box-shadow: 0 1px 2px rgba(0,0,0,.15);
      }

	  .login-form {
		margin-left: 65px;
	  }
	
	  legend {
		margin-right: -50px;
		font-weight: bold;
	  	color: #404040;
	  }

    </style>

</head>
<body>
  <div class="container">
    <div class="content">
    	<div align="center"><img src="<?php echo $server; ?>multimedia/images/logoElectro.png" /></div>
      	<div class="row">
      	<div class="login-form">
        	<div>&nbsp;</div>
            <table border="0" width="100%">
            	<tr>
                <td width="70%" valign="top">
                <table>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td colspan="2">Con nuestra versión 1.0. del sistema <strong>ELECTROSOFT</strong> Puedes contar con 
                    las siguientes características y módulos funcionales:</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td rowspan="2" width="5%"><?php echo img('multimedia/images/document.png'); ?></td><td width="95%">
                    <h4>Gestión Documental</h4></td></tr>
                    <tr><td>Controlar tus documentos de manera sencilla, centralizada y en cualquier momento</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td rowspan="2" width="5%"><?php echo img('multimedia/images/calendar.png'); ?></td><td width="95%">
                    <h4>Planeación</h4></td></tr>
                    <tr><td>Planear reuniones con clientes, bitácora y actividades</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td rowspan="2" width="5%"><?php echo img('multimedia/images/arrow.png'); ?></td><td width="95%">
                    <h4>Seguimiento de Clientes</h4></td></tr>
                    <tr><td>Gestionar relaciones comerciales, prospectos de ventas y negocios</td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td rowspan="2" width="5%"><?php echo img('multimedia/images/graph.png'); ?></td><td width="95%">
                    <h4>Indicadores de Gestión</h4></td></tr>
                    <tr><td>Visualizar de manera efectiva y sencilla los resultados de la gestión corporativa</td></tr>
                </table>
                </td>
                         <td width="30%" valign="top">
                	<div>&nbsp;</div>
                    <div><?php echo $infoVista; ?></div>
                    <div>&nbsp;</div>
                    <?php echo form_open('home/'); ?>
                    <fieldset>
                      <div class="clearfix">
                        <?php echo form_input(array('name' => 'usuario', 'placeholder' => 'Nombre de Usuario',
						'id' => 'usuario', 'size' => '35', 'value'=>  set_value('usuario') )); ?>
                      </div>
                      <div class="clearfix">
                        <?php echo form_password(array('name' => 'contrasena', 'id' => 'contrasena',  
						'size' => '35', 'value'=>  "", 'placeholder' => 'Contraseña')); ?>
                      </div>
                      <button class="btn btn-primary" type="submit">Iniciar Sesión</button>
                    </fieldset>
                    <?php echo form_close(); ?></td>
                </tr>
            </table>
        </div>
        <div>&nbsp;</div>
        <div class="footer">
            &copy; 2013 Electroequipos Colombia S.A.S    
        </div>
            
      </div>
    </div>
  </div>
</body>
</html>
