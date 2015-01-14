<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
	    	<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" href="#">Blog</a>
			<div class="btn-group pull-right">
				<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
					<i class="icon-user"></i>Usuário: <?=$_SESSION['usuarioAtual']->login?><span class="caret"></span>
	            </a>
				<ul class="dropdown-menu">
					<li><a href="ediUsuario.php">Profile</a></li>
					<li class="divider"></li>
					<li><a href="logoff.php"><i class="icon-off"></i>Sair</a></li>
				</ul>
			</div>
			<div class="nav-collapse">
				<ul class="nav">
					<li class="active">
						<a href="principal.php"><i class="icon-white icon-home"></i>Home</a>
					</li>
<?php
//print "<pre>";print_r($_SESSION['aMenu']);print "</pre>";
foreach($_SESSION['aMenu'] as $nomeSistema=>$aModuloMenu){
?>
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?=$nomeSistema?> <b class="caret"></b></a>
						<ul class="dropdown-menu">
<?php
	foreach($aModuloMenu as $nomeModulo=>$aProgramaMenu){
?>
							<li class="nav-header"><?=$nomeModulo?></a></li>
<?php 
		foreach($aProgramaMenu as $nomePrograma=>$oProgramaMenu){
?>
							<li><a href="<?=$oProgramaMenu['pagina']?>"><?=$nomePrograma;?></a></li>
<?php
		} 
	}
?>
						</ul>
					</li>
<?php 
}
?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>