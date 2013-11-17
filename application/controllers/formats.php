<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formats extends CI_Controller {
    
    protected $posX;
    protected $posY;
    
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('html');
        $this->load->helper('form');
        $this->load->library('fpdf');
        $this->load->library("pdf");
        $this->load->library('form_validation');
        $this->load->library('basics');
        $this->load->library('encrypt');
        $this->load->model('home_model');
        $this->posX = 10;
        $this->posY = 50;
    }
		
		public function index(){
			$attributes = array(
                'width'     =>  '1000',
                'height'    =>  '600',
                'screenx'   =>  '\'+((parseInt(screen.width) - 1000)/2)+\'',
                'screeny'   =>  '\'+((parseInt(screen.height) - 600)/2)+\'',
                'scrollbars' => 'yes',
                'status'     => 'yes',
                'resizable'  => 'yes',
            );
			$this->load->view('header');
			$this->load->view('menu');
			$tableInicio = "";
			$objIndex = $this->home_model->consultarObjetoSimple("evs_id", "evs_fecharegistro", "evidenciasoporte", "", "evs_id", "DESC");
            if($objIndex == false){
                $tableInicio.= "";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "
									<tr>
										<td align='center'>".anchor_popup("formats/pdf/".str_pad($arr2->codigo,6,"0",STR_PAD_LEFT), 
                        					img(array('src' => 'multimedia/images/filetopdf.png', 'width' => '16','title' => 'Ver en PDF', 'border' => '0')), $attributes)."</td>
										<td align='center'>".str_pad($arr2->codigo,6,"0",STR_PAD_LEFT)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("evidenciasoporte", 
										"evs_fechasoporte", "evs_id", $arr2->codigo)."</td>
										<td align='center'>".$this->home_model->obtenerCampo("cliente", 
										"cli_nombrecomercial", "cli_id", $this->home_model->obtenerCampo("evidenciasoporte", 
										"cli_id", "evs_id", $arr2->codigo))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("formatoevidencia", 
										"fev_codigo", "fev_id", $this->home_model->obtenerCampo("evidenciasoporte", 
										"fev_id", "evs_id", $arr2->codigo))." - ".
										$this->home_model->obtenerCampo("formatoevidencia", 
										"fev_nombre", "fev_id", $this->home_model->obtenerCampo("evidenciasoporte", 
										"fev_id", "evs_id", $arr2->codigo))."</td>
										<td>".$this->home_model->obtenerCampo("usuario", 
										"usr_nombres", "usr_id", $this->home_model->obtenerCampo("evidenciasoporte", 
										"usr_idregistro", "evs_id", $arr2->codigo))." ".
										$this->home_model->obtenerCampo("usuario", 
										"usr_apellidos", "usr_id", $this->home_model->obtenerCampo("evidenciasoporte", 
										"usr_idregistro", "evs_id", $arr2->codigo))."</td>
										
									</tr>";
				}	
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(55));			
			$this->load->view('formats_inicio', $dataForm);
	
			$this->load->view('footer');
		}
		
		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			if($this->input->post('enviar') == 'Descartar'){
				redirect("formats/index");
			}
			if($this->input->post('enviar') == "Almacenar y Exportar"){
				$this->home_model->registrarFormatoSoporte($this->input->post());
				redirect("formats/index");	
			}
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(56));
			$dataForm['formatosDisponibles'] = $this->basics->cargarOpcion($this->home_model->consultarFormatosSoporte());
			$dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['clienteActivo'] = $this->basics->cargarOpcion($this->home_model->consultarClientesVigentesSimple());
			$dataForm['evs_fechasoporte'] = date("Y-m-d");
			$dataForm['cmbHoras'] = array(
				"6" => "06:00", "7" => "07:00", "8" => "08:00", "9" => "09:00",
				"10" => "10:00", "11" => "11:00", "12" => "12:00", "13" => "13:00", "14" => "14:00",
				"15" => "15:00", "16" => "16:00", "17" => "17:00", "18" => "19:00", "20" => "20:00",
				"21" => "21:00", "22" => "22:00");
			if($this->input->post('fev_id') == ""){
				$this->load->view('formats_prev', $dataForm);	
			}
			else{
				if($this->input->post('cli_id') == ""){
					$this->load->view('formats_prev2', $dataForm);	
				}
				else{
					if($this->input->post('eas_id') == ""){
						$actividadFormato = $this->home_model->consultarObjetoSimple(	"aev_id", "aev_nombre",
																						"actividadevidencia", 
																						"est_id = 1 AND fev_id = '".
																						$this->input->post('fev_id')."'", 
																						"aev_orden", "ASC");
						if($actividadFormato == false){
							$dataForm['actividadesVigentes'] = "<tr>
																	<td colspan='4' align='center'>
																	".br(2)." No hay actividades programadas para el formato,
																	 verifique su consistencia y vuelva a intentarlo... ".br(3)."
																	</td>
																</tr>";               
						} 
						else{
							$dataForm['actividadesVigentes'] = "<tr>
											<td><strong>No.</strong></td>
											<td><strong>Actividad / Tarea / Descripción</strong></td>
											<td><strong>Estado</strong></td>
											<td><strong>Notas / Comentarios</strong></td>
										</tr>";
							$i = 1;
							foreach ($actividadFormato as $arr1=>$arr2) {
								$dataForm['actividadesVigentes'].= "<tr><td>$i</td>";
								$dataForm['actividadesVigentes'].= "<td>".$arr2->nombre."</td>";
								$dataForm['actividadesVigentes'].= "<td>".form_dropdown('idAct'.$arr2->codigo, 
																			$this->basics->cargarOpcion(
																			$this->home_model->consultarEstadosActividad())).
																			"</td>";
								$dataForm['actividadesVigentes'].= "<td>".form_input(array('name' => 'txtAct'.$arr2->codigo
								, 'id' => 'txtAct'.$arr2->codigo, 'value'=>  set_value('txtAct'.$arr2->codigo) )).
								"</td></tr>";
								$i++;
							}
							if($i >= 1){$dataForm['eas_id'] = 1;}
						}
						$this->load->view('formats_prev3', $dataForm);	
					}
					else{
						$dataForm['actividadesVigentes'] = "<tr>
											<td><strong>No.</strong></td>
											<td><strong>Actividad / Tarea / Descripción</strong></td>
											<td><strong>Estado</strong></td>
											<td><strong>Notas / Comentarios</strong></td>
										</tr>";
							$i = 1;
							$actividadFormato = $this->home_model->consultarObjetoSimple(	"aev_id", "aev_nombre",
																						"actividadevidencia", 
																						"est_id = 1 AND fev_id = '".
																						$this->input->post('fev_id')."'", 
																						"aev_orden", "ASC");
							$dataForm['varGenerales'] = "";
							foreach ($actividadFormato as $arr1=>$arr2) {
								$id = "idAct".$arr2->codigo;
								$txt = "txtAct".$arr2->codigo;
								
								if(trim($this->input->post($txt)) == ""){
									$txtActividad = "No Aplica / Sin Definir";
								}
								else{
									$txtActividad = $this->input->post($txt);
								}
								$dataForm['actividadesVigentes'].= "<tr><td>$i</td>";
								$dataForm['actividadesVigentes'].= "<td>".$arr2->nombre."</td>";
								$dataForm['actividadesVigentes'].= "<td>".
								$this->home_model->obtenerCampo("estadoactividadsoporte", "eas_nombre", "eas_id", 
								$this->input->post($id))."</td>";
								$dataForm['actividadesVigentes'].= "<td>".$txtActividad."</td></tr>";
								$dataForm['varGenerales'].= form_hidden($id, $this->input->post($id));
								$dataForm['varGenerales'].= form_hidden($txt, $txtActividad);
								$i++;
							}
						
						$this->load->view('formats_prev4', $dataForm);
					}
					
				}
			}
			$this->load->view('footer');
		}
		
    public function formatPDF($IDFormato){
      $fevID = $this->home_model->obtenerCampo("evidenciasoporte", "fev_id", "evs_id", intval($IDFormato));
      if($this->home_model->obtenerCampo("evidenciasoporte", "evs_fecharegistro", "evs_id", intval($IDFormato)) != ""){
        $titFormato = strtoupper("(".$this->home_model->obtenerCampo("formatoevidencia", "fev_codigo", "fev_id", $fevID).") ".$this->home_model->obtenerCampo("formatoevidencia", "fev_nombre", "fev_id", $fevID))." - ".str_pad(intval($IDFormato),6,"0",STR_PAD_LEFT);
        $fevID = $this->home_model->obtenerCampo("evidenciasoporte", "fev_id", "evs_id", intval($IDFormato));
        $usrID = $this->home_model->obtenerCampo("evidenciasoporte", "usr_idregistro", "evs_id", intval($IDFormato));
        $titFormato = strtoupper("(".$this->home_model->obtenerCampo("formatoevidencia", "fev_codigo", "fev_id", $fevID).") ".$this->home_model->obtenerCampo("formatoevidencia", "fev_nombre", "fev_id", $fevID))." - ".str_pad(intval($IDFormato),6,"0",STR_PAD_LEFT);
        $fregistro = date("Y-m-d H:i:s", strtotime($this->home_model->obtenerCampo("evidenciasoporte", "evs_fecharegistro", "evs_id", intval($IDFormato))));
        $fsoporte = $this->home_model->obtenerCampo("evidenciasoporte", "evs_fechasoporte", "evs_id", intval($IDFormato));
        $codnegocio = $this->home_model->obtenerCampo("evidenciasoporte", "evs_codigonegocio", "evs_id", intval($IDFormato));
        $hinicio = $this->home_model->obtenerCampo("evidenciasoporte", "evs_horainicio", "evs_id", intval($IDFormato));
        $hfinal = $this->home_model->obtenerCampo("evidenciasoporte", "evs_horafin", "evs_id", intval($IDFormato));
        $cliente = $this->home_model->obtenerCampo("evidenciasoporte", "evs_fecharegistro", "evs_id", intval($IDFormato));
        $ciudad = $this->home_model->obtenerCampo("evidenciasoporte", "evs_fecharegistro", "evs_id", intval($IDFormato));
        $lugar = $this->home_model->obtenerCampo("evidenciasoporte", "evs_sitio", "evs_id", intval($IDFormato));
        $supervisa = $this->home_model->obtenerCampo("evidenciasoporte", "evs_contacto", "evs_id", intval($IDFormato));
        $ncontacto = $this->home_model->obtenerCampo("evidenciasoporte", "evs_telefono", "evs_id", intval($IDFormato));
        $felectro = $this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $usrID)." ".
                    $this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $usrID);
        $celectro = $this->home_model->obtenerCampo("evidenciasoporte", "evs_fecharegistro", "evs_id", intval($IDFormato));
        $desDet = $this->home_model->obtenerCampo("evidenciasoporte", "evs_notaformato", "evs_id", intval($IDFormato));
        $desElectro = $this->home_model->obtenerCampo("evidenciasoporte", "evs_notaselectro", "evs_id", intval($IDFormato));
        $desCustom = $this->home_model->obtenerCampo("evidenciasoporte", "evs_notascliente", "evs_id", intval($IDFormato));

        $this->pdf->SetTitle($titFormato);
        $this->pdf->SetFooter(TEXT_FOOTER);
        $this->pdf->SetTextColor(3,9,61);
        $this->pdf->Open();
        $this->pdf->AddPage();

        $this->pdf->fila(array(
            array("4" => "Fecha de Registro"),
            array("4" => "Fecha de Soporte:"),
            array("4" => "Código de Negocio:"),
            array("4" => "Hora Inicio:"),
            array("4" => "Hora Fin:"),
        ), "BI");
        $this->pdf->fila(array(
            array("4" => $fregistro),
            array("4" => $fsoporte),
            array("4" => $codnegocio),
            array("4" => $hinicio.":00"),
            array("4" => $hfinal.":00"),
        ), "");

        $this->pdf->fila(array(
            array("8" => "Nombre del Cliente:"),
            array("12" => "Ciudad / Departamento:"),
        ), "BI");
        $this->pdf->fila(array(
            array("8" => $cliente),
            array("12" => $ciudad),
        ), "");

        $this->pdf->fila(array(
            array("8" => "Lugar / Sitio de Ejecución:"),
            array("8" => "Supervisa / Revisa:"),
            array("4" => "Nro. Contacto:"),
        ), "BI");
        $this->pdf->fila(array(
            array("8" => $lugar),
            array("8" => $supervisa),
            array("4" => $ncontacto),
        ), "");

        $this->pdf->fila(array(
            array("8" => "Funcionario Ejecutante Electroequipos:"),
            array("12" => "Puesto / Cargo / Nivel:"),
        ), "BI");
        $this->pdf->fila(array(
            array("8" => $felectro),
            array("12" => $celectro),
        ), "");
        $this->pdf->fila(array(
            array("20" => "Notas / Comentarios Previos"),
        ), "BI");
        $this->pdf->fila(array(
            array("20" => "\n".$desDet."\n\n"),
        ), "");
        
        $this->pdf->fila(array(
            array("1" => "No."),
            array("7" => "Actividad / Tarea / Descripción"),
            array("5" => "Estado"),
            array("7" => "Notas / Comentarios"),
        ), "BI");
        
        $obj = $this->home_model->getSoporteActividades($IDFormato);
        if ($obj != false) {
          foreach ($obj as $value) {
            $this->pdf->fila(array(
              array("1" => $value->codigo),
              array("7" => $value->actividad),
              array("5" => $value->estado),
              array("7" => $value->comentario),
            ), "");
            
          }
        }        
        $this->pdf->fila(array(
            array("20" => "Evidencias y/o Soportes de Mantenimiento "),
        ), "BI");
        $this->pdf->fila(array(
            array("8" => "\n".$desCustom."\n\n"),
            array("12" => "\n".$desCustom."\n\n"),
        ), "");
        
        
        
        $this->pdf->fila(array(
            array("20" => "Comentarios / Observaciones Electroequipos"),
        ), "BI");
        $this->pdf->fila(array(
            array("20" => "\n".$desElectro."\n\n"),
        ), "");
        
        $this->pdf->fila(array(
            array("20" => "Comentarios / Observaciones del Cliente"),
        ), "BI");
        $this->pdf->fila(array(
            array("20" => "\n".$desCustom."\n\n"),
        ), "");
        
        $this->pdf->fila(array(
            array("10" => "Firma funcionario Electroequipos"),
            array("10" => "Firma funcionario Cliente"),
        ), "BI");
        $this->pdf->fila(array(
            array("10" => "\n\n\n\n"),
            array("10" => ""),
        ), "");
        $this->pdf->fila(array(
            array("10" => "Nombres y Apellidos:"),
            array("10" => "Nombres y Apellidos:"),
        ), "");
        $this->pdf->fila(array(
            array("10" => "CC / NIT:"),
            array("10" => "CC / NIT:"),
        ), "");
        $this->pdf->fila(array(
            array("10" => "Cargo:"),
            array("10" => "Cargo:"),
        ), "");

        $this->pdf->Output();
      }else{
        echo "Error en el archivo, verifique los parámetros dados";
        die();
      }
    }
}
?>