<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluirComentario($_REQUEST['idComentario'])) ? "" : $oControle->msg; exit;
}

$aComentario = $oControle->getAllComentario();
//Util::trace($aComentario);
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="ComentarioController">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar Comentario</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-condensed table-striped">
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
					<td><a class="btn btn-success btn-xs" href="editComentario.php?idComentario=<?=$oComentario->idComentario;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
					<td><a class="btn btn-danger btn-xs" href="javascript: void(0);" onclick="excluir('idComentario','<?=$oComentario->idComentario;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
				</tr>
<?php
	}
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
					<td colspan="9"><a href="cadComentario.php" class="btn btn-primary btn-xs" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="Comentario" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>