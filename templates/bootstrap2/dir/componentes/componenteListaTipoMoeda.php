<?php
$oControle = new Controle();
$aTipoMoeda = $oControle->getAllTipoMoeda();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Todos</option>
<?php
foreach($aTipoMoeda as $oTipoMoeda){
?>
    <option value="<?=$oTipoMoeda->get_idTipoMoeda();?>"><?=$oTipoMoeda->get_descricaoTipoMoeda();?> (<?=$oTipoMoeda->get_siglaTipoMoeda();?>)</option>
<?php
}
?>
</select>