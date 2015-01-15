<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aPost = $oControle->carregarColecaoPost();
//print "<pre>";print_r($aPost);print "</pre>";

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiPost($_REQUEST['idPost'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/head.php");?>
    <div class="container">
        <?php require_once("includes/titulo.php");?>
        <?php require_once("includes/menu.php");?>
        <ol class="breadcrumb">
            <li><a href="principal.php">Home</a></li>
            <li class="active">Administrar <span>Post</span></li>
        </ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
        <table class="table table-striped">
<?php
if($aPost){
?>
	
            <thead>
                <tr>
                    <th>IdPost</th>
			<th>Usuario</th>
			<th>Titulo</th>
			<th>Descricao</th>
			<th>DataHoraCadastro</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
	foreach($aPost as $oPost){
?>
                <tr>
                    <td><?=$oPost->idPost?></td>
			<td><?=$oPost->oUsuario->login?></td>
			<td><?=$oPost->titulo?></td>
			<td><?=$oPost->descricao?></td>
			<td><?=Util::formataDataHoraBancoForm($oPost->dataHoraCadastro)?></td>
                    <td><a class="btn btn-success btn-sm" href="editPost.php?idPost=<?=$oPost->idPost;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idPost','<?=$oPost->idPost;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                    <td colspan="7" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
            </tr>
<?php
}
?>
            <tr>
                <td colspan="7"><a href="cadPost.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
            </tr>
        </table>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>