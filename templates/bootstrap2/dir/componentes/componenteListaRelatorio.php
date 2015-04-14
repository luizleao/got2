<?php
$oControle = new Controle();
$aRelatorio = $oControle->getAllRelatorio();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Selecione</option>
<?php
foreach($aRelatorio as $oRelatorio){
?>
    <option value="<?=$oRelatorio->get_idRelatorio();?>"<?=($oRelatorio->get_idRelatorio() == $valorInicial) ? " selected" : "";?>><?=$oRelatorio->get_nomeRelatorio();?></option>
<?php
}
?>
</select>