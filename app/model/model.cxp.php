<?php

require_once 'app/model/database.php';
class pegasoCxP extends database {

	function proveedor($prov){
		$this->query="SELECT P.*, P.NOM_BANCO||P.CUENTA AS BANCOSAT FROM PROV01 P WHERE P.CLAVE = '$prov'";
		$rs=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($rs)){
			$data[]=$tsArray;
		}
		return $data;
	}	

	function edoCtaProv($prov){
		$data=array();
		$this->query="SELECT * FROM FTC_POC WHERE CVE_PROV = '$prov'";
		$res=$this->EjecutaQuerySimple();
		while ($tsArray=ibase_fetch_object($res)) {
			$data[]=$tsArray;
		}
		return $data;
	}
}
?>