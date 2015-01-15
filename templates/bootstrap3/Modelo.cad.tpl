<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar %%NOME_CLASSE%% ========================= 
if($_POST){
    print ($oControle->cadastra%%NOME_CLASSE%%()) ? "" : $oControle->msg; exit;
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
            <li class="active">Cadastrar <span>%%NOME_CLASSE%%</span></li>
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
                        <button id="btnCadastrar" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn btn-default" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>