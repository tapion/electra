<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Seller extends CI_Controller {
    
        public function __construct()
        {
			parent::__construct();
			$this->load->helper('html');
			$this->load->helper('form');
			$this->load->library('form_validation');
			$this->load->library('basics');
			$this->load->library('encrypt');
			$this->load->model('home_model');
        }
		
		public function index(){
			$this->load->view('header');
			$this->load->view('menu');
			$tableInicio = "";
			$objIndex = $this->home_model->consultarObjetoSimple("evt_id", "usr_id", "ejecutivoventa", "", "evt_id", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='5'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "
									<tr>
										<td align='center'>".anchor("seller/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("ejecutivoventa", "est_id", "evt_id", $arr2->codigo))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("usuario", "usr_nombreUsuario", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $arr2->codigo))."</td>
										<td align='left'>".$this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $arr2->codigo))." ".$this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $arr2->codigo))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("sede", "sed_nombre", "sed_id", $this->home_model->obtenerCampo("usuario", "sed_id", "usr_id", $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $arr2->codigo)))."</td>
										<td align='center'>".$this->home_model->obtenerCampo("lineacomercial", "lcm_nombre", "lcm_id", $this->home_model->obtenerCampo("ejecutivoventa", "lcm_id", "evt_id", $arr2->codigo))."</td>
									</tr>";
				}
			}
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(21));			
			$this->load->view('ejecutivosventa_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('lcm_id', 'Nombre de Registro', 'required');
			if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(18));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(11));
				redirect('/seller/edit/'.$this->home_model->actualizarEjecutivoVenta($_POST));
			}
			$dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['usuarioActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('seller_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("evt_id");
			}
			if(	$this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", intval($id)) == ""){
				redirect('seller/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('evt_id', 'Nombre de Registro', 'required');
            if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(10));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(11));
				redirect('/seller/edit/'.$this->home_model->actualizarEjecutivoVenta($_POST));
			}
			$dataForm['lineaComercialActivo'] = $this->basics->cargarOpcion($this->home_model->consultarLineasComercialesVigentes());
			$dataForm['lineaComercialActivoPredef'] = $this->home_model->obtenerCampo("ejecutivoventa", "lcm_id", "evt_id", $id);
			$dataForm['usuarioActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
			$dataForm['usuarioActivoPredef'] = $this->home_model->obtenerCampo("ejecutivoventa", "usr_id", "evt_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("ejecutivoventa", "est_id", "evt_id", $id);
			$dataForm['evt_firma'] = $this->home_model->obtenerCampo("ejecutivoventa", "evt_firma", "evt_id", $id);
			$dataForm['evt_id'] = $id;
			$this->load->view('seller_edit', $dataForm);
			$this->load->view('footer');
		}
}