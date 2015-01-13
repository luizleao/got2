<?php 
switch($tipo){
	case "erro":
		$tipo = "alert-error";
	break;
	case "sucesso":
		$tipo = "alert-success";
	break;
}
?>
<div class="alert alert-block <?=$tipo?> fade in">
	<button type="button" class="close" data-dismiss="alert">×</button>
	<h4 class="alert-heading">Alerta!</h4>
	<p><?php echo $msg?></p>
</div>