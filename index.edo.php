<?php
session_start();
date_default_timezone_set('America/Mexico_City');
require_once('app/controller/controller.edo.php');
$controller = new controller_edo;
if(isset($_GET['action'])){
$action = $_GET['action'];
}else{
	$action = '';
}
if (isset($_POST['usuario'])){
	$controller->InsertaUsuarioN($_POST['usuario'], $_POST['contrasena'], $_POST['email'], $_POST['rol'], $_POST['letra'], $_POST['nombre'], $_POST['numletras']);
}elseif (isset($_POST['calcular'])){
	$res=$controller->calcular($_POST['id']);
	echo json_encode($res);
	exit();
}
else{switch ($_GET['action']){
	//case 'inicio':
	//	$controller->Login();
	//	break;
	case 'edo_fin':
		if(isset($_GET['anio'])){
			$anio = $_GET['anio'];
		}else{
			$anio = date('Y');
		}
		$controller->edo_fin($anio);
		break;
	case 'CambiarSenia':
		$controller->CambiarSenia();
		break;
	default: 
		header('Location: index.php?action=login');
		break;
	}

}
?>