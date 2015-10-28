<?php 
switch($tipo){
    case "erro":    $tipo = "alert-danger"; break;
    case "sucesso": $tipo = "alert-success"; break;
}
?>
<div class="alert alert-dismissible fade in <?=$tipo?>">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">×</button>
    <h4>Alerta!</h4>
    <p><?php echo $msg?></p>
</div>