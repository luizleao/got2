<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

// ================= Cadastrar Usuario ========================= 
if($_POST){
    print ($oControle->cadastrarUsuario()) ? "" : $oControle->msg; exit;
}

?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once("includes/header.php");?>
</head>
<body ng-app="app">
	<?php require_once("includes/modals.php");?>
	<div class="container" ng-controller="UsuarioController">
		<?php 
		require_once("includes/titulo.php"); 
		require_once("includes/menu.php"); 
		?>
		<ol class="breadcrumb">
			<li><a href="principal.php">Home</a></li>
			<li><a href="admUsuario.php">Usuario</a></li>
			<li class="active">Cadastrar Usuario</li>
		</ol>
<?php 
if($oControle->msg != "")
	$oControle->componenteMsg($oControle->msg, "erro");
?>
		<form role="form" onsubmit="return false;">
			<div class="row">
				<div class="col-md-4">
					
<div class="form-group">
	<label for="login">Login</label>
	<input type="text" class="form-control" id="login" name="login" value="" />
</div>
<div class="form-group">
    <label for="senha">Senha</label>
    <input type="password" class="form-control" id="senha" name="senha" value="" />
</div>
<div class="form-group">
	<label for="nome">Nome</label>
	<input type="text" class="form-control" id="nome" name="nome" value="" />
</div>
<div class="form-group">
    <label for="ativo">Ativo</label>
    <input type="checkbox" name="ativo" id="ativo" value="1" />
</div>
<div class="form-group">
    <label for="grupo">Grupo</label>
    <select name="grupo" id="grupo" class="form-control">
        <option value="ADMIN">ADMIN</option><option value="USUARIO">USUARIO</option>
    </select>
</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<button id="btnCadastrar" data-loading-text="Carregando..." type="submit" class="btn btn-primary">Salvar</button>
						<a class="btn btn-default" href="admUsuario.php">Voltar</a>
						<input type="hidden" name="classe" id="classe" value="Usuario" />
					</div>
				</div>
			</div>
		</form>
	</div>
	<?php require_once("includes/footer.php")?>
</body>
</html>