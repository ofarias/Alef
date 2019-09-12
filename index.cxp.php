<?php
session_start();
date_default_timezone_set('America/Mexico_City');
require_once('app/controller/controller.cxp.php');
$controller = new controller_CxP;
if(isset($_GET['action'])){
$action = $_GET['action'];
}else{
	$action = '';
}
if(isset($_POST['UPLOAD_META_DATA'])){
	$tipo = $_POST['tipo'];
	$files2upload = $_POST['files2upload'];
	$controller->facturacionCargaXML($files2upload, $tipo);
}
else{switch ($_GET['action']){
	//case 'inicio':
	//	$controller->Login();
	//	break;
	case 'login':
		$controller->Login();
		break;
	case 'edoCtaProv':
		$controller->edoCtaProv($_GET['prov']);
		break;
	default: 
		header('Location: index.php?action=login');
		break;
	}

}
?>