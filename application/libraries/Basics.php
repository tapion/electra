<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class CI_Basics {
	public function __construct()
	{
		$this->CI =& get_instance();
	}
	
	public function viewMessage ($array, $tipoMensaje="", $textoMsj=""){
        if($tipoMensaje == ""){
            $return =  "<div class='ui-widget'> <div class='ui-state-".$array[0]->tmj_estilo." ui-corner-all' 
                            style='padding: 5px;'><p><span class='ui-icon ui-icon-".$array[0]->tmj_icono."' 
                            style='float: left; margin-right: 2px;'></span> 
                            <strong>".$array[0]->tmj_abreviatura."</strong> ".utf8_decode($array[0]->msj_descripcion)." <strong>".$textoMsj."</strong></p></div></div>";
            return utf8_encode($return);
        }
        else
        {
            $msj = "";
            $i=0;
            $cnt = 1;
			$return =  "<div class='ui-widget'> <div class='ui-state-error ui-corner-all' 
                            style='padding: 5px;'><p><span class='ui-icon ui-icon-closethick' 
                            style='float: left; margin-right: 2px;'></span> 
                            <strong>Error:</strong> ";
							$msj.=substr($array, 0, -2).".";
			return utf8_encode($return.$msj."</p></div></div>");
        }
    }

     public function cargarOpcion($array, $predef=""){
        $return = array();
        if($predef != ""){
            $temp = array("N/A", $predef);
            foreach ($array as $arr1){
                foreach($arr1 as $val){
                    array_push($temp, $val);
                }
            }
            for($i=0; $i<count($temp); $i=$i+2 )
            {
                $idRet = $temp[$i];
                $return[$idRet] = utf8_encode($temp[$i+1]);
            }
        }
        else{
            $temp = array();
            foreach ($array as $arr1){
                foreach($arr1 as $val){
                    array_push($temp, $val);
                }
            }
            for($i=0; $i<count($temp); $i=$i+2 )
            {
                $idRet = $temp[$i];
                $return[$idRet] = $temp[$i+1];
            }
        }
        return $return;
    }
	 
	function convertirMoneda($numero, $simbolo="$"){
		$posicion = strpos($numero, "%");
		if($posicion === false){
			return $simbolo."".number_format($numero,2);
		}
		else{
			return $numero;
		}
	}
	
	function formarGrupoCheck($array){
	    $retorno = "<table id='dataTable'>";
	    $temp = array();
	    foreach ($array as $arr1){
	        foreach($arr1 as $val){
	            //array_push($temp, ucwords(strtolower($val)));
				array_push($temp, $val);
	        }
	    }
	    for($i=0; $i<count($temp); $i=$i+2 )
	    {
	        $retorno.= "    <tr>
	                            <td width='5%'><input type='checkbox' name='valores[]' value='".$temp[$i]."' /></td>
	                            <td width='95%'>".utf8_encode($temp[$i+1])."</td>
	                        </tr>";
	    }

	    $retorno.= "</table>";
	    return $retorno;
	}
    
}
?>