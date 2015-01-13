<?php
$oControle = new Controle();
$aTipoPolo = $oControle->carregarColecaoTipoPolo();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Todos</option>
<?php
foreach($aTipoPolo as $oTipoPolo){
?>
    <option value="<?=$oTipoPolo->get_idTipoPolo();?>"><?=$oTipoPolo->get_descricaoTipoPolo();?></option>
<?php
}
?>
</select>