<?php
require_once("classes/class.Controle.php");
$oControle = new Controle();

$o%%NOME_CLASSE%% = $oControle->get%%NOME_CLASSE%%($_REQUEST['%%ID_PK%%']);
?>
<!DOCTYPE html>
<html lang="pt">
<head></head>
<body>
    <div class="container-fluid">
		<fieldset>
			<legend>Detalhes %%NOME_CLASSE%% <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button></legend>
		%%ATRIBUICAO%%
		</fieldset>
    </div>
</body>
</html>