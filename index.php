<?php
require_once(dirname(__FILE__) . "/classes/class.ControleWeb.php");
$oControle     = new ControleWeb();
$oDiretorioXML = new DiretorioXML();
$aDiretorioXML = $oDiretorioXML->get_arquivos();

switch ($_REQUEST['acao']) {
    case "xml":
        echo ($oControle->gerarXML($_REQUEST['sgbd'], $_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha'], $_REQUEST['database'])) ? "" : $oControle->msg; exit;
    break;
    
    case "json":
    	echo ($oControle->gerarJson($_REQUEST['sgbd'], $_REQUEST['host'], $_REQUEST['login'], $_REQUEST['senha'], $_REQUEST['database'])) ? "" : $oControle->msg; exit;
    	break;
    
    case "gerar": 
    	echo $oControle->gerarArtefatos($_REQUEST['xml'], $_REQUEST['gui'], false); exit;
    break;
    
    case "excluirXML":
    	echo $oControle->excluirXML($_REQUEST['xml']); exit;
    break;
}
?>
<!DOCTYPE html>
<html lang="pt">
    <head>
        <?php require_once("includes/header.php"); ?>
    </head>
    <body>
        <?php require_once("includes/head.php"); ?>
        <div class="container">
            <?php require_once("includes/titulo.php");?>
            <?php require_once("includes/menu.php");?>
    
            <!-- Main component for a primary marketing message or call to action -->
            <form role="form" onsubmit="return false;">
                <div class="row">
                    <div class="col-md-6">
                        <p>
                            <span class="label label-success">Conectar Banco</span>
                        </p>
                        <div class="form-group">
                            <label for="sgbd">SGBD</label>
                                <select name="sgbd" id="sgbd" class="form-control">
                                    <option value="">Selecione</option>
                                    <option value="mysql">MySQL</option>
                                    <option value="sqlserver">SQL Server</option>
                                    <option value="postgre">PostgreSQL</option>
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
                                    <button id="btnGerarXml" data-loading-text="loading..." type="submit" class="btn btn-success">XML</button>
                                    <button id="btnGerarJson" data-loading-text="loading..." type="submit" class="btn btn-info">JSON</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <p>
                            <span class="label label-info">Bases de Dados Mapeadas</span>
                        </p>
                        <div class="row">
                        	<table class="table table-striped table-condensed">
                        		<thead>
                        			<tr>
                        				<th></th>
                        				<th>Ver Site</th>
                        				<th>Ver XML</th>
                        				<th>Excluir</th>
                        				<th><img src="img/icon-bootstrap.png" title="Bootstrap 2" /> 2</th>
                        				<th><img src="img/icon-bootstrap.png" title="Bootstrap 3" /> 3</th>
                        				<th><img src="img/icon-bootstrap.png" title="Bootstrap 4" /> 4</th>
                        				<th><img src="img/icon-materialize.png" title="Materialize" /></th>
                        			</tr>
                        		</thead>
                        		<tbody>
<?php
//Util::trace($aDiretorioXML);
$i=1;
foreach ($aDiretorioXML as $xml) {
?>
									<tr>
										<td><?=ucfirst(utf8_encode($xml))?></td>
										<td>
<?php 
    if(file_exists(dirname(__FILE__)."/geradas/".utf8_encode($xml))){
?>
                                            <a class="btn btn-default btn-xs" href="geradas/<?=$xml?>/" target="_blank"><i class="glyphicon glyphicon-home"></i></a>
<?php
        $i++;
    }
?>
										</td>
										<td><a class="btn btn-default btn-xs" href="xml/<?=$xml?>.xml?" target="_blank"><i class="glyphicon glyphicon-tag"></i></a></td>
										<td><a class="btn btn-default btn-xs" href="#" id="btnExcluirXML" data-xml="<?=$xml?>"><i class="glyphicon glyphicon-trash"></i></a></td>
										<td><a class="btn btn-default btn-xs" href="#" id="btnGerarArtefatos" data-xml="<?=$xml?>" data-gui="bootstrap2"><i class="glyphicon glyphicon-wrench"></i></a></td>
										<td><a class="btn btn-default btn-xs" href="#" id="btnGerarArtefatos" data-xml="<?=$xml?>" data-gui="bootstrap3"><i class="glyphicon glyphicon-wrench"></i></a></td>
										<td><a class="btn btn-default btn-xs" href="#" id="btnGerarArtefatos" data-xml="<?=$xml?>" data-gui="bootstrap4"><i class="glyphicon glyphicon-wrench"></i></a></td>
										<td><a class="btn btn-default btn-xs" href="#" id="btnGerarArtefatos" data-xml="<?=$xml?>" data-gui="materialize"><i class="glyphicon glyphicon-wrench"></i></a></td>
									</tr>
<?php
}
?>
								</tbody>
							</table>
                        </div>
                    </div>
                </div>
            </form> 

        </div> <!-- /container -->
        <?php require_once("includes/footer.php") ?> 
    </body>
</html>
