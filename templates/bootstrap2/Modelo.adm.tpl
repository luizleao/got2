<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$a%%NOME_CLASSE%% = $oControle->getAll%%NOME_CLASSE%%();
//print "<pre>";print_r($a%%NOME_CLASSE%%);print "</pre>";

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->exclui%%NOME_CLASSE%%(%%PK_REQUEST%%)) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once(dirname(__FILE__)."/includes/head.php");?>
        <div class="container">
            <?php require_once(dirname(__FILE__)."/includes/titulo.php"); ?>
            <ul class="breadcrumb">
                <li><a href="principal.php">Home</a> <span class="divider">/</span></li>
                <li class="active">Administrar <span>%%NOME_CLASSE%%</span></li>
            </ul>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
            <table class="table table-striped">
<?php
if($a%%NOME_CLASSE%%){
?>
	
                <thead>
                    <tr>
                        %%TITULOATRIBUTOS%%
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
<?php
	foreach($a%%NOME_CLASSE%% as $o%%NOME_CLASSE%%){
?>
                    <tr>
                        %%VALORATRIBUTOS%%
                        %%ADM_EDIT%%
                        %%ADM_DELETE%%
                    </tr>
<?php
	}
?>
                </tbody>
<?php
}
else{
?>
                <tr>
                        <td colspan="%%NUMERO_COLUNAS%%" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
                </tr>
<?php
}
?>
                <tr>
                    <td colspan="%%NUMERO_COLUNAS%%"><a href="cad%%NOME_CLASSE%%.php" class="btn btn-primary btn-small" title="Cadastrar"><i class="icon-white icon-plus"></i></a></td>
                </tr>
            </table>
        </div>
        <div id="push"></div>
    </div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php")?>
</body>
</html>