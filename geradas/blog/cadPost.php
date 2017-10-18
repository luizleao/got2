<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Post ========================= 
if($_POST){
    print ($oControle->cadastrarPost()) ? "" : $oControle->msg; exit;
}
$aUsuario = $oControle->getAllUsuario();
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="PostController">
		<?php 
		require_once("includes/titulo.php"); 
		require_once("includes/menu.php"); 
		?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li><a href="admPost.php">Post</a></li>
			<li class="active">Cadastrar Post</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="idUsuario">Usuario</label>
	<select name="idUsuario" id="idUsuario" class="form-control">
		<option value="">Selecione</option>
	<?php
	foreach($aUsuario as $oUsuario){
	?>
		<option value="<?=$oUsuario->idUsuario?>"><?=$oUsuario->login?></option>
	<?php
	}
	?>
	</select>
</div>
<div class="form-group">
	<label for="titulo">Titulo</label>
	<input type="text" class="form-control" id="titulo" name="titulo" value="" />
</div>
<div class="form-group">
    <label for="descricao">Descricao</label>
    <textarea name="descricao" class="form-control" id="descricao" cols="80" rows="10"></textarea>
</div>

                            	<label for="dataHoraCadastro">DataHoraCadastro</label>
                            	<?php $oControle->componenteCalendario('dataHoraCadastro', NULL, NULL, true)?>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admPost.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Post" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>