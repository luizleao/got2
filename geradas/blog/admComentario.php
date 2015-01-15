<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aComentario = $oControle->carregarColecaoComentario();
//print "<pre>";print_r($aComentario);print "</pre>";

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiComentario($_REQUEST['idComentario'])) ? "" : $oControle->msg; exit;
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
            <li class="active">Administrar <span>Comentario</span></li>
        </ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
        <table class="table table-striped">
<?php
if($aComentario){
?>
	
            <thead>
                <tr>
                    <th>IdComentario</th>
			<th>Post</th>
			<th>Descricao</th>
			<th>Nome</th>
			<th>Email</th>
			<th>Webpage</th>
			<th>DataHoraCadastro</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
	foreach($aComentario as $oComentario){
?>
                <tr>
                    <td><?=$oComentario->idComentario?></td>
			<td><?=$oComentario->oPost->titulo?></td>
			<td><?=$oComentario->descricao?></td>
			<td><?=$oComentario->nome?></td>
			<td><?=$oComentario->email?></td>
			<td><?=$oComentario->webpage?></td>
			<td><?=Util::formataDataHoraBancoForm($oComentario->dataHoraCadastro)?></td>
                    <td><a class="btn btn-success btn-sm" href="editComentario.php?idComentario=<?=$oComentario->idComentario;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idComentario','<?=$oComentario->idComentario;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
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
                    <td colspan="9" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
            </tr>
<?php
}
?>
            <tr>
                <td colspan="9"><a href="cadComentario.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
            </tr>
        </table>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>