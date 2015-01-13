<?php 
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
<div id="wrap">
<?php require_once(dirname(__FILE__)."/includes/head.php")?>
<div class="container">
    <?php require_once(dirname(__FILE__)."/includes/titulo.php"); ?>
</div>
<div id="push"></div>
</div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php")?>
</body>
</html>
<?php $oControle->fecharConexao();?>