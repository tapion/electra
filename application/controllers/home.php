<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    
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
			if($this->session->userdata('nombreUsuario') == ""){
				$this->form_validation->set_rules('usuario', 'Nombre de usuario', 'required|trim|min_length[4]');
                                $this->form_validation->set_rules('contrasena', 'Contrase&ntilde;a', 'required|trim|md5');
				
				if($this->form_validation->run() == FALSE){
					if($_POST){
	                    $mensajes = validation_errors(); 
						$dataForm['infoVista'] = $this->basics->viewMessage($mensajes, "M");
						$this->load->view('home_login', $dataForm);
		            }
					else{
						$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(1));
						$this->load->view('home_login', $dataForm);
		            }
				}
				else{
					$idUsr = $this->home_model->obtenerCampo('usuario', 
                                                'usr_id', 'usr_nombreusuario', $this->input->post('usuario'), 
                                                "est_id = 1");
					if($idUsr != ''){
                                                $pwdUsr = $this->home_model->obtenerCampo(	'usuario', 'usr_contrasena', 'usr_id', $idUsr, "est_id = 1");
                                                    //if(md5($this->encrypt->decode($pwdUsr)) == $this->input->post('contrasena')){
                                                
                                                if(md5($pwdUsr) == $this->input->post('contrasena')){
                                                	$data = array(
	                            'hora'              => date("Y-m-d h:i:s"),
	                            'cargo'             => $this->home_model->obtenerCampo("cargo", "crg_nombre", "crg_id", $this->home_model->obtenerCampo("usuario", "crg_id", "usr_id", $idUsr)),
	                            'idCargo'           => $this->home_model->obtenerCampo("usuario", "crg_id", "usr_id", $idUsr), 
	                            'nombrePilaUsuario'	=> $this->home_model->obtenerCampo("usuario", "usr_nombres", "usr_id", $idUsr)." ".$this->home_model->obtenerCampo("usuario", "usr_apellidos", "usr_id", $idUsr),                            
	                            'nombreUsuario'     => $this->input->post('usuario'),
	                            'idUsuario'         => $idUsr,
	                            'ingresado'         => TRUE
	                        );
							$dataForm = array();
							$this->session->set_userdata($data);
	                        $this->home_model->registrarLog('1', "inicio de sesion");
							$this->load->view('header');
							$this->load->view('menu');
							$this->load->view('home_inicio', $dataForm);
							$this->load->view('footer');
						}
						else{
							$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(2));
							$this->load->view('home_login', $dataForm);
						}
					}
					else{
						$dataForm['infoVista']= $this->basics->viewMessage($this->home_model->consultarMensaje(2));
						$this->load->view('home_login', $dataForm);
					}
				}
			}
			else{
				$this->load->view('header');
				$this->load->view('menu');
				$this->load->view('home_inicio');
				$this->load->view('footer');
			}
		}
		
		public function about(){
			$this->load->view('header');
			$this->load->view('menu');
			$this->load->view('home_about');
			$this->load->view('footer');
				
		}
		
		public function logout(){
            $this->home_model->registrarLog('5', "salida del sistema");
            $this->session->sess_destroy();
            redirect('/home');
        }
}

?>