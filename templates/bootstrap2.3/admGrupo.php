<?php
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle = new Controle();
$aGrupo = $oControle->carregarColecaoGrupo();
//print "<pre>";print_r($aGrupo);print "</pre>";

if($_REQUEST['acao'] == 'excluir'){
	print ($oControle->excluiGrupo($_REQUEST['idGrupo'])) ? "" : $oControle->msg; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
	<?php require_once(dirname(__FILE__)."/includes/head.php");?>
	<div class="container">
                <?php require_once(dirname(__FILE__)."/includes/titulo.php"); ?>
		<ul class="breadcrumb">
			<li><a href="principal.php">Home</a> <span class="divider">/</span></li>
			<li class="active">Grupo</li>
		</ul>
		<h2>Administrar <span>Grupo</span></h2>
		<table class="table table-striped">
<?php
if($aGrupo){
?>
	
			<thead>
				<tr>
					<th>IdGrupo</th>
					<th>Descricao</th>
					<th>Master</th>
					<th></th>
					<th></th>
					<th></th>
				</tr>
			</thead>
			<tbody>
<?php
	foreach($aGrupo as $oGrupo){
?>
				<tr>
					<td><?=$oGrupo->idGrupo?></td>
					<td><?=$oGrupo->descricao?></td>
					<td><?=$oGrupo->master?></td>
					<td><a class="btn btn-warning btn-small" href="javascript: void(0)" onclick="abreJanela('cadGrupoPrograma.php?idGrupo=<?=$oGrupo->idGrupo;?>');"><i class="icon-white icon-plus"></i>Gerenciar Programas</a></td>
					<td><a class="btn btn-success btn-small" href="editGrupo.php?idGrupo=<?=$oGrupo->idGrupo;?>"><i class="icon-white icon-edit"></i>Editar</a></td>
					<td><a class="btn btn-danger btn-small" href="javascript: void(0);" onclick="excluir('idGrupo','<?=$oGrupo->idGrupo;?>')"><i class="icon-white icon-trash"></i>Excluir</a></td>
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
				<td colspan="6" align="center">N&atilde;o h&aacute; registros cadastrados!</td>
			</tr>
<?	
}
?>
		<tr>
			<td colspan="6"><a href="cadGrupo.php" class="btn btn-primary"><i class="icon-white icon-plus"></i>Cadastrar Grupo</a></td>
		</tr>
		</table>
		<div id="push"></div>
        </div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php")?>
</body>
</html>
<?php $oControle->fecharConexao();?>