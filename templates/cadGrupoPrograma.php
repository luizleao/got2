<?php 
require_once(dirname(__FILE__)."/classes/class.Controle.php");

$oControle  = new Controle();
$oSeguranca = $oControle->get_seguranca();
$aModulo 	= $oControle->carregarColecaoModulo();
$oGrupo  	= $oControle->selecionarGrupo($_REQUEST['idGrupo']);

//print "<pre>";print_r($aModulo);print "</pre>";
if($_POST){
	print ($oSeguranca->transacaoCadastraProgramaGrupo($_POST)) ? $oSeguranca->msg() : ""; exit;
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
	<?php require_once(dirname(__FILE__)."/includes/header.php");?>
</head>
<body>
<form name="form" id="form" method="post" onsubmit="return false;">
	<div class="container">
                <?php require_once(dirname(__FILE__)."/includes/titulo.php"); ?>
		<table>
			<tr>
				<td class="textoEsquerda">Grupo:
				<?=$oGrupo->descricao?>
				<input name="idGrupo" type="hidden" id="idGrupo" value="<?=$_REQUEST['idGrupo'];?>" />
				</td>
				</tr>
		</table>
		<table>	
			<tr>
				<td colspan="4" align="center">
					<input type="submit" name="btnCadastrar" id="btnCadastrar" value="Cadastrar Programa(s) ao Grupo" accesskey="c" onclick="cadastrarGrupoPrograma(document.forms[0]);" />
				</td>
			</tr>
<?
if($aModulo){
?>
			<tr>
				<th width="21%" scope="col">M&oacute;dulo</th>
				<th width="62%" scope="col">Programas</th>
				<th width="17%" scope="col"><a href="javascript: void(0);" onclick="selecionarTodos(document.forms[0].elements['idPrograma[]']);"><img src="imagens/btnChecar.gif" width="15" height="11" title="Selecionar Todos" border="0" /></a> Todos</th>
			</tr>
<?
	$i=0;
	foreach($aModulo as $oModulo){
		$oSistema 		 = $oControle->selecionarSistema($oModulo->oSistema->idSistema);
		$aProgramaModulo = $oSeguranca->carregarColecaoProgramaPorModulo($oModulo->idModulo);
		
?>
			<tr bgcolor="<?=($i%2==0) ? "#EEEEEE" : "";?>">
				<td><?=$oModulo->descricao?></td>
				<td colspan="2" class="textoEsquerda">
<?
		foreach($aProgramaModulo as $oProgramaModulo){
			//print "<xmp>"; print_r($oProgramaModulo); print "</xmp>";
			$oGrupoPrograma = $oControle->selecionarGrupoprograma($_REQUEST['idGrupo'], $oProgramaModulo->idPrograma);
			if($oGrupo->master == true &&  $oModulo->oSistema->idSistema == 1){ //Administrador
?>
				<input name="idPrograma[]" type="checkbox" id="idPrograma[]" value="<?=$oProgramaModulo->idPrograma?>" checked="checked" disabled="disabled" />
				<input name="idPrograma[]" type="hidden" id="idPrograma[]" value="<?=$oProgramaModulo->idPrograma?>" />
<?
			}
			else{
?>
				<input name="idPrograma[]" type="checkbox" id="idPrograma[]" value="<?=$oProgramaModulo->idPrograma?>"<?=(!$oGrupoPrograma) ? "" : " checked";?> />
<?
			}
?>
				<?=$oProgramaModulo->descricao;?>
<?
		}
?>
				</td>
			</tr>
<?
		$i++;
	}
}
else{
?>
			<tr>
				<td colspan="3" align="center"><strong>N&atilde;o h&aacute; nenhum registro cadastrado!</strong></td>
			</tr>
<?	
}
?>
			<tr>
				<td colspan="3" align="center">
				<input type="submit" name="btnCadastrar" id="btnCadastrar" value="Cadastrar Programa(s) ao Grupo" accesskey="c" onclick="cadastrarGrupoPrograma('GrupoPrograma', document.forms[0]);" />
				</td>
			</tr>
		</table>
<div id="push"></div>
</div>
    <?php require_once(dirname(__FILE__)."/includes/footer.php")?>
</form>
</body>
</html>
<?php $oControle->fecharConexao();?>