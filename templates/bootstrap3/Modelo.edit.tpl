<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$o%%NOME_CLASSE%% = $oControle->selecionar%%NOME_CLASSE%%($_REQUEST['%%ID_PK%%']);
 
// ================= Edicao do %%NOME_CLASSE%% ========================= 
if($_POST){
	print ($oControle->altera%%NOME_CLASSE%%()) ? "" : $oControle->msg; exit;
}
%%CARREGA_COLECAO%%
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once("includes/header.php");?>
</head>
<body>
    <?php require_once("includes/head.php");?>
    <div class="container">
        <?php 
        require_once("includes/titulo.php"); 
        require_once("includes/menu.php"); 
        ?>
        <ol class="breadcrumb">
            <li><a href="principal.php">Home</a></li>
            <li><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a></li>
            <li class="active">Editar <span>%%NOME_CLASSE%%</span></li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">
%%ATRIBUICAO%%
            <div class="form-actions">
                <button id="btnEditar" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                <a class="btn btn-default" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                %%CHAVE_PRIMARIA%%
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>