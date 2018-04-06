<nav aria-label="Page navigation example">
	<ul class="pagination justify-content-center">
		<li class="page-item <?=($_REQUEST['pag'] == $i) ? "disabled" : ""?>"><a class="page-link" href="?pag=<?=$_REQUEST['pag']-1?>">&lt; Anterior</a></li>
<?php 
for($i=1; $i<=$numPags; $i++){
?>
		<li class="page-item <?=($_REQUEST['pag'] == $i) ? "disabled" : ""?>"><a class="page-link" href="?pag=<?=$i?>"><?=$i?></a></li>
<?php 
}
?>
		<li class="page-item <?=($_REQUEST['pag'] == $i) ? "disabled" : ""?>"><a class="page-link" href="?pag=<?=$_REQUEST['pag']+1?>" rel="next">Próximo &gt;</a></li>
	</ul><!-- /.pagination -->
</nav>