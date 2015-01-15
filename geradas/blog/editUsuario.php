<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
$oUsuario = $oControle->selecionarUsuario($_REQUEST['idUsuario']);
 
// ================= Edicao do Usuario ========================= 
if($_POST){
	print ($oControle->alteraUsuario()) ? "" : $oControle->msg; exit;
}

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
            <li><a href="admUsuario.php">Usuario</a></li>
            <li class="active">Editar <span>Usuario</span></li>
        </ol>
<?php 
if($oControle->msg != "")
    $oControle->componenteMsg($oControle->msg, "erro");
?>
        <form role="form" onsubmit="return false;">

<div class="form-group">
    <label for="login">Login</label>
    <input type="text" class="form-control" id="login" name="login" value="<?=$oUsuario->login?>" />
</div>
<div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" value="<?=$oUsuario->senha?>" />
</div>
<div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" value="<?=$oUsuario->nome?>" />
</div>
<div class="form-group">
    <label for="ativo">Ativo</label>
    <input type="checkbox" name="ativo" id="ativo" value="1"<?=($oUsuario->ativo == 1) ? ' checked="checked"' : '' ?> />
</div>
<div class="form-group">
    <label for="grupo">Grupo</label>
    <select name="grupo" id="grupo" class="form-control">
        <option value="ADMIN"<?=($oUsuario->grupo == "ADMIN") ? " selected" : ""?>>ADMIN</option><option value="USUARIO"<?=($oUsuario->grupo == "USUARIO") ? " selected" : ""?>>USUARIO</option>
    </select>
</div>
            <div class="form-actions">
                <button id="btnEditar" data-loading-text="loading..." type="submit" class="btn btn-primary">Salvar</button>
                <a class="btn btn-default" href="admUsuario.php">Voltar</a>
                <input name="idUsuario" type="hidden" id="idUsuario" value="<?=$_REQUEST['idUsuario']?>" />
            </div>
        </form>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>