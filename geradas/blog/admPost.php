<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluirPost($_REQUEST['idPost'])) ? "" : $oControle->msg; exit;
}

$aPost = $oControle->getAllPost();
//Util::trace($aPost);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="PostController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Post</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-condensed table-striped">
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
					<td><a class="btn btn-success btn-xs" href="editPost.php?idPost=<?=$oPost->idPost;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-xs" href="javascript: void(0);" onclick="excluir('idPost','<?=$oPost->idPost;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
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
					<td colspan="7"><a href="cadPost.php" class="btn btn-primary btn-xs" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Post" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>