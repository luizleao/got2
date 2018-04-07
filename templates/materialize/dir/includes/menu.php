<nav class="light-green darken-4" role="navigation">
	<div class="nav-wrapper container">
		<a id="logo-container" href="#" class="brand-logo">
			Blog
		</a>
		<ul class="right hide-on-med-and-down">
			<li><a class="dropdown-button" href="#!" data-activates="Comentario">Comentario<i class="material-icons right">arrow_drop_down</i></a></li>
			<ul id="Comentario" class="dropdown-content">
				<li><a href="/blog_materialize/Comentario/adm"><i class="material-icons">assignment</i> Administrar</a></li>
				<li><a href="/blog_materialize/Comentario/cad"><i class="material-icons">add</i> Cadastrar</a></li>
			</ul>
			
			<li><a class="dropdown-button" href="#!" data-activates="Post">Post<i class="material-icons right">arrow_drop_down</i></a></li>
			<ul id="Post" class="dropdown-content">
				<li><a href="/blog_materialize/Post/adm"><i class="material-icons">assignment</i> Administrar</a></li>
				<li><a href="/blog_materialize/Post/cad"><i class="material-icons">add</i> Cadastrar</a></li>
			</ul>
			
			<li><a class="dropdown-button" href="#!" data-activates="Usuario">Usuario<i class="material-icons right">arrow_drop_down</i></a></li>
			<ul id="Usuario" class="dropdown-content">
				<li><a href="/blog_materialize/Usuario/adm"><i class="material-icons">assignment</i> Administrar</a></li>
				<li><a href="/blog_materialize/Usuario/cad"><i class="material-icons">add</i> Cadastrar</a></li>
			</ul>
			<li><a class="dropdown-button" href="#!" data-activates="config">&nbsp;<i class="material-icons right">more_vert</i></a></li>
			<ul id="config" class="dropdown-content">
				<li><a href="/blog_materialize/Usuario/adm"><i class="material-icons">person</i><?=$_SESSION['usuarioAtual']['login']?></a></li>
				<li><a href="/blog_materialize/Usuario/cad">Sobre</a></li>
				<li class="divider"></li>
				<li><a href="/blog_materialize/sair">Sair</a></li>
			</ul>
		</ul>
		<ul id="menuMobile" class="side-nav">
			<li class="no-padding">
          		<ul class="collapsible collapsible-accordion">
            		<li><a class="collapsible-header waves-effect waves-teal">Post</a>
              			<div class="collapsible-body">
                			<ul>
                  				<li><a href="/blog_materialize/Post/adm"><i class="material-icons">assignment</i> Administrar</a></li>
								<li><a href="/blog_materialize/Post/cad"><i class="material-icons">add</i> Cadastrar</a></li>
			            	</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect waves-teal">Comentario</a>
						<div class="collapsible-body">
							<ul>
								<li><a href="/blog_materialize/Comentario/adm"><i class="material-icons">assignment</i> Administrar</a></li>
								<li><a href="/blog_materialize/Comentario/cad"><i class="material-icons">add</i> Cadastrar</a></li>
							</ul>
						</div>
					</li>
					<li><a class="collapsible-header waves-effect waves-teal">Usuario</a>
						<div class="collapsible-body">
							<ul>
                                <li><a href="/blog_materialize/Usuario/adm"><i class="material-icons">assignment</i> Administrar</a></li>
								<li><a href="/blog_materialize/Usuario/cad"><i class="material-icons">add</i> Cadastrar</a></li>
                			</ul>
              			</div>
            		</li>
					<li><div class="divider"></div></li>
            		<li><a class="collapsible-header waves-effect waves-teal"><i class="material-icons">help</i>Ajuda</a>
						<div class="collapsible-body">
							<ul>
								<li><a href="#">Perfil</a></li>
								<li><a href="#">Sobre</a></li>
								<li class="divider"></li>
								<li><a href="/blog_materialize/#/logoff">Sair</a></li>
                			</ul>
						</div>
					</li>
				</ul>
        	</li>
		</ul>
		<a href="#" data-activates="menuMobile" class="button-collapse"><i class="material-icons">menu</i></a>
	</div>
</nav>