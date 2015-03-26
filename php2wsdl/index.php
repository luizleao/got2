<?php
require("WSDLCreator.php");

try{
    // informamos o nome do namespace e o endereco do arquivo WSDL
    $oWSDL = new WSDLCreator("GOTWSDL", "http://localhost/got2/ws/service.wsdl");

    // adicionamos a classe ControleWeb
    $oWSDL->addFile(dirname(dirname(__FILE__))."/classes/class.ControleWeb.php");

    // agora indicamos a URL para acessar os metodos da classe Calculadora
    $oWSDL->addURLToClass("ControleWeb", "http://localhost/got2/ws/index.php");

    // criamos o arquivo WSDL
    $oWSDL->createWSDL();

    // e o salvamos com o nome desejado
    $oWSDL->saveWSDL(dirname(dirname(__FILE__))."/ws/service.wsdl");
} 
catch(Exception $e){
    echo $e->getMessage();
}
