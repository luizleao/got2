<?
$oControle = new Controle();
$aTipoErro = $oControle->carregarColecaoTipoErro();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
	<option value="">Selecione</option>
<?
foreach($aTipoErro as $oTipoErro){
?>
	<option value="<?=$oTipoErro->get_idTipoErro();?>"<?=($oTipoErro->get_idTipoErro() == $valorInicial) ? " selected" : "";?>><?=$oTipoErro->get_descricaoTipoErro();?></option>
<?
}
?>
</select>