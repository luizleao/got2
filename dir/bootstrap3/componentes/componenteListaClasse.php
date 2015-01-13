<?php
$oControle = new Controle();
$aClasse = $oControle->carregarColecaoClasse();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Selecione</option>
<?php
foreach($aClasse as $oClasse){
?>
    <option value="<?=$oClasse->get_idClasse();?>"><?=$oClasse->get_descricaoClasse();?></option>
<?php
}
?>
</select>