<?php
$oControle = new Controle();
$aSituacaoProcesso = $oControle->carregarColecaoSituacaoProcesso();
?>
<select name="<?=$nomeCampo?>" id="<?=$nomeCampo?>" <?=$complemento?>>
    <option value="">Todos</option>
<?php
foreach($aSituacaoProcesso as $oSituacaoProcesso){
?>
    <option value="<?=$oSituacaoProcesso->get_idSituacaoProcesso();?>"><?=$oSituacaoProcesso->get_descricaoSituacaoProcesso();?></option>
<?php
}
?>
</select>