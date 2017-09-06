<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar %%NOME_CLASSE%% ========================= 
if($_POST){
    print ($oControle->cadastrar%%NOME_CLASSE%%()) ? "" : $oControle->msg; exit;
}
%%CARREGA_COLECAO%%
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="%%NOME_CLASSE%%Controller">
		<?php 
		require_once("includes/titulo.php"); 
		require_once("includes/menu.php"); 
		?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a></li>
			<li class="active">Cadastrar %%NOME_CLASSE%%</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					%%ATRIBUICAO%%
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="adm%%NOME_CLASSE%%.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>