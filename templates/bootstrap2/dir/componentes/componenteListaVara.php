<?php
$oControle = new Controle();
$aVara = $oControle->getAllVara();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Todos</option>
<?php
foreach($aVara as $oVara){
?>
    <option value="<?=$oVara->get_idVara();?>"><?=$oVara->get_descricaoVara();?></option>
<?php
}
?>
</select>