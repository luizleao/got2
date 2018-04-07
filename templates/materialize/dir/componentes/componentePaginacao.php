<nav aria-label="Page navigation">
	<ul class="pagination">
		<li class="<?=($_REQUEST['pag'] == 1) ? "disabled" : ""?>"><a href="?pag=<?=$_REQUEST['pag']-1?>">&lt; Anterior</a></li>
<?php 
for($i=1; $i<=$numPags; $i++){
?>
		<li class="<?=($_REQUEST['pag'] == $i) ? "disabled" : ""?>"><a href="?pag=<?=$i?>"><?=$i?></a></li>
<?php 
}
?>
		<li class="next <?=($_REQUEST['pag'] == $numPags) ? "disabled" : ""?>"><a href="?pag=<?=$_REQUEST['pag']+1?>" rel="next">Próximo &gt;</a></li>
	</ul><!-- /.pagination -->
</nav>