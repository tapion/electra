<?php
    if($this->session->userdata('nombreUsuario') == ""){
        if(($this->uri->uri_string() != 'home') && ($this->uri->uri_string() != 'home/logout'))
            //echo $this->uri->uri_string();
            redirect('/home');	
    }	
    $server = ROUTE_SERVER."index.php/";
?>
<div class="container-fluid">
  <div class="row-fluid">
    <div class="span3">
      <div class="well sidebar-nav">
        <ul class="nav nav-list">
        <?php
                $seccion = $this->home_model->obtenerSecciones();
                foreach ($seccion as $arr1=>$sec) {
                    echo "<li class='nav-header'>".$sec->nombre."</li>";
                    $modulo = $this->home_model->obtenerSecciones(2, $sec->id);
                    foreach ($modulo as $arr1=>$mod) {
                            $ruta = $mod->vinculo;
                            $activo = "";
                            if(strpos($_SERVER["REQUEST_URI"], $ruta))
                            {$activo = " class='active'";}
                            echo "<li".$activo.">
                                    <a href=".$server.$ruta.">".
                                    $mod->nombre."</a></li>";										
                    }
                }
        ?>	
        </ul>
      </div>
    </div>
    <div class="span9">
      <div class="row-fluid">
        <div class="span12">
