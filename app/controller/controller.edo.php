<?php
require_once('app/fpdf/fpdf.php');
require_once('app/views/unit/commonts/numbertoletter.php');
require_once('app/model/model.edo.php');

class controller_edo{
	var $contexto_local = "http://SERVIDOR:8081/pegasoFTC/app/";
	var $contexto = "http://SERVIDOR:8081/pegasoFTC/app/";
	
	function load_template($title='Sin Titulo'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/s.header.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}

	function load_template2($title='Escaneo de Documentos Logistica'){
		$pagina = $this->load_page('app/views/master.php');
		$header = $this->load_page('app/views/sections/s.header2.php');
		$pagina = $this->replace_content('/\#HEADER\#/ms' ,$header , $pagina);
		$pagina = $this->replace_content('/\#TITLE\#/ms' ,$title , $pagina);		
		return $pagina;
	}
	private function load_page($page){
	return file_get_contents($page);
	}
	private function view_page($html){
	echo $html;
	}
	private function replace_content($in='/\#CONTENIDO\#/ms', $out,$pagina){
	return preg_replace($in, $out, $pagina);	 	
	}



	function edo_fin($anio){
		$data= new data_edo_fin;
		if($_SESSION['user']){
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/edo_fin/p.edo_fin.php');
  			ob_start();
  			$info=$data->edo_fin($anio);
			$user=$_SESSION['user']->NOMBRE;
  			include 'app/views/pages/edo_fin/p.edo_fin.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);
			return;
		}
	}


	function calcular($id){
		if($_SESSION['user']){
			$data=new data_edo_fin;
			$calcula=$data->calcular($id);			
			//if($crea['status'] == 'ok'){
			//	$actualiza = $data->actualizaCuentaCliente($cliente, $partidas, $ide);	
			//}
 			return $calcula;
		}
	}	

	function verPolizas($uuid){
		if($_SESSION['user']){
			$data_coi = new CoiDAO;
			$data = new pegaso;
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/xml/p.verPolizas.php');
  			ob_start();
  			$cabecera=$data->cabeceraDocumento($uuid);
			$documento=$data->verPolizas($uuid);
			$polizas=$data_coi->traePoliza($documento);
			$param=$data_coi->traeParametros();
			$user=$_SESSION['user']->NOMBRE;
  			include 'app/views/pages/xml/p.verPolizas.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);
		}
	}

	function verBancos($t){
		if($_SESSION['user']){
			$data_coi = new CoiDAO;
			$data = new pegaso;
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Contabilidad/p.verBancos.php');
  			ob_start();
  			$info=$data->verBancos($idb=0);
			$user=$_SESSION['user']->NOMBRE;
  			$ban =$data->traeBancoSat();
  			if($t == 'pol'){
  				$bancos=array();
  				$ln=0;
  				foreach ($info as $k) {
  					$bancos[]=($k->ID.':'.$k->NUM_CUENTA.':'.$k->BANCO.':'.$k->RFC.':'.$k->MONEDA.':'.$k->TIPO.':'.$k->CTA_CONTAB);
  					$ln++;
  				}
  				return $bancos;
  			}
  			include 'app/views/pages/Contabilidad/p.verBancos.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);	
		}
	}

	function editBanco($idb){
		if($_SESSION['user']){
			$data = new pegaso;
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Contabilidad/p.editBanco.php');
  			ob_start();
  			$info=$data->verBancos($idb);
			$user=$_SESSION['user']->NOMBRE;
  			include 'app/views/pages/Contabilidad/p.editBanco.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);		
		}
	}

	function editaBanco($idb, $si, $cuenta, $dia, $cc, $tipo){
		if($_SESSION['user']){
			$data=new pegaso;
			$exec=$data->editaBanco($idb, $si, $cuenta, $dia, $cc, $tipo);
			$this->editBanco($idb);
		}
	}

	function insertaBanco($banco, $cuenta, $tipo, $moneda, $saldo, $fecha, $observaciones){
		if($_SESSION['user']){
			$data= new pegaso;
			$exec=$data->insertaBanco($banco, $cuenta, $tipo, $moneda, $saldo, $fecha, $observaciones);
			return $exec;
		}
	}

	function traeCuentasContables($buscar){
		$data_coi= new CoiDAO;
        $exec = $data_coi->traeCuentasContables($buscar);
        return $exec;
	}

	function cuentasImp(){
		if($_SESSION['user']){
			$data = new CoiDAO;
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Contabilidad/p.editCuentaImp.php');
  			ob_start();
  			$info=$data->verCuentasImp();
			$user=$_SESSION['user']->NOMBRE;
  			include 'app/views/pages/Contabilidad/p.editCuentaImp.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);		
		}
	}

	function actCuentaImp($idc,$ncta){
		if($_SESSION['user']){
			$data=new CoiDAO;
			$res=$data->actCuentaImp($idc, $ncta);
			return $res;
		}
	}

	function polizaFinal($uuid, $tipo, $idp){
		if($_SESSION['user']){
			$data = new pegaso;
			$data_coi= new CoiDAO;
			$infoPoliza=$data->traePago($idp, $tipo);
			$res=$data_coi->polizaFinal($uuid, $tipo, $idp, $infoPoliza);
			return $res;
		}
	}

}?>

