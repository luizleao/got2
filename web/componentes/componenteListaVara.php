<?
$oControle = new Controle();
$aVara = $oControle->carregarColecaoVara();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
	<option value="">Todos</option>
<?
foreach($aVara as $oVara){
?>
	<option value="<?=$oVara->get_idVara();?>"><?=$oVara->get_descricaoVara();?></option>
<?
}
?>
</select>