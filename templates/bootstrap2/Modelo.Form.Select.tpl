<label for="%%CAMPO%%">%%CLASSE_FK%%</label>
<select name="%%CAMPO%%" id="%%CAMPO%%" class="input-xlarge">
    <option value="">Selecione</option>
<?php
foreach($a%%CLASSE_FK%% as $o%%CLASSE_FK%%){
?>
    <option value="<?=$o%%CLASSE_FK%%->%%CAMPO%%?>"%%EDIT_VALUE%%><?=$o%%CLASSE_FK%%->%%LABEL_FK%%?></option>
<?php
}
?>
</select>