<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");
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
    <?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
    <div id="wrap">
        <?php require_once(dirname(__FILE__)."/includes/head.php");?>
        <div class="container">
            <?php require_once(dirname(__FILE__)."/includes/titulo.php"); ?>
            <ul class="breadcrumb">
		<li><a href="principal.php">Home</a> <span class="divider">/</span></li>
		<li><a href="adm%%NOME_CLASSE%%.php">%%NOME_CLASSE%%</a> <span class="divider">/</span></li>
		<li class="active">Cadastrar <span>%%NOME_CLASSE%%</span></li>
            </ul>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
            <form onsubmit="return false;">
		<fieldset>
%%ATRIBUICAO%%
                    <div class="form-actions">
                        <button id="btnCadastrar" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                        <a class="btn" href="adm%%NOME_CLASSE%%.php">Voltar</a>
                    </div>
		</fieldset>
            </form>
        </div>
        <div id="push"></div>
    </div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php")?>
</body>
</html>