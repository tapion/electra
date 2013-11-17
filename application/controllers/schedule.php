<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Schedule extends CI_Controller {
		
		protected $posX;
		protected $posY;
    
        public function __construct()
        {
			parent::__construct();
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('basics');
			$this->load->library('encrypt');
			$this->load->model('home_model');
			$this->posX = 20;
			$this->posY = 40;
        }
		
		public function index(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('alerts');
			$tableInicio = "";
			$objIndex = $this->home_model->consultarObjetoSimple("evc_id", "evc_tituloevento", "eventocomercial", "usr_idresponsable = '".$this->session->userdata('idUsuario')."'", "evc_id", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				$i = 1;
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr>
										<td align='center'>".$i."</td>
										<td align='center'>".anchor("schedule/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $this->home_model->obtenerCampo("eventocomercial", "usr_idresponsable", "evc_id", $arr2->codigo))." ".$this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $this->home_model->obtenerCampo("eventocomercial", "usr_idresponsable", "evc_id", $arr2->codigo))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("cliente", "cli_razonsocial", "cli_id", $this->home_model->obtenerCampo("eventocomercial", "cli_id", "evc_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
									</tr>";
					$i++;
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(53));	
			$this->load->view('schedule_index', $dataForm);
			$this->load->view('footer');
		}
		
		public function calendar(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('alerts');
			$this->load->view('schedule_calendar');
			$this->load->view('footer');
		}
		
		public function edit($id=""){
			if($id == ""){
				redirect('?');
			}
			else{
				$dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(26));
				$dataForm['tituloEvento'] = $this->home_model->obtenerCampo("eventocomercial", "evc_tituloevento", "evc_id", $id);
				$this->load->view('header');
				$this->load->view('menu');
				$this->load->view('alerts');
				$this->load->view('schedule_editevent', $dataForm);
				$this->load->view('footer');
			}
		}
		
		public function newEvent(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('alerts');
			
			$this->form_validation->set_rules('evc_tituloevento', 'Titulo del Evento', 'required|trim|min_length[10]');
			
			$dataForm['contactoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarContactosVigentesEstandar());
			/*$dataForm['cmbHoras'] = array(
				"0" => "00:00", "1" => "01:00", "2" => "02:00", "3" => "03:00", "4" => "04:00",
				"5" => "05:00", "6" => "06:00", "7" => "07:00", "8" => "08:00", "9" => "09:00",
				"10" => "10:00", "11" => "11:00", "12" => "12:00", "13" => "13:00", "14" => "14:00",
				"15" => "15:00", "16" => "16:00", "17" => "17:00", "18" => "19:00", "20" => "20:00",
				"21" => "21:00", "22" => "22:00", "23" => "23:00");*/
			$dataForm['cmbHoras'] = array(
				"6" => "06:00", "7" => "07:00", "8" => "08:00", "9" => "09:00",
				"10" => "10:00", "11" => "11:00", "12" => "12:00", "13" => "13:00", "14" => "14:00",
				"15" => "15:00", "16" => "16:00", "17" => "17:00", "18" => "19:00", "20" => "20:00",
				"21" => "21:00", "22" => "22:00");
			$dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['ejecutivoActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
			$dataForm['cclp'] = '';
			
			if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista'] = $this->basics->viewMessage($this->home_model->consultarMensaje(26));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(11));
				$this->home_model->registrarEventoComercial($this->input->post());
				redirect('/schedule/index/');
			}
			
			if(!$this->input->post("evc_fechainicio")){
				$dataForm['evc_fechainicio'] = date("Y-m-d");
			}
			else{
				$dataForm['evc_fechainicio'] = $this->input->post("evc_fechainicio");
			}
			if(!$this->input->post("evc_fechafin")){
				$dataForm['evc_fechafin'] = date("Y-m-d");
			}
			else{
				$dataForm['evc_fechafin'] = $this->input->post("evc_fechafin");
			}
			
			$this->load->view('schedule_addEvent', $dataForm);
			$this->load->view('footer');
		}
}
?>
