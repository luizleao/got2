<?php 
$textoHora = ($hora) ? "%d/%m/%Y %H:%M:%S" : "%d/%m/%Y";
?>
<div class="row">
    <div class="col-md-10">
        <input name="<?=$nomeCampo;?>" value="<?=$valorInicial?>" type="text" id="<?=$nomeCampo;?>" size="18" readonly="readonly" <?=$complemento?> class="form-control" />
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