<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$oPost = $oControle->selecionarPost($_REQUEST['idPost']);
 
// ================= Edicao do Post ========================= 
if($_POST){
	print ($oControle->alteraPost()) ? "" : $oControle->msg; exit;
}
$aUsuario = $oControle->carregarColecaoUsuario();
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
            <li><a href="admPost.php">Post</a></li>
            <li class="active">Editar <span>Post</span></li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">

<div class="form-group">
    <label for="idUsuario">Usuario</label>
    <select name="idUsuario" id="idUsuario" class="form-control">
        <option value="">Selecione</option>
    <?php
    foreach($aUsuario as $oUsuario){
    ?>
        <option value="<?=$oUsuario->idUsuario?>"<?=($oUsuario->idUsuario == $oPost->oUsuario->idUsuario) ? " selected" : ""?>><?=$oUsuario->login?></option>
    <?php
    }
    ?>
    </select>
</div>
<div class="form-group">
    <label for="titulo">Titulo</label>
    <input type="text" class="form-control" id="titulo" name="titulo" value="<?=$oPost->titulo?>" />
</div>
<div class="form-group">
    <label for="descricao">Descricao</label>
    <textarea name="descricao" class="form-control" id="descricao" cols="80" rows="10"><?=$oPost->descricao?></textarea>
</div>

                            <label for="dataHoraCadastro">DataHoraCadastro</label>
                            <?php $oControle->componenteCalendario('dataHoraCadastro', Util::formataDataHoraBancoForm($oPost->dataHoraCadastro), NULL, true)?>
            <div class="form-actions">
                <button id="btnEditar" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                <a class="btn btn-default" href="admPost.php">Voltar</a>
                <input name="idPost" type="hidden" id="idPost" value="<?=$_REQUEST['idPost']?>" />
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>