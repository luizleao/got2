<?php 
require_once(dirname(__FILE__)."/classes/class.Controle.php");
$oControle = new Controle();
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
	<?php require_once(dirname(__FILE__)."/includes/head.php")?>  
    	<main class="container">
			<?php 
			Util::trace($_SESSION['usuarioAtual']);
			?>
    	</main>
	<?php require_once(dirname(__FILE__)."/includes/footer.php")?>
	</body>
</html>
<?php $oControle->fecharConexao();?>