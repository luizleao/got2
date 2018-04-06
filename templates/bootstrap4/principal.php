<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<?php require_once("includes/header.php");?>
</head>
<body>
	<?php require_once("includes/menu.php");?>
    <div class="container">
        <?php require_once("includes/menu.php");?>
        <?php Util::trace($_SESSION['usuarioAtual']);?>
    </div>
    <?php require_once("includes/footer.php")?>
    <?php require_once("includes/modals.php");?>
    <?php require_once("includes/js.php");?>
</body>
</html>