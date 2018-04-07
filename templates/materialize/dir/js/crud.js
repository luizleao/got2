$(document).ready(function(){
	var classe = $("#classe").html();

/**
 * 
 * Funcao Cadastrar
 * 
 * @author luizleao
 */

	$("#btnCadastrar").click(function () {
		dados = retornaParametros(document.forms[0]);
		$.ajax({
			url : 'cad',
			type : 'post',
			data : dados,
			dataType: 'html',
			beforeSend: function(){
				$('#divLoading').removeClass('hide');
				//$('#btnCadastrar').button('loading');
			},
			timeout: 3000,
			success: function(retorno){
				$('#divLoading').addClass('hide');
				//$('#btnCadastrar').button('reset');

				if(retorno != '')
					console.log(retorno);
					//$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
				else
					console.log(retorno);
					//$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_success.png" />Cadastrado com sucesso');
				//$('#modalResposta').modal('show');
			},
			error: function(retorno){
				//$('#btnCadastrar').button('reset');
				//$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
				//$('#modalResposta').modal('show');
			}
		});
//		$('#modalResposta').on('shown', function (){
//			$('#modalResposta > .modal-footer > #btnFechar').focus();
//		});
	});

/**
 * 
 * Funcao Editar
 * @author luizleao
 */
	$("#btnEditar").click(function () {
		dados = retornaParametros(document.forms[0]);
		$.ajax({
			url : 'edit'+classe+'.php',
			type : 'post',
			data : dados,
			dataType: 'html',
			beforeSend: function(){
				$('#btnEditar').button('loading');
			},
			timeout: 3000,
			success: function(retorno){
				$('#btnEditar').button('reset');

				if(retorno != '')
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
				else
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_success.png" /> Editado com sucesso');
				$('#modalResposta').modal('show');
			},
			error: function(){
				$('#btnEditar').button('reset');
				$('#modalResposta > .modal-body').html('Erro!!');
				$('#modalResposta').modal('show');
			}
		});
		$('#modalResposta').on('shown', function (){
			$('#modalResposta > .modal-footer > #btnFechar').focus();
		});
	});
	
	
	/**
	 * 
	 * Função Logar
	 * @author luizleao
	 */
	$('#btnLogar').click(function(){
		dados = retornaParametros(document.forms[0]);
		$.ajax({
			url : 'resIndex',
			type : 'post',
			data : dados,
			dataType: 'html',
			beforeSend: function(){
				//$('#btnLogar').button('loading');
			},
			timeout: 3000,
			success: function(retorno){
				console.log(retorno);
				//$('#btnLogar').button('reset');

				if(retorno != ''){
					//$('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> '+retorno);
					//$('#modalResposta').modal('show');
				} else{
					window.location = 'home';
				}
				
			},
			error: function(retorno){
				console.log(retorno);
				//$('#btnLogar').button('reset');
				//$('#modalResposta > .modal-body').html('<img src="img/ico_error.png" /> Erro: '+retorno);
				//$('#modalResposta').modal('show');
			}
		});
//		$('#modalResposta').on('shown', function (){
//			$('#modalResposta > .modal-footer > #btnFechar').focus();
//		});
	});
	
	/**
	 * 
	 * Cadastrar programas ao grupo selecionado
	 * @author luizleao
	 */
	$('#btnCadastroPrograma').click(function (){
		dados = retornaParametros(document.forms[0]);
		$.ajax({
			url : 'cadGrupoPrograma.php',
			type : 'post',
			data : dados,
			dataType: 'html',
			beforeSend: function(){
				$('#btnCadastroPrograma').button('loading');
			},
			timeout: 3000,
			success: function(retorno){
				$('#btnCadastroPrograma').button('reset');

				if(retorno != '')
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
				else
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_success.png" />Cadastrado com sucesso');
				$('#modalResposta').modal('show');
			},
			error: function(retorno){
				$('#btnCadastroPrograma').button('reset');
				$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
				$('#modalResposta').modal('show');
			}
		});
		$('#modalResposta').on('shown', function (){
			$('#modalResposta > .modal-footer > #btnFechar').focus();
		});
	});
});

function excluir(campo, valor){
	var classe = $(".active > span").html();
	
	$('#modalExcluir').modal('show');
	$('#modalExcluir > .modal-body').html('Deseja excluir '+ classe +'?');
	
	$('#btnSim').click(function () {
		$.ajax({
			url  	   : 'adm'+classe+'.php?acao=excluir&'+campo+'='+valor,
			type 	   : 'get',
			beforeSend : function(){
				$('#btnCadastrar').button('loading');
			},
			timeout	   : 3000,
			success	   : function(retorno){
				$('#modalExcluir').modal('hide');
				if(retorno != ''){
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> '+retorno);
					$('#modalResposta').modal('show');
				}
				else{
					$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_success.png" /> Excluido com sucesso');
					$('#modalResposta').modal('show');
					$('#modalResposta').on('hide', function () {
						window.location = 'adm'+classe+'.php';
					});
				}
			},
			error	   : function(retorno){
				$('#modalExcluir').modal('hide');
				$('#modalResposta > .modal-body').html('<img src="/blog_materialize/img/ico_error.png" /> ERRO: '+retorno);
				$('#modalResposta').modal('show');
			}
		});
	});
}