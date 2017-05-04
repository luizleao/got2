<?php

if(isset($_REQUEST))
	print "<pre>"; print_r($_REQUEST); print "</pre>";

?>

<form method="post" action="">
	<input type="date" name="data" />
	<input type="email" name="email" />
	<input type="number" name="numero" />
	<button type="submit">Enviar</button>
</form>