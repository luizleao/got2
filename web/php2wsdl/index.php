<?php
require("WSDLCreator.php");

try{
	// informamos o nome do namespace e o endereco do arquivo WSDL
	$wsdl_creator = new WSDLCreator("GOTWSDL", "http://localhost/got/web/ws/service.wsdl");

	// adicionamos a classe ControleWeb
	$wsdl_creator->addFile(dirname(dirname(dirname(__FILE__)))."/classes/class.ControleWeb.php");

	// agora indicamos a URL para acessar os metodos da classe Calculadora
	$wsdl_creator->addURLToClass("ControleWeb", "http://localhost/got/web/ws/index.php");

	// criamos o arquivo WSDL
	$wsdl_creator->createWSDL();

	// e o salvamos com o nome desejado
	$wsdl_creator->saveWSDL(dirname(dirname(__FILE__))."/ws/service.wsdl");
} 
catch(Exception $e){
	echo $e->getMessage();
}
?>
