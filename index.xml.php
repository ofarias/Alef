<?php
session_start();
date_default_timezone_set('America/Mexico_City');
require_once('app/controller/pegaso.controller.php');
require_once('app/controller/pegaso.controller.cobranza.php');
require_once('app/controller/pegaso.controller.ventas.php');
require_once('app/controller/testsql.php');
require_once('app/controller/controller.coi.php');
require_once('app/controller/controller.xml.php');
$controller = new controller_xml;
if(isset($_GET['action'])){
$action = $_GET['action'];
}else{
	$action = '';
}
if(isset($_POST['UPLOAD_META_DATA'])){
	$tipo = $_POST['tipo'];
	$files2upload = $_POST['files2upload'];
	$controller->facturacionCargaXML($files2upload, $tipo);
}elseif (isset($_POST['cancelaAdm'])) {
	$res=$controller->cancelaAdm($_POST['doc']);
	echo json_encode($res);
	exit;
}
else{switch ($_GET['action']){
	//case 'inicio':
	//	$controller->Login();
	//	break;
	case 'login':
		$controller->Login();
		break;
	case 'cargaMetaDatos':
		$controller->cargaMetaDatos();
		break;
	case 'verMetaDatos':
		$controller->verMetaDatos();
		break;
	case 'verMetaDatosDet':
		$controller->verMetaDatosDet($_GET['archivo']);
		break;
	default: 
		header('Location: index.php?action=login');
		break;
	}

}
?>