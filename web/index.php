<?php
require_once(dirname(dirname(__FILE__)) . "/classes/class.ControleWeb.php");
$oControle     = new ControleWeb();
$oDiretorioXML = new DiretorioXML();
$aDiretorioXML = $oDiretorioXML->get_arquivos();

switch ($_REQUEST['acao']) {
    case "xml":
        echo ($oControle->gerarXML($_REQUEST['sgbd'], $_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha'], $_REQUEST['database'])) ? "" : $oControle->msg; exit;
    break;
    
    case "gerar": 
        echo $oControle->gerarArtefatos($_REQUEST['xml'], false); exit;
    break;
    
    case "excluirXML":
    	echo $oControle->excluirXML($_REQUEST['xml']); exit;
    break;
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php require_once("includes/header.php"); ?>
    </head>
    <body>
        <?php require_once("includes/head.php"); ?>
        <div class="container">
            <?php require_once("includes/titulo.php"); ?>
            <?php require_once("includes/menu.php");?>
    
            <!-- Main component for a primary marketing message or call to action -->
            <form role="form" onsubmit="return false;">
                <div class="row">
                    <div class="col-md-4">
                        <p>
                            <span class="label label-success">Conectar Banco</span>
                        </p>
                        <div class="form-group">
                            <label for="sgbd">SGBD</label>
                                <select name="sgbd" id="sgbd" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="mysql">MySQL</option>
                                    <option value="sqlserver">SQL Server</option>
                                </select>
                        </div>
                         <div class="form-group">
                            <label for="host">Host</label>
                            <input type="text" id="host" name="host" value="" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="login">Login</label>
                            <input type="text" id="login" name="login" value="" class="form-control" />
                        </div>
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <div class="input-group">
                                <input type="password" id="senha" name="senha" value="" class="form-control" />
                                <span class="input-group-btn">
                                    <button id="btnConectar" data-loading-text="loading..." type="submit" class="btn btn-primary">Conectar</button>
                                </span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="database">Database</label>
                            <div class="input-group">
                                <select name="database" id="database" class="form-control"></select>
                                <span class="input-group-btn">
                                    <button id="btnGerar" data-loading-text="loading..." type="submit" class="btn btn-success">Mapear BD</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <span class="label label-info">Bases de Dados Mapeadas</span>
                        </p>
                        <div class="row">
<?php
foreach ($aDiretorioXML as $xml) {
?>
                            <div class="col-md-4">
                                <div class="btn-group dropup">
                                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown" data-loading-text="loading...">
                                        <?=ucfirst($xml)?> <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
<?php 
    if(file_exists(dirname(dirname(__FILE__))."/geradas/$xml")){
?>
                                        <li>
                                            <a href="../geradas/<?=$xml?>" target="_blank"><i class="glyphicon glyphicon-home"></i> Visualizar Página</a>
                                        </li>
<?php
    }
?>
                                        <li><a href="../xml/<?=$xml?>.xml" target="_blank"><i class="glyphicon glyphicon-chevron-right"></i> Visualizar XML</a></li>
                                        <li><a href="#" id="btnExcluirXML" data-xml="<?=$xml?>"><i class="glyphicon glyphicon-trash"></i> Excluir XML</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" id="btnGerarArtefatos" data-xml="<?=$xml?>"><i class="glyphicon glyphicon-wrench"></i> Gerar Artefatos</a></li>
                                    </ul>
                                </div>
                            </div>
<?php
}
?>
                        </div>
                    </div>
                </div>
            </form> 

        </div> <!-- /container -->
        <?php require_once("includes/footer.php") ?> 
    </body>
</html>
