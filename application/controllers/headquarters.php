<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Headquarters extends CI_Controller {
    
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
			$objIndex = $this->home_model->consultarObjetoSimple("sed_id", "sed_nombre", "sede", "", "sed_nombre", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='6'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$ciu = $this->home_model->obtenerCampo("sede", "ciu_id", "sed_id", $arr2->codigo);
					
					$tableInicio.= "<tr><td>".anchor("headquarters/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td>".$this->home_model->obtenerCampo("ciudad", "ciu_nombre", "ciu_id", $ciu).", ".$this->home_model->obtenerCampo("departamento", "dep_nombre", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $ciu))." (".$this->home_model->obtenerCampo("pais", "pai_nombre", "pai_id", $this->home_model->obtenerCampo("departamento", "pai_id", "dep_id", $this->home_model->obtenerCampo("ciudad", "dep_id", "ciu_id", $ciu))).")</td>
										<td>".$arr2->nombre."</td>
										<td>".$this->home_model->obtenerCampo("sede", "sed_direccion", "sed_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("sede", "sed_telefono", "sed_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("sede", "est_id", "sed_id", $arr2->codigo))."</td>										
									</tr>";
 				}
			}           	
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(16));			
			$this->load->view('sedes_inicio', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('sed_nombre', 'Nombre de la Sede', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('sed_direccion', 'Direccion de la Sede', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('sed_telefono', 'Telefono de la Sede', 'required|trim|min_length[3]');
            $dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['responsableActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
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
				redirect('/headquarters/edit/'.$this->home_model->actualizarSede($_POST));
			}
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$this->load->view('headquarters_new', $dataForm);
			$this->load->view('footer');
            
		}
		

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("sed_id");
			}
			if(	$this->home_model->obtenerCampo("sede", "sed_nombre", "sed_id", intval($id)) == ""){
				redirect('headquarters/index');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('sed_nombre', 'Nombre de la Sede', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('sed_direccion', 'Direccion de la Sede', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('sed_telefono', 'Telefono de la Sede', 'required|trim|min_length[3]');
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
				$this->home_model->actualizarSede($_POST);
			}
			$dataForm['ciudadActivo'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['ciudadActivoPredef'] = utf8_decode($this->home_model->obtenerCampo("sede", "ciu_id", "sed_id", $id));
			$dataForm['responsableActivo'] = $this->basics->cargarOpcion($this->home_model->consultarUsuariosVigentes());
			$dataForm['responsableActivoPredef'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_idSupervisor", "sed_id", $id));
			$dataForm['sed_nombre'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_nombre", "sed_id", $id));
			$dataForm['sed_direccion'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_direccion", "sed_id", $id));
			$dataForm['sed_telefono'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_telefono", "sed_id", $id));
			$dataForm['sed_fax'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_fax", "sed_id", $id));
			$dataForm['sed_correocorporativo'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_correocorporativo", "sed_id", $id));
			$dataForm['sed_paginaweb'] = utf8_decode($this->home_model->obtenerCampo("sede", "sed_paginaweb", "sed_id", $id));
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("ciudad", "est_id", "ciu_id", $id);
			$dataForm['sed_id'] = $id;
			$this->load->view('headquarters_edit', $dataForm);
			$this->load->view('footer');
			
		}
}