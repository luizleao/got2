<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aUsuario = $oControle->carregarColecaoUsuario();
//print "<pre>";print_r($aUsuario);print "</pre>";

if($_REQUEST['acao'] == 'excluir'){
    print ($oControle->excluiUsuario($_REQUEST['idUsuario'])) ? "" : $oControle->msg; exit;
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
        <?php require_once("includes/titulo.php");?>
        <?php require_once("includes/menu.php");?>
        <ol class="breadcrumb">
            <li><a href="principal.php">Home</a></li>
            <li class="active">Administrar <span>Usuario</span></li>
        </ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
        <table class="table table-striped">
<?php
if($aUsuario){
?>
	
            <thead>
                <tr>
                    <th>IdUsuario</th>
			<th>Login</th>
			<th>Senha</th>
			<th>Nome</th>
			<th>Ativo</th>
			<th>Grupo</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
<?php
	foreach($aUsuario as $oUsuario){
?>
                <tr>
                    <td><?=$oUsuario->idUsuario?></td>
			<td><?=$oUsuario->login?></td>
			<td><?=$oUsuario->senha?></td>
			<td><?=$oUsuario->nome?></td>
			<td><?=$oUsuario->ativo?></td>
			<td><?=$oUsuario->grupo?></td>
                    <td><a class="btn btn-success btn-sm" href="editUsuario.php?idUsuario=<?=$oUsuario->idUsuario;?>" title="Editar"><i class="glyphicon glyphicon-edit"></i></a></td>
                    <td><a class="btn btn-danger btn-sm" href="javascript: void(0);" onclick="excluir('idUsuario','<?=$oUsuario->idUsuario;?>')" title="Excluir"><i class="glyphicon glyphicon-trash"></i></a></td>
                </tr>
<?php
	}
?>
            </tbody>
<?php
}
else{
?>
            <tr>
                    <td colspan="8" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
            </tr>
<?php
}
?>
            <tr>
                <td colspan="8"><a href="cadUsuario.php" class="btn btn-primary btn-sm" title="Cadastrar"><i class="glyphicon glyphicon-plus"></i></a></td>
            </tr>
        </table>
    </div>
    <?php require_once("includes/footer.php")?>
</body>
</html>