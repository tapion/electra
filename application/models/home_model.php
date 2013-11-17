<?php

class Home_model extends CI_Model {

    function __construct() {
        parent::__construct();
		$this->load->library('encrypt');
    }

    function consultarObjetoSimple($id, $campo, $tabla, $where="", $orderField="", $order="ASC") {
        $this->db->select("CAST(".$id . " AS TEXT) as Codigo, CAST(" . $campo . " AS TEXT) as Nombre");
        $this->db->from("$tabla");
        if ($where != "") {
            $this->db->where($where);
        }
        if ($orderField == "") {
            $orderField = $id;
        } else {
            $orderField = $orderField;
        }
        $this->db->order_by($orderField, $order);
        $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
    }
	
	function obtenerSecciones($tmn=1, $idpadre=0){
		$this->db->select("men.men_id as id");
		$this->db->select("men.tmn_id as tipomenu");
		$this->db->select("men.men_nombre as nombre");
		$this->db->select("men.men_vinculo as vinculo");
		$this->db->select("men.men_idpadre as idpadre");
		$this->db->select("men.men_imagen as imagen");
		$this->db->from("menu men");
		$this->db->from("permisocargo pcg"); 
		$this->db->where("pcg.men_id = men.men_id");
		$this->db->where("men.tmn_id = '".$tmn."'");
		$this->db->where("men.men_idpadre = '".$idpadre."'");
		$this->db->where("men.est_id = '1'");
		$this->db->where("pcg.crg_id = '".$this->session->userdata('idCargo')."'");
		$this->db->order_by("men.men_orden");
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function registrarFormatoSoporte($form){
			$data = array(
						"evs_sitio" => $form['evs_sitio'],
						"evs_horainicio" => $form['evs_horainicio'],
						"evs_horafin" => $form['evs_horafin'],
						"evs_descripcion" => $form['evs_descripcion'],
						"cli_id" => $form['cli_id'],
						"fev_id" => $form['fev_id'],
						"ciu_id" => $form['ciu_id'],
						"usr_idregistro" => $this->session->userdata('idUsuario'),
						"evs_telefono" => $form['evs_telefono'],
						"evs_contacto" => $form['evs_contacto'],
						"evs_fechasoporte" => $form['evs_fechasoporte'],
						"evs_notaformato" => $form['evs_notaformato'],
						"evs_codigonegocio" => $form['evs_codigonegocio'],
						"evs_notaselectro" => $form['evs_notaselectro'],
						"evs_notascliente" => $form['evs_notascliente']
					);
		$this->db->insert('evidenciasoporte', $data);
		$indFormato = $this->obtenerCampo("evidenciasoporte", "evs_id", "evs_sitio", $form["evs_sitio"], 
			"evs_horainicio = '".$form['evs_horainicio']."' AND evs_horafin = '".$form['evs_horafin']."' AND 
			evs_descripcion = '".$form['evs_descripcion']."' AND cli_id = '".$form['cli_id']."' AND
			fev_id = '".$form['fev_id']."' AND ciu_id = '".$form['ciu_id']."' AND usr_idregistro = '".$this->session->
			userdata('idUsuario')."' AND evs_telefono = '".$form['evs_telefono']."' AND evs_contacto = '".
			$form['evs_contacto']."' AND evs_fechasoporte = '".$form['evs_fechasoporte']."' AND 
			evs_notaformato = '".$form['evs_notaformato']."' AND evs_codigonegocio = '".$form['evs_codigonegocio']."' AND 
			evs_notaselectro = '".$form['evs_notaselectro']."' AND evs_notascliente = '".$form['evs_notascliente']."'");
		$actividadFormato = $this->consultarObjetoSimple(	"aev_id", "aev_nombre", "actividadevidencia", 
									"est_id = 1 AND fev_id = '".$form['fev_id']."'", "aev_orden", "ASC");
		foreach ($actividadFormato as $arr1=>$arr2) {
			$id = "idAct".$arr2->codigo;
			$tx = "txtAct".$arr2->codigo;
			$detalle = array(
				"evs_id" => $indFormato,
				"fev_id" => $form['fev_id'],
				"aev_id" => $arr2->codigo,
				"eas_id" => $form[$id],
				"asp_comentario" => $form[$tx]
			);
			$this->db->insert('actividadsoporte', $detalle);
		}
	}
		
	function consultarFormatosSoporte(){
		$this->db->select("fev.fev_id as Codigo");
		$this->db->select("(fev.fev_codigo||' - '||fev.fev_nombre) as Nombre");
		$this->db->from('formatoevidencia fev');
		$this->db->where("fev.est_id = 1");
		$this->db->order_by('fev.fev_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarPaises(){
		$this->db->select("pai.pai_id as Codigo");
		$this->db->select("pai.pai_nombre as Nombre");
		$this->db->from('pais pai');
		$this->db->where("pai.est_id = 1");
		$this->db->order_by('pai.pai_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
        
        function consultarEstadosOFC($nroOferta){
            $this->db->select("eof.eof_id as codigo");
            $this->db->select("eof.eof_nombre as nombre");
            $this->db->from('reglaestadosoferta reo');
            $this->db->from('estadooferta eof');
            $this->db->from('ofertacomercial ofc');
            $this->db->where("eof.eof_id = reo.eof_idnvo");
            $this->db->where("reo.eof_idant = ofc.eof_id");
            $this->db->where("ofc_id = $nroOferta");
            $this->db->order_by('eof.eof_nombre');
            $query = $this->db->get();
            if ($query->num_rows() >= 1) {
                return $query->result();
            } else {
                return false;
            }
        }
	
	function consultarSedes(){
		$this->db->select("sed.sed_id as Codigo");
		$this->db->select("sed.sed_nombre as Nombre");
		$this->db->from('sede sed');
		$this->db->where("sed.est_id = 1");
		$this->db->order_by('sed.sed_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarCargos(){
		$this->db->select("crg.crg_id as Codigo");
		$this->db->select("crg.crg_nombre as Nombre");
		$this->db->from('cargo crg');
		$this->db->where("crg.est_id = 1");
		$this->db->order_by('crg.crg_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}

	function consultarEstadosCiviles(){
		$this->db->select("ecv.ecv_id as Codigo");
		$this->db->select("ecv.ecv_nombre as Nombre");
		$this->db->from('estadocivil ecv');
		//$this->db->where("ecv.est_id = 1");
		$this->db->order_by('ecv.ecv_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarLineasComercialesVigentes(){
		$this->db->select("lcm_id as Codigo");
		$this->db->select("lcm_nombre as Nombre");
		$this->db->from('lineacomercial');
		$this->db->where("est_id = '1'");
		$this->db->order_by('lcm_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarEstadosActividad(){
		$this->db->select("eas_id as Codigo");
		$this->db->select("eas_nombre as Nombre");
		$this->db->from('estadoactividadsoporte');
		$this->db->where("est_id = '1'");
		$this->db->order_by('eas_id', "ASC");
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarIncotermsVigentes($dsc=""){
		$this->db->select("inc_id as Codigo");
		if($dsc != ""){
			$this->db->select("inc_abreviatura ||' - '|| inc_nombre as Nombre");	
		}
		else{
			$this->db->select("inc_abreviatura as Nombre");
		}
		$this->db->from('incoterm');
		$this->db->where("est_id = '1'");
		$this->db->order_by('inc_abreviatura');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarFormaPagoVigente($dsc=""){
		$this->db->select("fpg_id as Codigo");
		$this->db->select("fpg_nombre as Nombre");	
		$this->db->from('formapago');
		$this->db->where("est_id = '1'");
		$this->db->order_by('fpg_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarSectorProductivo(){
		$this->db->select("spr_id as Codigo");
		$this->db->select("spr_nombre as Nombre");	
		$this->db->from('sectorproduccion');
		$this->db->where("est_id = '1'");
		$this->db->order_by('spr_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarEjecutivoVentaVigente(){
		$this->db->select("ev.evt_id as Codigo");
		$this->db->select("us.usr_nombres || ' ' || us.usr_apellidos || ' - ' || lc.lcm_nombre || '' as Nombre");	
		$this->db->from("ejecutivoventa ev");
		$this->db->from("usuario us");
		$this->db->from("lineacomercial lc");
		$this->db->where("ev.est_id = '1'");
		$this->db->where("us.usr_id = ev.usr_id");
		$this->db->where("lc.lcm_id = ev.lcm_id");
		
		
		$this->db->order_by('us.usr_nombres');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarObservacionesVigentes($dsc=""){
		$this->db->select("obs_id as Codigo");
		$this->db->select("obs_detalle as Nombre");	
		$this->db->from('observacion');
		$this->db->where("est_id = '1'");
		$this->db->order_by('obs_detalle');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}

	function consultarClientesVigentes($dsc=""){
		$this->db->select("cli_id as Codigo");
		$this->db->select("cli_nombrecomercial || ' (' || cli_nui ||')' as Nombre");	
		$this->db->from('cliente');
		$this->db->where("est_id = '1'");
		$this->db->order_by('cli_nombrecomercial');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarClientesVigentesSimple($dsc=""){
		$this->db->select("cli_id as Codigo");
		$this->db->select("cli_nombrecomercial as Nombre");	
		$this->db->from('cliente');
		$this->db->where("est_id = '1'");
		$this->db->order_by('cli_nombrecomercial');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarContactosVigentes($cliID=""){
		$this->db->select("cli_id as Codigo");
		$this->db->select("ccl_nombre || ' (' || ccl_cargo ||')' as nombre");	
		$this->db->from('contactocliente');
		$this->db->where("est_id = '1'");
		$this->db->where("cli_id", $cliID);
		$this->db->order_by('ccl_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarContactosVigentesEstandar(){
		$this->db->select("ccl.ccl_id as Codigo");
		$this->db->select("cli.cli_nombrecomercial || ' - ' || ccl.ccl_nombre || ' (' || ccl.ccl_cargo ||')' as nombre");	
		$this->db->from('contactocliente ccl');
		$this->db->from('cliente cli');
		$this->db->where("ccl.est_id = '1'");
		$this->db->where("cli.est_id = '1'");
		$this->db->where("cli.cli_id = ccl.cli_id");
		$this->db->order_by('nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarListasPreciosVigentes(){
		$this->db->select("lpr_id as Codigo");
		$this->db->select("lpr_abreviatura as nombre");	
		$this->db->from('listaprecio');
		$this->db->where("est_id = '1'");
		$this->db->order_by('nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
		
	}
	
	
	function consultarContactosVigentesJSON($cliID=""){
		$sql=	$this->db->select("ccl_id as codigo")
			   	->select("ccl_nombre || ' (' || ccl_cargo ||')' as nombre")
				->where("cli_id", $cliID)
				->where("est_id", '1')
				->order_by('ccl_nombre')
				->get('contactocliente');
		foreach ($sql->result_array() as $reg) {
			$data[$reg['codigo']] = $reg['nombre'];
		}
		echo json_encode($data);

	}
	
	function consultarDepartamentos(){
		$this->db->select("dep.dep_id as Codigo");
		$this->db->select("(dep.dep_nombre ||' ('||pai.pai_nombre||')') as Nombre");
		$this->db->from('departamento dep');
		$this->db->from('pais pai');
		$this->db->where("dep.pai_id = pai.pai_id");
		$this->db->where("dep.est_id = 1");
		$this->db->order_by('dep.dep_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function consultarUsuariosVigentes(){
		$this->db->select("usr.usr_id as Codigo");
		$this->db->select("(usr.usr_nombres ||' '||usr.usr_apellidos||' ('||crg.crg_nombre||')') as Nombre");
		$this->db->from('usuario usr');
		$this->db->from('cargo crg');
		$this->db->where("usr.crg_id = crg.crg_id");
		$this->db->where("usr.est_id = 1");
		$this->db->order_by('usr.usr_nombres');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
	
	function actualizarCliente($form){
		
		if($form['cli_id'] == ""){
			$this->db->select("MAX(cli_id) as maximo");
			$this->db->from("cliente");
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				"tid_id" => $form["tid_id"],
			    "cli_nui" => $form["cli_nui"],
			    "est_id" => $form["est_id"],
			    "cli_nombrecomercial" => $form["cli_nombrecomercial"],
			    "cli_razonsocial" => $form["cli_razonsocial"],
			    "spr_id" => $form["spr_id"],
			    "cli_direccionprincipal" => $form["cli_direccionprincipal"],
			    "cli_direccioncorrespondencia" => $form["cli_direccioncorrespondencia"],
			    "ciu_id" => $form["ciu_id"],
			    "cli_representantelegal" => $form["cli_representantelegal"],
			    "cli_paginaweb" => $form["cli_paginaweb"],
			    "cli_telefonoprincipal" => $form["cli_telefonoprincipal"],
			    "cli_telefonoauxiliar" => $form["cli_telefonoauxiliar"],
			    "cli_correoprincipal" => $form["cli_correoprincipal"],
			    "cli_correoauxiliar" => $form["cli_correoauxiliar"],
			    "cli_observaciones" => $form["cli_observaciones"],
			    "cli_id" => $retorno);
			$this->db->insert('cliente', $data);
			$this->registrarLog("8", "Registro informacion del cliente ".$retorno);
		}
		else{
			$data = array(
				"tid_id" => $form["tid_id"],
			    "cli_nui" => $form["cli_nui"],
			    "est_id" => $form["est_id"],
			    "cli_nombrecomercial" => $form["cli_nombrecomercial"],
			    "cli_razonsocial" => $form["cli_razonsocial"],
			    "spr_id" => $form["spr_id"],
			    "cli_direccionprincipal" => $form["cli_direccionprincipal"],
			    "cli_direccioncorrespondencia" => $form["cli_direccioncorrespondencia"],
			    "ciu_id" => $form["ciu_id"],
			    "cli_representantelegal" => $form["cli_representantelegal"],
			    "cli_paginaweb" => $form["cli_paginaweb"],
			    "cli_telefonoprincipal" => $form["cli_telefonoprincipal"],
			    "cli_telefonoauxiliar" => $form["cli_telefonoauxiliar"],
			    "cli_correoprincipal" => $form["cli_correoprincipal"],
			    "cli_correoauxiliar" => $form["cli_correoauxiliar"],
			    "cli_observaciones" => $form["cli_observaciones"]);
				$this->db->where('cli_id', $form['cli_id']);
				$this->db->update('cliente', $data);
				$this->registrarLog("8", "Actualizo informacion del cliente ".$form['cli_id']);
				$retorno = $form['cli_id'];
		}
		return $retorno;
	}
	
	function agregarContactoCliente($dataForm){
		$data = array(
					"cli_id" => $dataForm['cli_id'],
				    "ccl_nombre" => $dataForm['ccl_nombre'],
				    "ccl_cargo" => $dataForm['ccl_cargo'],
				    "ccl_telefono" => $dataForm['ccl_telefono'],
				    "ccl_correo" => $dataForm['ccl_correo'],
				    "lcm_id" => $dataForm['lcm_idC'],
				    "ciu_id" => $dataForm['ciu_idC'],
				    "est_id" => $dataForm['est_idC'],
				    "ccl_fecharegistro" => date("Y-m-d H:i:s")
					);
		$this->db->insert('contactocliente', $data);
		$this->registrarLog("8", "Agrego Contacto del cliente ".$dataForm['cli_id']);
		return $dataForm['cli_id'];
	}
	
	function actualizarContactoCliente($dataForm){
		$data = array(
					"cli_id" => $dataForm['cli_id'],
				    "ccl_nombre" => $dataForm['ccl_nombre'],
				    "ccl_cargo" => $dataForm['ccl_cargo'],
				    "ccl_telefono" => $dataForm['ccl_telefono'],
				    "ccl_correo" => $dataForm['ccl_correo'],
				    "lcm_id" => $dataForm['lcm_idC'],
				    "ciu_id" => $dataForm['ciu_idC'],
				    "est_id" => $dataForm['est_idC'],
				    "ccl_fecharegistro" => date("Y-m-d H:i:s")
					);
		$this->db->where('ccl_id', $dataForm['ccl_id']);
		$this->db->update('contactocliente', $data);
		
		$this->registrarLog("8", "Actualizo Contacto del cliente ".$dataForm['cli_id']);
		return $dataForm['cli_id'];
	}
	
	function consultarCiudades(){
		$this->db->select("ciu.ciu_id as Codigo");
		$this->db->select("(ciu.ciu_nombre ||' - '|| dep.dep_nombre ||' - '||pai.pai_nombre||'') as Nombre");
		$this->db->from('ciudad ciu');
		$this->db->from('departamento dep');
		$this->db->from('pais pai');
		$this->db->where("ciu.dep_id = dep.dep_id");
		$this->db->where("dep.pai_id = pai.pai_id");
		$this->db->where("ciu.est_id = 1");
		$this->db->order_by('ciu.ciu_nombre');
		$query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return false;
        }
	}
        
        function consultarLineaMayoritaria(){
            $this->db->select("lc.lcm_id as Codigo");
            $this->db->select("lc.lcm_nombre as Nombre");
            $this->db->from("ejecutivoventa ev, lineacomercial lc");
            $this->db->where("lc.lcm_id = ev.lcm_id");
            $this->db->where("ev.usr_id = '".$this->session->userdata('idUsuario')."'"); 
            $this->db->where("ev.est_id = 1");
            $this->db->where("lc.est_id = 1");
            $this->db->order_by("lc.lcm_nombre");
            $query = $this->db->get();
            if ($query->num_rows() >= 1) {
                return $query->result();
            } else {
                return false;
            }
	}
    
    function consultarMensaje($idMensaje="", $textoMensaje="") {
		$this->db->select('tm.tmj_estilo, tm.tmj_icono, tm.tmj_abreviatura, m.msj_descripcion');
        $this->db->from('mensaje m, tipomensaje tm');
        $this->db->where("m.msj_id = '" . $idMensaje . "'");
        $this->db->where("m.tmj_id = tm.tmj_id");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    function registrarLog($tipoMovimiento, $qry="") {
        $data = array('usr_id' => $this->session->userdata('idUsuario'), 'log_ip' => $this->session->userdata('ip_address'),
            'tmv_id' => $tipoMovimiento, 'log_url' => base_url() . uri_string(), 'log_fechahora' => date("Y-m-d H:i:s"), 
			'log_agente' => $this->session->userdata('user_agent'), 'log_descripcion' => $qry);
        $this->db->insert('log', $data);
    }
    
    function cambioPWD($pwd) {

        $data = array('usr_contrasena' => $pwd);
        $this->db->where('usr_id', $this->session->userdata('idUsuario'));
        $this->db->update('usuario', $data);
        $this->registrarLog("8", "Cambio de Clave");
    }
	
	function actualizarPais($cambios){
		if($cambios['pai_id'] == ""){
			$this->db->select("MAX(pai_id) as maximo");
			$this->db->from('pais');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'pai_nombre' => $cambios['pai_nombre'],
				'est_id' => $cambios['est_id'],
				'pai_abreviatura' => $cambios['pai_abreviatura'],
				'pai_abreviatura2' => $cambios['pai_abreviatura2'],
				'pai_id' => $retorno
			);
			$this->db->insert('pais', $data);
			$this->registrarLog("8", "Registro informacion del Pais ".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'pai_nombre' => $cambios['pai_nombre'],
				'est_id' => $cambios['est_id'],
				'pai_abreviatura' => $cambios['pai_abreviatura'],
				'pai_abreviatura2' => $cambios['pai_abreviatura2']
			);
			$this->db->where('pai_id', $cambios['pai_id']);
			$this->db->update('pais', $data);
			$this->registrarLog("8", "Actualizo informacion del pais ".$cambios['pai_id']);
		}
	}

	function actualizarFormaPago($cambios){
		if($cambios['fpg_id'] == ""){
			$this->db->select("MAX(fpg_id) as maximo");
			$this->db->from('formapago');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'fpg_nombre' => $cambios['fpg_nombre'],
				'est_id' => $cambios['est_id'],
				'fpg_abreviatura' => $cambios['fpg_abreviatura'],
				'fpg_id' => $retorno
			);
			$this->db->insert('formapago', $data);
			$this->registrarLog("8", "Registro informacion de la Forma de Pago ".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'fpg_nombre' => $cambios['fpg_nombre'],
				'est_id' => $cambios['est_id'],
				'fpg_abreviatura' => $cambios['fpg_abreviatura']
			);
			$this->db->where('fpg_id', $cambios['fpg_id']);
			$this->db->update('formapago', $data);
			$this->registrarLog("8", "Actualizo informacion de la Forma de Pago ".$cambios['fpg_id']);
		}
	}

	function actualizarUsuario($cambios){
		if($cambios['usr_id'] == ""){
			$contrasena = $this->encrypt->encode($cambios['usr_contrasena']);
			$this->db->select("MAX(usr_id) as maximo");
			$this->db->from('usuario');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'usr_nombres' => $cambios['usr_nombres'],
				'usr_apellidos' => $cambios['usr_apellidos'],
				'ciu_idnacimiento' => $cambios['ciu_idnacimiento'],
				'ciu_idresidencia' => $cambios['ciu_idresidencia'],
				'gen_id' => $cambios['gen_id'],
				'ecv_id' => $cambios['ecv_id'],
				'usr_direccionresidencia' => $cambios['usr_direccionresidencia'],
				'usr_telefonofijo' => $cambios['usr_telefonofijo'],
				'usr_telefonocelular' => $cambios['usr_telefonocelular'],
				'usr_extensiontelefono' => $cambios['usr_extensiontelefono'],
				'usr_correopersonal' => $cambios['usr_correopersonal'],
				'usr_correocorporativo' => $cambios['usr_correocorporativo'],
				'sed_id' => $cambios['sed_id'],
				'usr_nombreusuario' => $cambios['usr_nombreusuario'],
				'usr_contrasena' => $contrasena,
				'usr_fechaingreso' => $cambios['usr_fechaingreso'],
				'usr_fecharetiro' => $cambios['usr_fechaingreso'],
				'crg_id' => $cambios['crg_id'],
				'est_id' => $cambios['est_id'],
				//'usr_imagen' => $cambios['usr_imagen'], 
				'usr_id' => $retorno
			);
			$this->db->insert('usuario', $data);
			$this->registrarLog("8", "Registro informacion del Usuario ".$retorno);
			return $retorno;	
		}
		else{
			if(trim($cambios['usr_contrasena']) != ''){
				$contrasena = $this->encrypt->encode($cambios['usr_contrasena']);
				$data = array(
					'usr_nombres' => $cambios['usr_nombres'],
					'usr_apellidos' => $cambios['usr_apellidos'],
					'ciu_idnacimiento' => $cambios['ciu_idnacimiento'],
					'ciu_idresidencia' => $cambios['ciu_idresidencia'],
					'gen_id' => $cambios['gen_id'],
					'ecv_id' => $cambios['ecv_id'],
					'usr_direccionresidencia' => $cambios['usr_direccionresidencia'],
					'usr_telefonofijo' => $cambios['usr_telefonofijo'],
					'usr_telefonocelular' => $cambios['usr_telefonocelular'],
					'usr_extensiontelefono' => $cambios['usr_extensiontelefono'],
					'usr_correopersonal' => $cambios['usr_correopersonal'],
					'usr_correocorporativo' => $cambios['usr_correocorporativo'],
					'sed_id' => $cambios['sed_id'],
					'crg_id' => $cambios['crg_id'],
					'usr_nombreusuario' => $cambios['usr_nombreusuario'],
					'usr_contrasena' => $contrasena,
					'usr_fechaingreso' => $cambios['usr_fechaingreso'],
					'usr_fecharetiro' => $cambios['usr_fechaingreso'],
					'est_id' => $cambios['est_id']
					//'usr_imagen' => $cambios['usr_imagen']
				);
			}
			else{
				$data = array(
					'usr_nombres' => $cambios['usr_nombres'],
					'usr_apellidos' => $cambios['usr_apellidos'],
					'ciu_idnacimiento' => $cambios['ciu_idnacimiento'],
					'ciu_idresidencia' => $cambios['ciu_idresidencia'],
					'gen_id' => $cambios['gen_id'],
					'ecv_id' => $cambios['ecv_id'],
					'usr_direccionresidencia' => $cambios['usr_direccionresidencia'],
					'usr_telefonofijo' => $cambios['usr_telefonofijo'],
					'usr_telefonocelular' => $cambios['usr_telefonocelular'],
					'usr_extensiontelefono' => $cambios['usr_extensiontelefono'],
					'usr_correopersonal' => $cambios['usr_correopersonal'],
					'usr_correocorporativo' => $cambios['usr_correocorporativo'],
					'sed_id' => $cambios['sed_id'],
					'crg_id' => $cambios['crg_id'],
					'usr_nombreusuario' => $cambios['usr_nombreusuario'],
					'usr_fechaingreso' => $cambios['usr_fechaingreso'],
					'usr_fecharetiro' => $cambios['usr_fechaingreso'],
					'est_id' => $cambios['est_id'],
					'usr_imagen' => $cambios['usr_imagen']
				);
			}
			$this->db->where('usr_id', $cambios['usr_id']);
			$this->db->update('usuario', $data);
			$this->registrarLog("8", "Actualizo informacion del usuario ".$cambios['usr_id']);	
		}
	}

	function actualizarSede($cambios){
		if($cambios['sed_id'] == ""){
			$this->db->select("MAX(sed_id) as maximo");
			$this->db->from('sede');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'sed_nombre' => $cambios['sed_nombre'],
				'est_id' => $cambios['est_id'],
				'ciu_id' => $cambios['ciu_id'],
				'sed_idsupervisor' => $cambios['usr_idSupervisor'],
				'sed_direccion' => $cambios['sed_direccion'],
				'sed_telefono' => $cambios['sed_telefono'],
				'sed_fax' => $cambios['sed_fax'],
				'sed_correocorporativo' => $cambios['sed_correocorporativo'],
				'sed_paginaweb' => $cambios['sed_paginaweb'],
				'sed_id' => $retorno
			);
			$this->db->insert('sede', $data);
			$this->registrarLog("8", "Registro informacion de la Sede ".$retorno);
			return $retorno;	
		}
		else{
			$data = array(
				'sed_nombre' => $cambios['sed_nombre'],
				'est_id' => $cambios['est_id'],
				'ciu_id' => $cambios['ciu_id'],
				'sed_idsupervisor' => $cambios['usr_idSupervisor'],
				'sed_direccion' => $cambios['sed_direccion'],
				'sed_telefono' => $cambios['sed_telefono'],
				'sed_fax' => $cambios['sed_fax'],
				'sed_correocorporativo' => $cambios['sed_correocorporativo'],
				'sed_paginaweb' => $cambios['sed_paginaweb']
			);
			$this->db->where('sed_id', $cambios['sed_id']);
			$this->db->update('sede', $data);
			$this->registrarLog("8", "Actualizo informacion de la sede ".$cambios['sed_id']);		
		}
	}

	function actualizarDepartamento($cambios){
		if($cambios['dep_id'] == ""){
			$this->db->select("MAX(dep_id) as maximo");
			$this->db->from('departamento');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'pai_id' => $cambios['pai_id'],
				'est_id' => $cambios['est_id'],
				'dep_abreviatura' => $cambios['dep_abreviatura'],
				'dep_nombre' => $cambios['dep_nombre'],
				'dep_id' => $retorno
			);
			$this->db->insert('departamento', $data);
			$this->registrarLog("8", "Registro informacion del departamento ".$retorno);
			return $retorno;	
		}
		else{
			$data = array(
			'pai_id' => $cambios['pai_id'],
			'est_id' => $cambios['est_id'],
			'dep_abreviatura' => $cambios['dep_abreviatura'],
			'dep_nombre' => $cambios['dep_nombre']
			);
			$this->db->where('dep_id', $cambios['dep_id']);
			$this->db->update('departamento', $data);
			$this->registrarLog("8", "Actualizo informacion del departamento ".$cambios['dep_id']);	
		}
	}
	
	function actualizarCiudad($cambios){
		if($cambios['ciu_id'] == ""){
			$this->db->select("MAX(ciu_id) as maximo");
			$this->db->from('ciudad');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'dep_id' => $cambios['dep_id'],
				'est_id' => $cambios['est_id'],
				'ciu_abreviatura' => $cambios['ciu_abreviatura'],
				'ciu_nombre' => $cambios['ciu_nombre'],
				'ciu_id' => $retorno
			);
			$this->db->insert('ciudad', $data);
			$this->registrarLog("8", "Registro informacion de la Ciudad ".$retorno);
			return $retorno;	
		}
		else{
			$data = array(
				'dep_id' => $cambios['dep_id'],
				'est_id' => $cambios['est_id'],
				'ciu_abreviatura' => $cambios['ciu_abreviatura'],
				'ciu_nombre' => $cambios['ciu_nombre']
			);
			$this->db->where('ciu_id', $cambios['ciu_id']);
			$this->db->update('ciudad', $data);
			$this->registrarLog("8", "Actualizo informacion de la ciudad ".$cambios['ciu_id']);	
		}
	}

	function actualizarIncoterm($cambios){
		if($cambios['inc_id'] == ""){
			$this->db->select("MAX(inc_id) as maximo");
			$this->db->from('incoterm');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'inc_abreviatura' => $cambios['inc_abreviatura'],
				'est_id' => $cambios['est_id'],
				'inc_nombre' => $cambios['inc_nombre'],
				'inc_id' => $retorno
			);
			$this->db->insert('incoterm', $data);
			$this->registrarLog("8", "Registro informacion del INCOTERM ".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'inc_abreviatura' => $cambios['inc_abreviatura'],
				'est_id' => $cambios['est_id'],
				'inc_nombre' => $cambios['inc_nombre']
			);
			$this->db->where('inc_id', $cambios['inc_id']);
			$this->db->update('incoterm', $data);
			$this->registrarLog("8", "Actualizo informacion del Incoterm ".$cambios['inc_id']);	
		}	
	}
	
	function actualizarObservacion($cambios){
		if($cambios['obs_id'] == ""){
			$this->db->select("MAX(obs_id) as maximo");
			$this->db->from('observacion');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'est_id' => $cambios['est_id'],
				'obs_detalle' => $cambios['obs_detalle'],
				'obs_id' => $retorno
			);
			$this->db->insert('observacion', $data);
			$this->registrarLog("8", "Registro informacion de la Observacion ".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'est_id' => $cambios['est_id'],
				'obs_detalle' => $cambios['obs_detalle']
			);
			$this->db->where('obs_id', $cambios['obs_id']);
			$this->db->update('observacion', $data);
			$this->registrarLog("8", "Actualizo informacion de la Observacion ".$cambios['obs_id']);	
		}	
	}
	
	
	function actualizarLineaContacto($cambios){
		if($cambios['lnc_id'] == ""){
			$this->db->select("MAX(lnc_id) as maximo");
			$this->db->from('lineacontacto');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'lnc_abreviatura' => $cambios['lnc_abreviatura'],
				'est_id' => $cambios['est_id'],
				'lnc_nombre' => $cambios['lnc_nombre'],
				'lnc_id' => $retorno
			);
			$this->db->insert('lineacontacto', $data);
			$this->registrarLog("8", "Registro informacion de la línea de contacto".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'lnc_abreviatura' => $cambios['lnc_abreviatura'],
				'est_id' => $cambios['est_id'],
				'lnc_nombre' => $cambios['lnc_nombre']
			);
			$this->db->where('lnc_id', $cambios['lnc_id']);
			$this->db->update('lineacontacto', $data);
			$this->registrarLog("8", "Actualizo informacion de la linea de contacto ".$cambios['lnc_id']);	
		}	
	}
        
        function actualizarProductoMasivo($data){
            $this->db->select("MAX(prd_id) as maximo");
            $this->db->from('producto');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $retorno = intval($row->maximo)+1;
            }				
            $this->db->insert('producto', $data);
            $this->registrarLog("8", "Registro informacion del Producto ".$retorno);
        }
        
        function actualizaOferta($id, $objects){
          $textTraza = "Actualizó la oferta: ";
          $estadoAnt = $this->obtenerCampo("ofertacomercial", "eof_id", "ofc_id", $id);
          if($estadoAnt == 1){
            $textTraza.= $objects['comentario'];
            $data = array(
              'eof_id' => $objects['cambioEstado']
            );
            if($objects['cambioEstado'] == "5"){
              $data = array(
                'eof_id' => $objects['cambioEstado'],
                'ofc_codigoserie' => $this->home_model->obtenerNumeroOferta($id), 
              );
            }
            $this->db->where('ofc_id', $id);
            $this->db->update('ofertacomercial', $data);
          }
          $this->registrarTrazaOferta($id, $textTraza, $estadoAnt, $objects['cambioEstado']);
        }
        
        function obtenerNumeroOferta($idOffer){
          $linea = $this->obtenerCampo("ofertacomercial", "lcm_id", "ofc_id", $idOffer);
          $prefijo = $this->obtenerCampo("lineacomercial", "lcm_abreviatura", "lcm_id", $linea);
          $ultimoReg = $this->obtenerCampo("ofertacomercial", "ofc_codigoserie", "lcm_id", $linea, "ofc_codigoserie is not null order by ofc_fecharegistro desc");
          list($pref, $nmro) = explode("-", $ultimoReg);
          return $prefijo."-".str_pad(intval($nmro)+1, 10, "0", STR_PAD_LEFT);
        }
        
        function registrarTrazaOferta($ofcid, $comment, $idAnt, $idNvo=""){
            if($idNvo == ""){
                $idNvo = $idAnt;
            }
            $data = array(
                'eof_idant' => $idAnt,
                'eof_idnvo' => $idNvo,
                'usr_idregistro' => $this->session->userdata('idUsuario'),
                'toc_comentario' => $comment,
                'ofc_id' => $ofcid
            );
            $this->db->insert('trazaofertacomercial', $data);
            $this->registrarLog("8", "Registro informacion de la trazada de la oferta comercial: ".$ofcid);
        }
        
        function registrarPreoferta($data){
            $data = array(
                'evt_id' => $this->obtenerCampo("ejecutivoventa", "evt_id", "usr_id", $this->session->userdata('idUsuario')),
                'lcm_id' => $data['lcm_id'],
                'cli_id' => $this->obtenerCampo("contactocliente", "cli_id", "ccl_id", $data['ccl_id']),
                'ccl_id' => $data['ccl_id'],
                'ofc_vigencia' => $data['ofc_vigencia'],
                'ofc_vigenciatexto' => $data['ofc_vigenciatexto'],
                'ofc_plazoentrega' => $data['ofc_plazoentrega'],
                'ofc_plazoentregatexto' => $data['ofc_plazoentregatexto'],
                'fpg_id' => $data['fpg_id'],
                'ofc_preregistro' => $data['ofc_preregistro'],
                'ciu_id' => $data['ciu_id'],
                'eof_id' => "1",
                'eof_id' => "1",
            );
            $this->db->insert('ofertacomercial', $data);
            $this->db->select("MAX(ofc_id) as maximo");
            $this->db->from('ofertacomercial');
            $query = $this->db->get();
            foreach ($query->result() as $row) {
                $retorno = intval($row->maximo);
            }				
            $this->registrarLog("8", "Registro informacion de la oferta comercial: ".$retorno);
            $this->registrarTrazaOferta($retorno, "Registro la solicitud de oferta comercial", 1);
        }
	
	function actualizarProducto($cambios){
		if($cambios['prd_id'] == ""){
			$this->db->select("MAX(prd_id) as maximo");
			$this->db->from('producto');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'est_id' => $cambios['est_id'],
				'prd_dimensiones' => $cambios['prd_dimensiones'],
				'lcm_id' => $cambios['lcm_id'],
				'prd_idpadre' => 0,
				'prd_peso' => $cambios['prd_peso'],
				'prd_foto' => "",
				'prd_nombre' => $cambios['prd_nombre'],
				'prd_titulo' => $cambios['prd_titulo'],
				'prd_codigo' => $cambios['prd_codigo'],
				'prd_id' => $retorno
			);
			$this->db->insert('producto', $data);
			$this->registrarLog("8", "Registro informacion del Producto ".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'est_id' => $cambios['est_id'],
				'prd_dimensiones' => $cambios['prd_dimensiones'],
				'lcm_id' => $cambios['lcm_id'],
				'prd_idpadre' => 0,
				'prd_peso' => $cambios['prd_peso'],
				'prd_foto' => "",
				'prd_nombre' => $cambios['prd_nombre'],
				'prd_titulo' => $cambios['prd_titulo'],
				'prd_codigo' => $cambios['prd_codigo']
			);
			$this->db->where('prd_id', $cambios['prd_id']);
			$this->db->update('producto', $data);
			$this->registrarLog("8", "Actualizo informacion del producto ".$cambios['prd_id']);
			return $cambios['prd_id'];	
		}	
	}

	function actualizarPrecio($cambios){
		$idP = "";			
		if($cambios['lpp_id'] != ""){
			$idP = $cambios['lpp_id'];
		}
		$dataAnt = array(
					'usr_idactualizacion' => $this->session->userdata('idUsuario'),
					'est_id' => '2',
					'lpp_fechaactualizacion' => date("Y-m-d H:i:s")
					);
		$this->db->where('prd_id', $cambios['prd_id']);
		$this->db->where('lpr_id', $cambios['lpr_id']);
		$this->db->update('listaprecioxproducto', $dataAnt);
					
		if($idP == ""){
			$data = array(
				'lpr_id' => $cambios['lpr_id'],
				'prd_id' => $cambios['prd_id'],
				'lpp_precio' => $cambios['lpp_precio'], 
				'est_id' => $cambios['est_id'],
				'lpp_fecharegistro' => date("Y-m-d H:i:s"),	
				'usr_idregistro' => $this->session->userdata('idUsuario')			
			);
			$this->db->insert('listaprecioxproducto', $data);
			$this->registrarLog("8", "Registro informacion de  la lista de precios ".$cambios['lpr_id']." del producto ".$cambios['prd_id']);
		}
		else{
			$data = array(
				'lpr_id' => $cambios['lpr_id'],
				'prd_id' => $cambios['prd_id'],
				'lpp_precio' => $cambios['lpp_precio'], 
				'est_id' => $cambios['est_id'],
				'lpp_fecharegistro' => date("Y-m-d H:i:s"),	
				'usr_idregistro' => $this->session->userdata('idUsuario'),
				'lpp_id' => $idP			
			);
			$this->db->where('prd_id', $cambios['prd_id']);
			$this->db->where('lpr_id', $cambios['lpr_id']);
			$this->db->update('listaprecioxproducto', $data);
			$this->registrarLog("8", "Actualizo informacion de  la lista de precios ".$cambios['lpr_id']." del producto ".$cambios['prd_id']);
			return $cambios['lpp_id'];	
		}
	}
	
	function actualizarTipoIdentificacion($cambios){
		$data = array(
			'tid_simbolo' => $cambios['tid_simbolo'],
			'est_id' => $cambios['est_id'],
			'tid_nombre' => $cambios['tid_nombre']
		);
		if($cambios['tid_id'] == ""){
			$this->db->insert('tipoidentificacion', $data);
			$this->db->select("MAX(tid_id) as maximo");
			$this->db->from('tipoidentificacion');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo);				
			}
        	$this->registrarLog("8", "Registro informacion del Tipo de Identificacion ".$retorno);
			return $retorno;
		}
		else{
			$this->db->where('tid_id', $cambios['tid_id']);
			$this->db->update('tipoidentificacion', $data);
			$this->registrarLog("8", "Actualizo informacion del Tipo de Identificacion ".$cambios['tid_id']);
		}
			
	}

	function actualizarCuentaPropia($cambios){
		$data = array(	'usr_nombres' => $cambios['usr_nombres'],
						'usr_apellidos' => $cambios['usr_apellidos'],
						'ciu_idnacimiento' => $cambios['ciu_idnacimiento'],
						'ciu_idresidencia' => $cambios['ciu_idresidencia'],
						'usr_correopersonal' => $cambios['usr_correoPersonal'],
						'gen_id' => $cambios['gen_id'],
						'usr_correocorporativo' => $cambios['usr_correoPersonal'],
						'usr_extensiontelefono' => $cambios['usr_extensionTelefono']
						);
		$this->db->where('usr_id', $this->session->userdata('idUsuario'));
        $this->db->update('usuario', $data);
        $this->registrarLog("8", "Actualizo informacion personal");
		
	}

	
	function actualizarLineaComercial($cambios){
		if($cambios['lcm_id'] == ""){
			$this->db->select("MAX(lcm_id) as maximo");
			$this->db->from('lineacomercial');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'lcm_nombre' => $cambios['lcm_nombre'],
				'lcm_descripcion' => $cambios['lcm_descripcion'],
				'lcm_historia' => $cambios['lcm_historia'],
				'lcm_productos' => $cambios['lcm_productos'],
				'lcm_campos' => $cambios['lcm_campos'],
				'est_id' => $cambios['est_id'],
				'lcm_abreviatura' => $cambios['lcm_abreviatura'],
				'lcm_id' => $retorno
			);
			$this->db->insert('lineacomercial', $data);
			$this->registrarLog("8", "Actualizo informacion de la linea comercial ".$cambios['lcm_id']);
			return $retorno;
		}
		else{
			$data = array(
				'lcm_nombre' => $cambios['lcm_nombre'],
				'lcm_descripcion' => $cambios['lcm_descripcion'],
				'lcm_historia' => $cambios['lcm_historia'],
				'lcm_productos' => $cambios['lcm_productos'],
				'lcm_campos' => $cambios['lcm_campos'],
				'est_id' => $cambios['est_id'],
				'lcm_abreviatura' => $cambios['lcm_abreviatura']
			);
			$this->db->where('lcm_id', $cambios['lcm_id']);
			$this->db->update('lineacomercial', $data);
			$this->registrarLog("8", "Actualizo informacion de la linea comercial ".$cambios['lcm_id']);
		}
	}

	function actualizarEjecutivoVenta($cambios){
		if($cambios['evt_id'] == ""){
			$this->db->select("MAX(evt_id) as maximo");
			$this->db->from('ejecutivoventa');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'lcm_id' => $cambios['lcm_id'],
				'est_id' => $cambios['est_id'],
				'usr_id' => $cambios['usr_id'],
				'evt_firma' => $cambios['evt_firma'],
				'evt_id' => $retorno
			);
			$this->db->insert('ejecutivoventa', $data);
			$this->registrarLog("8", "Registro informacion del ejecutivo de venta".$retorno);
			return $retorno;
		}
		else{
			$data = array(
				'lcm_id' => $cambios['lcm_id'],
				'est_id' => $cambios['est_id'],
				'usr_id' => $cambios['usr_id'],
				'evt_firma' => $cambios['evt_firma']
			);
			$this->db->where('evt_id', $cambios['evt_id']);
			$this->db->update('ejecutivoventa', $data);
			$this->registrarLog("8", "Actualizo informacion del ejecutivo de venta ".$cambios['evt_id']);	
		}	
	}
	
	function actualizarListaPrecios($cambios){
		if($cambios['lpr_id'] == ""){
			$this->db->select("MAX(lpr_id) as maximo");
			$this->db->from('listaprecio');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$data = array(
				'lcm_id' => $cambios['lcm_id'],
			    'inc_id' => $cambios['inc_id'],
			    'est_id' => $cambios['est_id'],
				'lpr_carcom' => $cambios['lpr_carcom'],
				'lpr_tasexp' => $cambios['lpr_tasexp'],
				'lpr_pueexp' => $cambios['lpr_pueexp'],
				'lpr_desexp' => $cambios['lpr_desexp'],
				'lpr_embexp' => $cambios['lpr_embexp'],
				'lpr_traimp' => $cambios['lpr_traimp'],
				'lpr_desimp' => $cambios['lpr_desimp'],
				'lpr_carimp' => $cambios['lpr_carimp'],
				'lpr_trades' => $cambios['lpr_trades'],
				'lpr_seguro' => $cambios['lpr_seguro'],
				'lpr_pasadu' => $cambios['lpr_pasadu'],
				'lpr_impimp' => $cambios['lpr_impimp'],
			    'lpr_id' => $retorno
	    	);
			$this->db->insert('listaprecio', $data);
			$this->registrarLog("8", "Registro informacion de la lista precio  ".$retorno);
			return $retorno;
			
		}
		else{
			$data = array(
				'lcm_id' => $cambios['lcm_id'],
			    'inc_id' => $cambios['inc_id'],
			    'est_id' => $cambios['est_id'],
				'lpr_carcom' => $cambios['lpr_carcom'],
				'lpr_tasexp' => $cambios['lpr_tasexp'],
				'lpr_pueexp' => $cambios['lpr_pueexp'],
				'lpr_desexp' => $cambios['lpr_desexp'],
				'lpr_embexp' => $cambios['lpr_embexp'],
				'lpr_traimp' => $cambios['lpr_traimp'],
				'lpr_desimp' => $cambios['lpr_desimp'],
				'lpr_carimp' => $cambios['lpr_carimp'],
				'lpr_trades' => $cambios['lpr_trades'],
				'lpr_seguro' => $cambios['lpr_seguro'],
				'lpr_pasadu' => $cambios['lpr_pasadu'],
				'lpr_impimp' => $cambios['lpr_impimp'],
			    'lpr_id' => $cambios['lpr_id']
	    	);
			$this->db->where('lpr_id', $cambios['lpr_id']);
			$this->db->update('listaprecio', $data);
			$this->registrarLog("8", "Actualizo informacion de la lista de precios ".$cambios['lpr_id']);
			return $cambios['lpr_id'];
			
		}
	}
	

    function obtenerCampo($tabla, $campo, $idComparacion, $valor, $wh="") {
    	$this->db->select("CAST($campo AS TEXT) as retorno");
        $this->db->from("$tabla");
        $this->db->where("$idComparacion = '" . $valor . "'");
		if($wh != ''){
			$this->db->where($wh);
		}
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
        	foreach ($query->result() as $row) {
                //return utf8_encode(str_replace("", ",00", str_replace("%%", "'", $row->retorno)));
				return str_replace("", ",00", str_replace("%%", "'", $row->retorno));
            }
        } else {
            return "";
        }
		
    }

	function registrarEventoComercial($form){
		
		if(trim($form['evc_id']) == ""){
			$this->db->select("MAX(evc_id) as maximo");
			$this->db->from('eventocomercial');
        	$query = $this->db->get();
        	foreach ($query->result() as $row) {
            	$retorno = intval($row->maximo)+1;				
			}
			$insert = array(
				'evc_fecharegistro' => date("Y-m-d H:i:s"),
				'evc_fechainicio' => $form['evc_fechainicio'],
				'evc_fechafin' => $form['evc_fechafin'],
				'evc_horainicio' => $form['evc_horainicio'],
				'evc_horafin' => $form['evc_horafin'],
				'cli_id' => $this->obtenerCampo("contactocliente", "cli_id", "ccl_id", $form['ccl_id']),
				'ccl_id' => $form['ccl_id'],
				'evc_tituloevento' => $form['evc_tituloevento'],
				'evc_descripcionevento' => $form['evc_descripcionevento'],
				'usr_idregistro' => $this->session->userdata('idUsuario'),
				'usr_idresponsable' => $this->session->userdata('idUsuario'),
				'evc_id' => $retorno
			);
			$this->db->insert('eventocomercial', $insert);
			$this->registrarLog("8", "Registro el evento comercial  ".$retorno);
		}
		else{
			
		}				
		
	}

    function validarUsuario($nombreUsuario) {
        $this->db->select('CAST (usr_id as varchar) as usr_id, CAST (est_id as varchar) as est_id, usr_conexionWeb, usr_contrasena');
        $this->db->from('usuario');
        $this->db->where("usr_nombreUsuario = '" . $nombreUsuario . "'");
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return 0;
        }
    }
    
	function crearOferta($datos){
    	/*
    [ser_pr1] => 1
    [cod_pr1] => GAL123
    [nom_pr1] => CELULAR SAMSUNG GALAXY ACE
    [vun_pr1] => $100.00
    [can_pr1] => 2
    [vlt_pr1] => $200.00
    [ser_pr2] => 2
    [cod_pr2] => GAL123
    [nom_pr2] => CELULAR SAMSUNG GALAXY ACE
    [vun_pr2] => $100.00
    [can_pr2] => 9
    [vlt_pr2] => $900.00
    [ser_pr3] => 3
    [cod_pr3] => GAL123
    [nom_pr3] => CELULAR SAMSUNG GALAXY ACE
    [vun_pr3] => $100.00
    [can_pr3] => 11
    [vlt_pr3] => $1,100.00
    [valores] => Array
        (
            [0] => 5
            [1] => 9
            [2] => 4
            [3] => 8
        )

    [lcm_campos] => adicionales de prueba
    [cntProd] => 4
		 * 
		 */
		 $prefijo = $this->obtenerCampo("lineacomercial", "lcm_abreviatura", "lcm_id", $this->obtenerCampo("ejecutivoventa", "lcm_id", "evt_id", $datos['evt_id']));
		 $this->db->select("MAX(ofc_codigoserie) as maximo");
			$this->db->from('ofertacomercial');
			$this->db->where("ofc_prefijo = '" . $prefijo . "'");
	    	$query = $this->db->get();
	    	foreach ($query->result() as $row) {
	        	$nuevoSerie = intval($row->maximo)+1;				
			}
		$ofertaBody = array(
			'ofc_fecharegistro' => date("Y-m-d H:i:s"),
			'ofc_codigoserie' => str_pad($nuevoSerie, 7, "0", STR_PAD_LEFT),
			'usr_idregistro' => $this->session->userdata('idUsuario'), 
			'evt_id' => $datos['evt_id'],
			'inc_id' => $datos['inc_id'],
			'lcm_id' => $this->obtenerCampo("ejecutivoventa", "lcm_id", "evt_id", $datos['evt_id']),
			'cli_id' => $this->obtenerCampo("contactocliente", "cli_id", "ccl_id", $datos['ccl_id']),
			'ccl_id' => $datos['ccl_id'],
			'ofc_valor' => str_replace(array("$", ",", ".00"), "", $datos['ofc_valor']),
			'ofc_iva' => str_replace(array("$", ",", ".00"), "", $datos['ofc_iva']),
			'ofc_total' => str_replace(array("$", ",", ".00"), "", $datos['ofc_total']),
			'ofc_vigencia' => $datos['ofc_vigencia'],
			'ofc_vigenciatexto' => $datos['ofc_vigenciatexto'],
			'fpg_id' => $datos['fpg_id'],
			'ofc_plazoentrega' => $datos['ofc_plazoentrega'],
			'ofc_plazoentregatexto' => $datos['ofc_plazoentregatexto'],
			'ofc_descuento' => $datos['ofc_descuento'],
			'ofc_comision' => $datos['ofc_comision'],
			'ofc_prefijo' => $prefijo,
			'lpr_id' => $datos['lpr_id'],
			'ciu_id' => $datos['ciu_id']);
		$this->db->insert('ofertacomercial', $ofertaBody);
		$this->registrarLog("8", "Registro una Nueva Oferta Comercial  ".$prefijo.$nuevoSerie);
		
			
	}
  
  function getSoporteActividades($formato){
    $this->db->select("acs.asp_id as codigo");
    $this->db->select("aev.aev_nombre as actividad");
    $this->db->select("eas.eas_nombre as estado");
    $this->db->select("acs.asp_comentario as comentario");
    $this->db->from("actividadsoporte acs");
    $this->db->join('actividadevidencia aev', 'aev.aev_id = acs.aev_id', 'left');
    $this->db->join('estadoactividadsoporte eas', 'eas.eas_id = acs.eas_id', 'left');                
    $this->db->where("acs.evs_id = '".intval($formato)."'");
    $query = $this->db->get();
        if ($query->num_rows() >= 1) {
            return $query->result();
        } else {
            return "";
        }
  }
  
  function getDetalleOferta($idOffer){
    $qrySQL = "SELECT 
                ofc.ofc_id as codigo,
                ofc.ofc_codigoserie as numerooferta,
                ofc.ofc_fecharegistro as fecharegistro,
                ofc.ofc_vigencia||' '||ofc.ofc_vigenciatexto as vigencia,
                ofc.ofc_plazoentrega||' '||ofc.ofc_plazoentregatexto as plazoentrega,
                '('||cli.cli_nui||') '||cli.cli_razonsocial as cliente,
                ccl.ccl_nombre||'('||ccl.ccl_cargo||')' as contactocliente,
                usr.usr_nombres||' '||usr.usr_apellidos as usuarioregistro,
                usr.usr_id as codusuarioregistro,
                usr2.usr_nombres||' '||usr2.usr_apellidos as ejecutivoventa,
                usr2.usr_id as codejecutivo,
                inc.inc_abreviatura||' - '||inc.inc_nombre as incoterm,
                fpg.fpg_abreviatura||' '||fpg.fpg_nombre as formapago,
                lcm.lcm_abreviatura||' - '||lcm.lcm_nombre as lineacomercial,
                ciu.ciu_nombre||' ('||dep.dep_nombre||')' as ciudad,
                ofc.ofc_observacioncomercial as observacion,
                ofc.ofc_preregistro as precomentarios
                FROM ofertacomercial ofc 
                LEFT JOIN cliente cli ON ofc.cli_id = cli.cli_id 
                LEFT JOIN contactocliente ccl ON ccl.ccl_id = ofc.ccl_id
                LEFT JOIN ejecutivoventa evt ON evt.evt_id = ofc.evt_id
                LEFT JOIN usuario usr ON usr.usr_id = ofc.usr_idregistro
                LEFT JOIN usuario usr2 ON usr2.usr_id = evt.usr_id
                LEFT JOIN lineacomercial lcm ON lcm.lcm_id = ofc.lcm_id
                LEFT JOIN ciudad ciu ON ciu.ciu_id = ofc.ciu_id
                LEFT JOIN departamento dep ON ciu.dep_id = dep.dep_id
                LEFT JOIN formapago fpg ON fpg.fpg_id = ofc.fpg_id
                LEFT JOIN incoterm inc ON ofc.inc_id = inc.inc_id
                WHERE ofc.ofc_id = '" .  intval($idOffer) . "'";
    $query = $this->db->query($qrySQL);
    foreach ($query->result() as $value){
      $data = $value;
    }
    return $data;
  }
  
  function getFirmaFuncionario($idUsr){
    $qrySQL = "SELECT 
                usr.usr_nombres||' '||usr.usr_apellidos as nombresapellidos,
                crg.crg_nombre as cargofuncionario,
                sed.sed_direccion||' - '||sed.sed_nombre as direccion,
                sed.sed_telefono||sed.sed_fax as telefonoempresa,
                usr.usr_correocorporativo as correofuncionario,
                usr.usr_extensiontelefono as telefono,
                sed.sed_paginaweb as paginaweb
                FROM usuario usr
                LEFT JOIN cargo crg ON crg.crg_id = usr.crg_id
                LEFT JOIN sede sed ON sed.sed_id = usr.sed_id
                WHERE usr_id = '".intval($idUsr)."'";
    $query = $this->db->query($qrySQL);
    foreach ($query->result() as $value){
      $data = $value;
    }
    return $data;
  }
  
  function consultarDivisas(){
    $qrySQL = "SELECT 
                var_id AS codigo,
                var_nombre AS nombre
                FROM variablesgenerales
                WHERE var_modulo = 'Preventa'";
    $query = $this->db->query($qrySQL);
    if(count($query->result()) >= 1){
      $data = $query->result();
      return $data;
    }
    else{
      return false;
    }
  }
  
  function consultarDetalleOfertaComercial($idOffer){
    $qrySQL = "SELECT 
                doc_id as codigo, 
                doc_fecharegistro as fregistro, 
                doc_codigoproducto as codigoproducto, 
                doc_cantidadproducto as cantidadproducto, 
                prd_id as idproducto, 
                doc_valorproducto as valorproducto, 
                doc_valorfinal as valorsubtotal, 
                doc_nombre as nombreproducto, 
                doc_descripcion as detalleproducto
                FROM detalleofertacomercial WHERE ofc_id = '".  intval($idOffer)."'";
    $query = $this->db->query($qrySQL);
    if(count($query->result()) >= 1){
      $data = $query->result();
      return $data;
    }
    else{
      return false;
    }
  }
  
  function getPrecioProd($lineaComercial, $incoterm, $moneda, $codigoProducto){
    $recargos = 0;
    $valor = 0;
    $qryRecargos = "SELECT 
                    (SUM(
                    lpr.lpr_tasexp + lpr.lpr_pueexp + lpr.lpr_desexp + 
                    lpr.lpr_embexp + lpr.lpr_traimp + lpr.lpr_desimp + 
                    lpr.lpr_carimp + lpr.lpr_trades + lpr.lpr_seguro + 
                    lpr.lpr_pasadu + lpr.lpr_impimp + lpr.lpr_carcom
                    )/100)+1 AS recargos 
                    FROM 
                    listaprecio lpr
                    WHERE 
                    lpr.lcm_id = '".$lineaComercial."' AND 
                    lpr.inc_id = '".$incoterm."' AND
                    lpr.est_id = 1";
    $query = $this->db->query($qryRecargos);
    foreach ($query->result() as $row) {
      $recargos = floatval($row->recargos);				
    }
    $qryValor = "   SELECT 
                    (CAST(prd.prd_preciobase AS NUMERIC)*CAST(vgn.var_valor AS NUMERIC)) AS subtotal
                    FROM 
                    producto prd 
                    INNER JOIN variablesgenerales vgn ON vgn.var_modulo = 'Preventa' AND 
                    vgn.var_id = '".$moneda."'
                    WHERE 
                    prd.lcm_id = '".$lineaComercial."' AND prd.prd_codigo = '".$codigoProducto."' 
                    AND prd.est_id = '1'";
    $query = $this->db->query($qryValor);
    foreach ($query->result() as $row) {
      $valor = floatval($row->subtotal);				
    }
    return ($recargos*$valor);
  }
  
  
  
  function guardaItem($codigo, $cantidad, $valor, $nombre, $ofcID){
    	
      $data = array(
				'doc_codigoproducto' => $codigo,
        'doc_cantidadproducto' => $cantidad,
        'prd_id' => $this->obtenerCampo("producto", "prd_id", "prd_codigo", $codigo),
				'doc_valorproducto' => $valor,
				'doc_valorfinal' => $valor*$cantidad,
				'doc_nombre' => $nombre,
				'doc_descripcion' => $this->obtenerCampo("producto", "prd_nombre", "prd_codigo", $codigo),
				'ofc_id' => $ofcID,
				'usr_idregistro' => $this->session->userdata('idUsuario')
	    	);
			$this->db->insert('detalleofertacomercial', $data);
			$this->registrarLog("8", "Registro informacion de productos de la oferta ".$ofcID);
  }

}
?>