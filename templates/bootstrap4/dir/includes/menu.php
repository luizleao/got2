<nav class="navbar navbar-expand-lg navbar-light bg-light">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#menu" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>
	<a class="navbar-brand" href="principal.php"><h4><a href="./principal.php"><img src="img/logo.png"></a> Blog</h4></a>
	<div id="menu" class="collapse navbar-collapse">
		<ul class="navbar-nav">
			<li class="nav-item dropdown">
				<a class="nav-item nav-link dropdown-toggle" href="#" id="Comentario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Comentario
				</a>
				<div class="dropdown-menu" aria-labelledby="Comentario">
					<a class="dropdown-item" href="admComentario.php"><i class="oi oi-list"></i> Administrar</a>
					<a class="dropdown-item" href="cadComentario.php"><i class="oi oi-plus"></i> Cadastrar</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-item nav-link dropdown-toggle" href="#" id="Post" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Post
				</a>
				<div class="dropdown-menu" aria-labelledby="Post">
					<a class="dropdown-item" href="admPost.php"><i class="oi oi-list"></i> Administrar</a>
					<a class="dropdown-item" href="cadPost.php"><i class="oi oi-plus"></i> Cadastrar</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-item nav-link dropdown-toggle" href="#" id="Usuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  Usuario
				</a>
				<div class="dropdown-menu" aria-labelledby="Usuario">
					<a class="dropdown-item" href="admUsuario.php"><i class="oi oi-list"></i> Administrar</a>
					<a class="dropdown-item" href="cadUsuario.php"><i class="oi oi-plus"></i> Cadastrar</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-item nav-link dropdown-toggle" href="#" id="Usuario" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				  <i class="oi oi-person"></i> <?=$_SESSION['usuarioAtual']['login']?> <span class="caret"></span>
				</a>
				<div class="dropdown-menu" aria-labelledby="Usuario">
					<a class="dropdown-item" href="admUsuario.php"><i class="oi oi-list"></i> Profile</a>
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalSobre"><i class="oi oi-question-mark"></i> Sobre</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.php"><i class="oi oi-account-logout"></i> Sair</a>
				</div>
			</li>			
		</ul>
	</div>
</nav>
