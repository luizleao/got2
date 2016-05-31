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
	<?php require_once("includes/modals.php");?>
    <div class="container">
        <?php 
        require_once("includes/titulo.php");
        require_once("includes/menu.php");
        ?>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>