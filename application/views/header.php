<?php
		if($this->session->userdata('nombreUsuario') == ""){
	 		if(($this->uri->uri_string() != 'home') && ($this->uri->uri_string() != 'home/logout'))
				//echo $this->uri->uri_string();
				redirect('/home');	
		}	
	$rootDir = ROUTE_SERVER."index.php/";
	$server = ROUTE_SERVER;
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <link rel="shortcut icon" href="<?php echo $server; ?>favicon.ico">
    <!-- <meta charset="utf-8"> -->
    <!--<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />-->
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>ElectroSoft 1.0.</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <style type="text/css" title="currentStyle">
        @import "<?php echo ROUTE_SERVER ?>DataTables-1.9.2/media/css/jquery.dataTables_themeroller.css";
		</style>
	
    <link href="<?php echo $server; ?>bootstrap/css/bootstrap.css" rel="stylesheet">
    <link type="text/css" href="<?php echo $server; ?>css/css/custom-theme/jquery-ui-1.8.21.custom.css" rel="stylesheet" />
            
        <link rel="stylesheet" type="text/css" media="all" href="<?php echo base_url(); ?>js/jscalendar-1.0/calendar-blue.css" title="blue" />
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jscalendar-1.0/calendar.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jscalendar-1.0/lang/calendar-en.js"></script>
        <script type="text/javascript" src="<?php echo base_url(); ?>js/jscalendar-1.0/calendar-setup.js"></script>
               
		<script type="text/javascript">
			$(function(){

				// Accordion
				$("#accordion").accordion({ header: "h3" });

				// Tabs
				$('#tabs').tabs();

				// Dialog
				$('#dialog').dialog({
					autoOpen: false,
					width: 600,
					buttons: {
						"Ok": function() {
							$(this).dialog("close");
						},
						"Cancel": function() {
							$(this).dialog("close");
						}
					}
				});

				$('#dialog_link').click(function(){
					$('#dialog').dialog('open');
					return false;
				});

				$('#datepicker').datepicker({
					inline: true
				});

				$('#slider').slider({
					range: true,
					values: [17, 67]
				});

				$("#progressbar").progressbar({
					value: 20
				});

				$('#dialog_link, ul#icons li').hover(
					function() { $(this).addClass('ui-state-hover'); },
					function() { $(this).removeClass('ui-state-hover'); }
				);

			});
		</script>
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
      .sidebar-nav {
        padding: 9px 0;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
    <script type="text/javascript" src="<?php echo $server; ?>css/js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="<?php echo $server; ?>css/js/jquery-1.7.2.js"></script>
    <script type="text/javascript" >
	$(document).ready(function(){
	$('.dropdown-toggle').dropdown();
	});
	
	</script>
    <script type="text/javascript" language="javascript" src="<?php echo $server; ?>DataTables-1.9.2/media/js/jquery.js"></script>
		<script type="text/javascript" language="javascript" src="<?php echo $server; ?>DataTables-1.9.2/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			$(document).ready(function() {
				$('#mainTable').dataTable();
			
				
			} );
			
		</script>
  </head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container-fluid">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">ElectroSoft 2013</a>
          
          <ul class="nav nav-pills">
          <li class="active"><a href="<?php echo $rootDir; ?>?">Inicio</a></li>
          </li>
            </ul>
            <p class="navbar-text pull-right">
            Logueado como  <a href="#"> <?php echo $this->session->userdata('nombrePilaUsuario')." (".$this->session->userdata('nombreUsuario').")"; ?></a></p>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
