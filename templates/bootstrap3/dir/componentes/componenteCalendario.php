<?php 
$textoHora = ($hora) ? "%d/%m/%Y %H:%M:%S" : "%d/%m/%Y";
$size = ($hora) ? 21 : 10;
?>
<div class="row">
    <div class="col-md-10">
        <input name="<?=$nomeCampo;?>" value="<?=$valorInicial?>" type="text" id="<?=$nomeCampo;?>" size="<?=$size?>" class="form-control" <?=$complemento?> />
    </div>
    <div class="col-md-2">    
        <img src="img/ico_calendar.png" id="btnData<?=$nomeCampo;?>" style="cursor: pointer; border-width: 0px" title="Escolha a data" />
        <script type="text/javascript">
        Calendar.setup({
            inputField : "<?=$nomeCampo;?>",
            trigger    : "btnData<?=$nomeCampo;?>",
            onSelect   : function() { this.hide();},
            showTime   : 24,
            dateFormat : "<?=$textoHora?>"
        });
        </script>
    </div>
</div>