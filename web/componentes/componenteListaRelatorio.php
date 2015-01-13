<?
$oControle = new Controle();
$aRelatorio = $oControle->carregarColecaoRelatorio();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
	<option value="">Selecione</option>
<?
foreach($aRelatorio as $oRelatorio){
?>
	<option value="<?=$oRelatorio->get_idRelatorio();?>"<?=($oRelatorio->get_idRelatorio() == $valorInicial) ? " selected" : "";?>><?=$oRelatorio->get_nomeRelatorio();?></option>
<?
}
?>
</select>