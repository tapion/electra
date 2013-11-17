<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller {
    
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
			
		}
		
		public function config(){
			$this->load->view('header');
			$this->load->view('menu');
			$tableInicio = "";
			$objIndex = $this->home_model->consultarObjetoSimple("usr_id", "usr_nombreUsuario", "usuario", "", "usr_nombreusuario", "ASC");
            if($objIndex == false){
                $tableInicio.= "<tr><td colspan='3'><br><br><br>No hay información disponible para este ítem<br><br></td></tr>";                
            } 
			else{
				foreach ($objIndex as $arr1=>$arr2) {
					$tableInicio.= "<tr><td>".anchor("user/edit/".intval($arr2->codigo), img(array('src' => 'multimedia/images/edit.png', 'width' => '16', 'height' => '16','title' => 'Editar Contenido', 'border' => '0')), array('title' => 'Editar'))."</td>
										<td>".$this->home_model->obtenerCampo("estado", "est_nombre", "est_id", $this->home_model->obtenerCampo("usuario", "est_id", "usr_id", $arr2->codigo))."</td>
										<td>".$arr2->nombre."</td>
										<td>".$this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $arr2->codigo)."</td>
										<td>".$this->home_model->obtenerCampo("cargo", "crg_nombre", "crg_id", $this->home_model->obtenerCampo("usuario", "crg_id", "usr_id", $arr2->codigo))."</td>
										<td>".$this->home_model->obtenerCampo("sede", "sed_nombre", "sed_id", $this->home_model->obtenerCampo("usuario", "sed_id", "usr_id", $arr2->codigo))."</td>
									</tr>";
				}
			}           	
			$dataForm['tableData'] = $tableInicio;
			$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(17));
			$this->load->view('user_admin', $dataForm);
			$this->load->view('footer');
		}
		
		public function info($action=""){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('usr_nombres', 'Nombres', 'required|trim|min_length[4]');
            $this->form_validation->set_rules('usr_apellidos', 'Apellidos', 'required|trim|min_length[4]');
           if($this->form_validation->run() == FALSE){
            	 if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(7));	
				 }
				 else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				 }	
            }
			else{
					$this->home_model->actualizarCuentaPropia($_POST);
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(8));
				
			}
			$dataForm['nombreUsuario'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $this->session->userdata('idUsuario')));
			$dataForm['apellidosUsuario'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $this->session->userdata('idUsuario')));
			$dataForm['cPersonalUsuario'] = $this->home_model->obtenerCampo("usuario", "usr_correoPersonal", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['cCorporativoUsuario'] = $this->home_model->obtenerCampo("usuario", "usr_correoCorporativo", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['loginUsuario'] = $this->home_model->obtenerCampo("usuario", "usr_nombreUsuario", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['telefonoUsuario'] = $this->home_model->obtenerCampo("usuario", "usr_extensionTelefono", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['sedeUsuario'] = array('1'  =>  $this->home_model->obtenerCampo("sede", "sed_nombre", "sed_id", $this->home_model->obtenerCampo("usuario", "sed_id", "usr_id", $this->session->userdata('idUsuario'))));
			$dataForm['estadoUsuario'] = array('1'  =>  'Activo');
			$dataForm['cargoUsuario'] = array('1'  =>  $this->home_model->obtenerCampo("cargo", "crg_nombre", "crg_id", $this->home_model->obtenerCampo("usuario", "crg_id", "usr_id", $this->session->userdata('idUsuario'))));
			$dataForm['generoUsuario'] = array('1'  => 'Masculino', '2'    => 'Femenino');
			$dataForm['generoUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "gen_id", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['ciudadDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['cNacimientoUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "ciu_idnacimiento", "usr_id", $this->session->userdata('idUsuario'));
			$dataForm['cResidenciaUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "ciu_idresidencia", "usr_id", $this->session->userdata('idUsuario'));
			
			$this->load->view('user_informacion', $dataForm);
			$this->load->view('footer');
		}
		
		public function changepwd(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('oldpwd', 'Nombre de usuario', 'required|md5|trim|min_length[4]');
            $this->form_validation->set_rules('newpwd', 'Contrasena', 'required|trim|md5|min_length[8]');
            $this->form_validation->set_rules('renewpwd', 'Nueva Contrasena', 'required|trim|md5|min_length[8]');
            if($this->form_validation->run() == FALSE){
	            if($this->input->post('enviar') == ""){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(3));	
				}
				else{
					$mensajes = validation_errors(); 
					$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
				}	
            }
			else{
				if($this->input->post('newpwd') != $this->input->post('renewpwd')){
					$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(5));	
				}
				else{
					if(($this->input->post('oldpwd')) != $this->encrypt->decode($this->home_model->obtenerCampo("usuario", "usr_contrasena", "usr_id", $this->session->userdata('idUsuario')))){
						$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(4));
					}
					else{
						$this->home_model->cambioPWD($this->encrypt->encode($this->input->post('newpwd')));
						$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(6));						
					}
				}
			}
			
			
			$this->load->view('user_cambiarContrasena', $dataForm);
			$this->load->view('footer');
		}

		public function newItem(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('usr_nombres', 'Nombres Completos', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('usr_apellidos', 'Apellidos Completos', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('usr_nombreusuario', 'Nombre de Usuario', 'required|trim|min_length[3]');
            $this->form_validation->set_rules('usr_fechaingreso', 'Fecha de Ingreso', 'required|trim|min_length[3]');
			$dataForm['ciudadDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['estadoCivilDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarEstadosCiviles());
			$dataForm['sedeDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarSedes());
			$dataForm['cargoDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarCargos());
			$dataForm['generoUsuario'] = array('1'  => 'Masculino', '2'    => 'Femenino');
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
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
				redirect('/user/edit/'.$this->home_model->actualizarUsuario($_POST));
			}
			$this->load->view('user_new', $dataForm);
			$this->load->view('footer');
            
		}

		public function edit($id=""){
			if($id==""){
				$id = $this->input->post("usr_id");
			}
			if(	$this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", intval($id)) == ""){
				redirect('user/config');
			}
			$this->load->view('header');
			$this->load->view('menu');
			$this->form_validation->set_rules('usr_nombres', 'Nombres Completos', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('usr_apellidos', 'Apellidos Completos', 'required|trim|min_length[3]');
			$this->form_validation->set_rules('usr_nombreusuario', 'Nombre de Usuario', 'required|trim|min_length[3]');
            $this->form_validation->set_rules('usr_fechaingreso', 'Fecha de Ingreso', 'required|trim|min_length[3]');
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
				$this->home_model->actualizarUsuario($_POST);
			}
			$dataForm['usr_nombres'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $id));
			$dataForm['usr_apellidos'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $id));
			$dataForm['usr_nombreusuario'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_nombreusuario", "usr_id", $id));
			$dataForm['usr_contrasena'] = "";
			$dataForm['usr_fechaingreso'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_fechaingreso", "usr_id", $id));
			$dataForm['usr_fecharetiro'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_fecharetiro", "usr_id", $id));
			$dataForm['usr_correopersonal'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_correopersonal", "usr_id", $id));
			$dataForm['usr_correocorporativo'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_correocorporativo", "usr_id", $id));
			$dataForm['usr_telefonofijo'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_telefonofijo", "usr_id", $id));
			$dataForm['usr_telefonocelular'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_telefonocelular", "usr_id", $id));
			$dataForm['usr_direccionresidencia'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_direccionresidencia", "usr_id", $id));
			$dataForm['usr_extensiontelefono'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_extensiontelefono", "usr_id", $id));
			$dataForm['usr_imagen'] = utf8_decode($this->home_model->obtenerCampo("usuario", "usr_imagen", "usr_id", $id));
			$dataForm['ciudadDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarCiudades());
			$dataForm['estadoCivilDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarEstadosCiviles());
			$dataForm['estadoCivilDisponiblePredef'] = $this->home_model->obtenerCampo("usuario", "ecv_id", "usr_id", $id);
			$dataForm['sedeDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarSedes());
			$dataForm['cargoDisponible'] = $this->basics->cargarOpcion($this->home_model->consultarCargos());
			$dataForm['cargoDisponiblePredef'] = $this->home_model->obtenerCampo("usuario", "crg_id", "usr_id", $id);
			$dataForm['sedeDisponiblePredef'] = $this->home_model->obtenerCampo("usuario", "sed_id", "usr_id", $id);
			$dataForm['cNacimientoUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "ciu_idnacimiento", "usr_id", $id);
			$dataForm['cResidenciaUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "ciu_idresidencia", "usr_id", $id);
			$dataForm['generoUsuario'] = array('1'  => 'Masculino', '2'    => 'Femenino');
			$dataForm['generoUsuarioPredef'] = $this->home_model->obtenerCampo("usuario", "gen_id", "usr_id", $id);
			$dataForm['estadoActivo'] = array("1" => "Activo", "2" => "Inactivo");
			$dataForm['estadoActivoPredef'] = $this->home_model->obtenerCampo("usuario", "est_id", "usr_id", $id);
			$dataForm['usr_id'] = $id;
			$this->load->view('user_edit', $dataForm);
			$this->load->view('footer');
			
		}
}