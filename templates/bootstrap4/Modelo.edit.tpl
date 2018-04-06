<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
// ================= Edicao do %%NOME_CLASSE%% ========================= 
if($_POST){
	print ($oControle->alterar%%NOME_CLASSE%%()) ? "" : $oControle->msg; exit;
}

$o%%NOME_CLASSE%% = $oControle->get%%NOME_CLASSE%%($_REQUEST['%%ID_PK%%']);
%%CARREGA_COLECAO%%
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
    <?php require_once("includes/menu.php"); ?>
    <div class="container" ng-controller="%%NOME_CLASSE%%Controller">
		<nav aria-label="breadcrumb">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="principal.php">Início</a></li>
				<li class="breadcrumb-item active" aria-current="page"><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a></li>
				<li class="breadcrumb-item active" aria-current="page">Editar</li>
			</ol>
		</nav>
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
                    <div class="form-actions">
                        <button id="btnEditar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                        %%CHAVE_PRIMARIA%%
                        <input type="hidden" name="classe" id="classe" value="%%NOME_CLASSE%%" />
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
	<?php require_once("includes/js.php");?>
	<?php require_once("includes/modals.php");?>
</body>
</html>