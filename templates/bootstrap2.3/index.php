<?php
$config = parse_ini_file(dirname(__FILE__) . "/classes/core/config.ini", true);
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <?php require_once ("includes/headerLogin.php");?>
</head>
<body>
<?php require_once(dirname(__FILE__)."/includes/modalResposta.php");?>
    <div id="wrap">
        <div class="container">
            <form class="form-signin" onsubmit="return false;">
                <h3 class="form-signin-heading">Sistema %%PROJETO%%</h3>
                <input type="text" class="input-block-level" id="login" name="login" autofocus="autofocus" placeholder="Login" />
                <input type="password" class="input-block-level" id="senha" name="senha" placeholder="Senha" />
                <button class="btn btn-primary" data-loading-text="loading..." name="btnLogar" id="btnLogar" type="submit">Ok</button>
            </form>
        </div>
        <div class="push"></div>
    </div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php");?>
</body>
</html>