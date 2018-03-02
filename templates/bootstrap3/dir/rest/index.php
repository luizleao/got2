<?php 
require_once('../classes/class.Controle.php');
$oControle = new Controle();

switch($_REQUEST['action']){
	case 'get': 
		eval("\$a = \$oControle->get{$_REQUEST['classe']}(\$_REQUEST['id']);");
	break;
	case 'all': 
		eval("\$a = \$oControle->getAll{$_REQUEST['classe']}();");
	break;
	case 'cad':
		//Util::trace($_POST);exit;
		$data = json_decode(file_get_contents("php://input"), true);
		//Util::trace($data); exit;
		//Util::trace($HTTP_RAW_POST_DATA); exit;
		eval("\$a = \$oControle->cadastrar{$_REQUEST['classe']}(\$data);");
	break;
}

//header("Access-Control-Allow-Origin: *");
header("content-type: application/json");
echo json_encode($a);