<!-- Static navbar -->
<nav class="navbar navbar-default" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-controls="navbar">
                <span class="sr-only">Menu Principal</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="principal.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                
                            <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Comentario <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                            <li><a href="admComentario.php"><i class="glyphicon glyphicon-th-list"></i> Administrar</a></li>
                                            <li><a href="cadComentario.php"><i class="glyphicon glyphicon-plus"></i> Cadastrar</a></li>
                                    </ul>
                            </li>
                            <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Post <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                            <li><a href="admPost.php"><i class="glyphicon glyphicon-th-list"></i> Administrar</a></li>
                                            <li><a href="cadPost.php"><i class="glyphicon glyphicon-plus"></i> Cadastrar</a></li>
                                    </ul>
                            </li>
                            <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Usuario <b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                            <li><a href="admUsuario.php"><i class="glyphicon glyphicon-th-list"></i> Administrar</a></li>
                                            <li><a href="cadUsuario.php"><i class="glyphicon glyphicon-plus"></i> Cadastrar</a></li>
                                    </ul>
                            </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"><i class="glyphicon glyphicon-user"></i> <?=$_SESSION['usuarioAtual']['login']?> <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#"><i class="glyphicon glyphicon-th-list"></i> Profile</a></li>
                        <li class="divider"></li>
                        <li><a href="#" data-toggle="modal" data-target="#modalSobre"><span class="glyphicon glyphicon-question-sign"></span> Sobre</a></li>
                        <li class="divider"></li>
                        <li><a href="logoff.php"><i class="glyphicon glyphicon-off"></i> Sair</a></li>
                    </ul>
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>