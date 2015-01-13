<?
$oControle = new Controle();
$aInstancia = $oControle->carregarColecaoInstancia();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
	<option value="">Todos</option>
<?
foreach($aInstancia as $oInstancia){
?>
	<option value="<?=$oInstancia->get_idInstancia();?>"><?=$oInstancia->get_descricaoInstancia();?></option>
<?
}
?>
</select>