<div class="checkbox">
	<?php
	foreach($a%%CLASSE_FK%% as $o%%CLASSE_FK%%){
	?>
	<label>
		<input type="checkbox" value="<?=$o%%CLASSE_FK%%->%%CAMPO%%?>" %%EDIT_VALUE%% />
		<?=$o%%CLASSE_FK%%->%%LABEL_FK%%?>
	</label>
	<?php
	}
	?>
</div>