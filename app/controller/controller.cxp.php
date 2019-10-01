<?php
require_once('app/model/model.cxp.php');
require_once('app/fpdf/fpdf.php');
require_once('app/views/unit/commonts/numbertoletter.php');

class controller_CxP{
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

	function edoCtaProv($prov){
		if($_SESSION['user']){
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Proveedores/p.edoCtaProv.php');
  			ob_start();
			$data = new pegasoCxP;
			$generales=$data->proveedor($prov);
			$documentos=$data->edoCtaProv($prov);
			include 'app/views/pages/Proveedores/p.edoCtaProv.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);
		}
	}

	function verCxP(){
		if($_SESSION['user']){
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Proveedores/p.verCxP.php');
  			ob_start();
			$data = new pegasoCxP;
			$prov=$data->verCxP();
			$provCh=$data->verCxpChP($prov);
			include 'app/views/pages/Proveedores/p.verCxP.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);	
		}
	}

	function verDetCxP($prov){
		if($_SESSION['user']){
			$pagina = $this->load_template();
			$html=$this->load_page('app/views/pages/Proveedores/p.verDetCxP.php');
  			ob_start();
			$data = new pegasoCxP;
			$exec=$data->verDetCxP($prov);
			$sol =$data->verSolPen($prov);
			$ch = $data->verChPost($prov);
			include 'app/views/pages/Proveedores/p.verDetCxP.php';
  			$table = ob_get_clean();
  			$pagina = $this->replace_content('/\#CONTENIDO\#/ms',$table, $pagina);
  			$this->view_page($pagina);		
		}
	}
	
}
?>