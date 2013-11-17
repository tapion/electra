<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by Free CSS Templates
http://www.freecsstemplates.org
Released for free under a Creative Commons Attribution 2.5 License

Name       : TrendyBiz
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20120818

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="keywords" content="" />
<meta name="description" content="" />
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link href="favicon.ico" rel="shortcut icon" type="image/ico" />
<title>gestionarTecnologia - Su aliado en Tecnología</title>
<link href="http://fonts.googleapis.com/css?family=Dancing+Script|Open+Sans+Condensed:300" rel="stylesheet" type="text/css" />
<link href="style.css" rel="stylesheet" type="text/css" media="screen" />

<link rel="stylesheet" href="js/nivoslider/nivo-slider.css" type="text/css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js" type="text/javascript"></script>
<script src="js/nivoslider/jquery.nivo.slider.pack.js" type="text/javascript"></script>

</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
$(window).load(function() {
$('#slider').nivoSlider({
effect:'random',
slices:15,
animSpeed:500,
pauseTime:10000,
directionNav:true, //Next & Prev
directionNavHide:true, //Only show on hover
controlNav:false, //1,2,3...
pauseOnHover:true, //Stop animation while hovering
beforeChange: function(){},
afterChange: function(){}
});
});
</script>
<div id="wrapper">
	<div id="menu-wrapper">
		<div id="menu" class="container">
			<ul>
				<li class="current_page_item"><a href="#">Inicio</a></li>
				<li><a href="#">Servicios</a></li>
				<li><a href="#">Productos</a></li>
                <li><a href="#">Tecnologías Aplicadas</a></li>
				<li><a href="#">Contáctenos</a></li>
			</ul>
		</div>
	</div>
	<div id="logo" class="container">
    	<h1>
        <a href="#"><img src="images/gestecno.png" border=0 height="80"/></a></h1>
		<p>Soluciones y Consultoría en Tecnologías de la Información</p>
	</div>
	<div class="divider">&nbsp;</div>
	<div id="page" class="container">
		<div id="content">
			<div class="post">
				<div class="entry">
                	<div id="slider">
                    <img src="images/slide1.png" width=600 alt="" />
                    <a href="http://dev7studios.com"><img src="images/slide2.png" alt="" /></a>
                    <img src="images/slide3.png" alt="" title="This is an example of a caption" />
                    <img src="images/slide4.png" alt="" />
                    <img src="images/slide5.png" alt="" />
                    <img src="images/slide6.png" alt="" />
                    
                    </div>
					<p>Las marcas, productos y logos anteriormente descritos, hacen parte de sus 
                    propietarios en cada caso.</p>
				</div>
			</div>
			
		</div>
		<!-- end #content -->
		<div id="sidebar">
			<div>
				<h2>Portafolio de Servicios</h2>
                
				<ul class="list-style1">
					<li class="first"><a href="#">Desarrollo de Sistemas de Información a la Medida</a></li>
					<li><a href="#">Gestión de Bases de Datos</a></li>
					<li><a href="#">Telefonía VOIP Asterisk</a></li>
					<li><a href="#">Infraestructura con Servidores Corporativos</a></li>
					<li><a href="#">Soporte y Mantenimiento en General</a></li>
					<li><a href="#">Optimización de Procesos con Herramientas Libres</a></li>
				</ul>
			</div>
		</div>
		<!-- end #sidebar -->
		
	</div>
	<!-- end #page -->
	<div class="divider">&nbsp;</div>
	<div id="three-column" class="container">
		<div id="tbox1">
			<div class="box-style">
				<div class="image"><img src="images/software.png" height="128" alt="" /></div>
				<div class="arrow"></div>
				<div class="content">
					<h2>Sistemas a la Medida</h2>
					<p>¿Su operación es compleja?, Le brindamos soluciones modulares y efectivas que le permitirán optimizar sus
                    tiempos de gestión a través de aplicaciones sencillas adaptadas al 100% de su negocio. 
                    <a href="#">Ver más (+)</a></p>
				</div>
			</div>
		</div>
		<div id="tbox2">
			<div class="box-style">
				<div class="image"><img src="images/network.png" height="128" alt="" /></div>
				<div class="arrow"></div>
				<div class="content">
					<h2>Servidores y Telefonía IP</h2>
					<p>Lo asesoramos en todo momento en su implementación de tecnología en su compañía con soluciones
                    efectivas, seguras y sencillas tales como servidores de telefonía IP, correo, internet y de políticas de
                    usuarios corporativos. <a href="#">Ver más (+)</a></p>
				</div>
			</div>
		</div>
		<div id="tbox3">
			<div class="box-style">
				<div class="image"><img src="images/tools.png" height="128" alt="" /></div>
				<div class="arrow"></div>
				<div class="content">
					<h2>Soporte y Mantenimiento </h2>
					<p>Cuente con nosotros en todo momento, lo asesoramos y acompañamos durante todas las etapas de operación
                    y producción de su negocio, brindamos consultoría en sus herramientas ya implementadas para su mantenimiento
                    u optimización. <a href="#">Ver más (+)</a></p>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="footer-content" class="container">
	<div id="footer-bg">
		<div id="column1">
			<h2>Contacto</h2>
			<p>
            <a href="mailto:servicioalcliente@gestionartecnologia.com?subject=Requiero Información">
			servicioalcliente@gestionartecnologia.com</a>
            <br />
            (57) 3016451362
            <br />
            Bogotá D.C., Colombia
            <br />
            <div class="fb-like" data-href="http://www.gestionartecnologia.com" data-send="true" data-width="200" data-show-faces="true" data-font="arial"></div>
			</p>
		</div>
		<div id="column2">
			<h2>Portafolio de Servicios</h2>
			<ul class="list-style2">
				<li class="first">
                <a href="#">Desarrollo de Sistemas de Información a la Medida</a></li>
				<li><a href="#">Gestión de Bases de Datos</a></li>
				<li><a href="#">Telefonía VOIP Asterisk</a></li>
				<li><a href="#">Infraestructura de Servidores Corporativos </a></li>
           		<li><a href="#">Optimización de Procesos con Herramientas Libres</a></li>
				<li><a href="#">Soporte en General</a></li>
			</ul>
		</div>
		<div id="column3">
			<h2>Beneficios</h2>
			<ul class="list-style2">
				<li class="first"><a href="#">Desarrollo de Sistemas según estándares</a></li>
				<li><a href="#">Análisis de Datos y Tendencias Comerciales</a></li>
				<li><a href="#">Acompañamiento continuo en su implementación y mantenimiento</a></li>
				<li><a href="#">Sistemas Escalables (Baja Cohesión - Alto Acoplamiento)</a></li>
				<li><a href="#">Soluciones integrales y asesorías en su compañía</a></li>
			</ul>
		</div>
	</div>
</div>
<div id="footer">
	<p>© 2013 GestionarTecnologia. Todos los derechos reservados.</p>
</div>
<!-- end #footer -->
</body>
</html>
