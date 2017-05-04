<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$a%%NOME_CLASSE%% = $oControle->getAll%%NOME_CLASSE%%();
//Util::trace($a%%NOME_CLASSE%%);

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->exclui%%NOME_CLASSE%%(%%PK_REQUEST%%)) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="%%NOME_CLASSE%%Controller">
		<?php require_once("includes/titulo.php");?>
		<?php require_once("includes/menu.php");?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li class="active">Administrar %%NOME_CLASSE%%</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<table class="table table-condensed table-striped">
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
					<td colspan="%%NUMERO_COLUNAS%%"><a href="cad%%NOME_CLASSE%%.php" class="btn btn-primary btn-xs" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>