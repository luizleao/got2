<?php
$config = parse_ini_file("classes/core/config.ini", true);
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once ("includes/headerLogin.php");?>
</head>
<body>
<?php require_once("includes/modalResposta.php");?>
    <div id="wrap">
        <div class="container">
            <form class="form-signin" onsubmit="return false;">
                <img src="img/logo.png" />
                <h4 class="form-signin-heading">Blog</h4>
                <h6>Sistema de Gestão de Blog</h6>
                <input type="text" class="form-control" id="login" name="login" autofocus="autofocus" placeholder="Login" />
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha" />
                <button class="btn btn-success btn-sm" data-loading-text="loading..." name="btnLogar" id="btnLogar" type="submit"><i class="glyphicon glyphicon-ok"></i> Entrar</button>
            </form>
        </div>
        <div class="push"></div>
    </div>
    <?php require_once("includes/footer.php");?>
</body>
</html>