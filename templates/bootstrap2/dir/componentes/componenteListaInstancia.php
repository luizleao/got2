<?php
$oControle = new Controle();
$aInstancia = $oControle->getAllInstancia();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Todos</option>
<?php
foreach($aInstancia as $oInstancia){
?>
    <option value="<?=$oInstancia->get_idInstancia();?>"><?=$oInstancia->get_descricaoInstancia();?></option>
<?php
}
?>
</select>