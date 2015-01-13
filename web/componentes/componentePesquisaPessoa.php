<input name="txtConsulta" type="text" id="txtConsulta" />
<input type="hidden" name="idPessoa" id="idPessoa" />
<input name="btnPesquisar" type="button" id="btnPesquisar" value="Pesquisar" onclick="abreJanela('frmPesquisaPessoa.php?txtConsulta='+document.getElementById('txtConsulta').value);" />
<div id="divPessoa"></div>