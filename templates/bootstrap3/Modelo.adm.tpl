<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$numPags = $oControle->numeroPaginasConsulta($oControle->totalColecao%%NOME_CLASSE%%());

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluir%%NOME_CLASSE%%(%%PK_REQUEST%%)) ? "" : $oControle->msg; exit;
}
if(!isset($_REQUEST['pag'])) $_REQUEST['pag'] = 1;

$a%%NOME_CLASSE%% = ($_POST) ? $oControle->consultar%%NOME_CLASSE%%($_REQUEST['txtConsulta']) : $oControle->getAll%%NOME_CLASSE%%([], ["%%PK%%"], $_REQUEST['pag']);
//Util::trace($a%%NOME_CLASSE%%);
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
		<form action="" method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="input-group h2">
					<input name="txtConsulta" class="form-control input-sm" id="txtConsulta" type="text" placeholder="Pesquisar %%NOME_CLASSE%%" value="<?=$_REQUEST['txtConsulta']?>" autofocus />
					<span class="input-group-btn">
						<button class="btn btn-primary btn-sm" type="submit"><span class="glyphicon glyphicon-search"></span></button>
						<a href="cad%%NOME_CLASSE%%.php" class="btn btn-success btn-sm" title="Cadastrar %%NOME_CLASSE%%"><i class="glyphicon glyphicon-plus"></i></a>
					</span>
					</div>
				</div>
			</div>
		</form>

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
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($a%%NOME_CLASSE%% as $o%%NOME_CLASSE%%){
?>
				<tr>
					%%VALORATRIBUTOS%%
					%%ADM_INFO%%
					%%ADM_EDIT%%
					%%ADM_DELETE%%
				</tr>
<?php
	}
?>
				<tr>
					<td colspan="%%NUMERO_COLUNAS%%">
						<?php $oControle->componentePaginacao($numPags);?>
					</td>
				</tr>
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
			</tbody>
		</table>
		<input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>